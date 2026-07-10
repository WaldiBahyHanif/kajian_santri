<?php

namespace App\Http\Controllers;

use App\Models\UstadzAIChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AIChatController extends Controller
{
    /**
     * Fetch conversation history for a specific topic.
     */
    public function getHistory(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|in:materi,spiritual,istiqomah,adab,absen,tanya'
        ]);

        $user = Auth::user();
        $topic = $request->query('topic');

        // Automatically delete chat messages older than 24 hours (1 day)
        $user->aiChats()
            ->where('topic', $topic)
            ->where('created_at', '<', now()->subDay())
            ->delete();

        $history = $user->aiChats()
            ->where('topic', $topic)
            ->orderBy('created_at', 'asc')
            ->take(50)
            ->get();

        return response()->json([
            'success' => true,
            'history' => $history
        ]);
    }

    /**
     * Send a new message, fetch history context, query Ustadz AI, and store reply.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|in:materi,spiritual,istiqomah,adab,absen,tanya',
            'message' => 'required|string|max:1000'
        ]);

        $user = Auth::user();
        $topic = $request->input('topic');
        $messageText = $request->input('message');

        // Delete expired chat messages (> 24 hours) for this topic before inserting new ones
        $user->aiChats()
            ->where('topic', $topic)
            ->where('created_at', '<', now()->subDay())
            ->delete();

        // 1. Save user's message
        $user->aiChats()->create([
            'topic' => $topic,
            'role' => 'user',
            'message' => $messageText
        ]);

        // 2. Fetch last 10 messages for conversation context
        $pastMessages = $user->aiChats()
            ->where('topic', $topic)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->reverse()
            ->values();

        // 3. Define System Prompt based on selected topic
        $systemPrompts = [
            'tanya' => "Kamu adalah Ustadz AI, pembimbing rohani virtual yang bijaksana untuk santri di pondok pesantren Daaru Hiraa. Jawablah pertanyaan santri dengan santun, penuh hikmah, memotivasi, dan berikan penjelasan mendalam seputar ilmu syar'i, ibadah harian, adab pesantren, kiat istiqomah, presensi kehadiran, serta berikan nasihat rohani yang menyejukkan hati jika santri sedang lelah atau butuh teman curhat. Sertakan dalil yang shahih (Quran/Hadits) jika relevan.",
            'materi' => "Kamu adalah Ustadz AI, pembimbing rohani virtual yang bijaksana untuk santri di pondok pesantren Daaru Hiraa. Fokus membantu santri dengan ramah menjawab pertanyaan seputar materi kajian, ilmu fiqih, tafsir Al-Quran, dan syarah hadits. Sertakan dalil yang shahih (Quran/Hadits) jika relevan.",
            'spiritual' => "Kamu adalah Ustadz AI, pembimbing rohani virtual yang bijaksana untuk santri di pondok pesantren Daaru Hiraa. Fokus memberikan nasihat spiritual yang menyentuh hati, penyemangat, dan bimbingan bagi santri yang sedang lelah, jenuh, futur, atau butuh teman cerita. Berikan kehangatan dan motivasi Islami agar iman mereka bangkit kembali.",
            'istiqomah' => "Kamu adalah Ustadz AI, pembimbing rohani virtual yang bijaksana untuk santri di pondok pesantren Daaru Hiraa. Fokus memberikan tips taktis, kiat belajar, dan motivasi agar santri tetap konsisten (istiqomah) dalam belajar, beribadah, menjaga hafalan, dan melakukan amalan harian.",
            'adab' => "Kamu adalah Ustadz AI, pembimbing rohani virtual yang bijaksana untuk santri di pondok pesantren Daaru Hiraa. Fokus memberikan penjelasan seputar adab-adab penuntut ilmu, akhlakul karimah terhadap guru, orang tua, sesama santri, serta tata krama kehidupan sosial di pesantren."
        ];

        // Absen topic gets dynamic student database context injected
        if ($topic === 'absen') {
            $student = $user;
            $statsText = "Data tidak ditemukan.";
            $recentLeavesText = "Tidak ada pengajuan izin terbaru.";

            if ($student) {
                // Get attendance counts
                $stats = \App\Models\AttendanceLog::where('student_id', $student->id)
                    ->selectRaw("status, count(*) as count")
                    ->groupBy('status')
                    ->pluck('count', 'status');

                $hadir = $stats->get('H', 0);
                $izin = $stats->get('I', 0);
                $sakit = $stats->get('S', 0);
                $alpha = $stats->get('A', 0);
                $statsText = "Hadir: {$hadir} kali, Izin: {$izin} kali, Sakit: {$sakit} kali, Alpha (Tidak Hadir Tanpa Keterangan): {$alpha} kali.";

                // Get recent leaves
                $recentLeaves = \App\Models\LeaveRequest::where('student_id', $student->id)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

                if ($recentLeaves->isNotEmpty()) {
                    $leavesArr = [];
                    foreach ($recentLeaves as $l) {
                        $leavesArr[] = "- Tipe: {$l->type_label}, Tanggal: {$l->start_date->format('Y-m-d')} s/d {$l->end_date->format('Y-m-d')}, Alasan: '{$l->reason}', Status: {$l->status_label}" . ($l->rejection_reason ? " (Alasan Ditolak: {$l->rejection_reason})" : "");
                    }
                    $recentLeavesText = implode("\n", $leavesArr);
                }
            }

            $systemPrompts['absen'] = "Kamu adalah Ustadz AI, asisten khusus absensi dan perizinan pondok pesantren Daaru Hiraa. Fokus membantu santri mengecek kehadiran/absen dan membuat pengajuan izin/cuti/sakit.
Hari ini adalah: " . now()->translatedFormat('l, d F Y') . ".

Konteks Kehadiran Santri yang sedang mengobrol denganmu:
- Nama: " . ($student->name ?? $user->name) . "
- Statistik Kehadiran saat ini: " . $statsText . "
- Riwayat Pengajuan Izin/Cuti/Sakit Terbaru:
" . $recentLeavesText . "

Jika santri bertanya tentang jumlah kehadiran/alpha/izin mereka atau status pengajuan izin mereka, jawablah secara akurat berdasarkan data di atas.

Jika santri ingin mengajukan izin/cuti/sakit baru, kamu harus mengumpulkan 5 informasi berikut:
1. Tipe izin (bisa: 'izin', 'cuti', atau 'sakit')
2. Tanggal Mulai (format YYYY-MM-DD, wajib setelah atau sama dengan hari ini)
3. Tanggal Selesai (format YYYY-MM-DD, wajib setelah atau sama dengan tanggal mulai)
4. Alasan izin
5. Kegiatan yang dilingkupi (array dari pilihan: 'Kajian', 'Sholat', 'Tahsin', 'Acara')

Setelah informasi di atas lengkap (atau kamu sudah menyimpulkannya dari percakapan), kamu WAJIB memicu aksi pembuatan izin dengan menyertakan blok aksi JSON berikut di akhir jawabanmu (persis seperti format ini):
<action>{\"type\": \"create_leave_request\", \"params\": {\"type\": \"tipe_izin\", \"start_date\": \"tanggal_mulai\", \"end_date\": \"tanggal_selesai\", \"reason\": \"alasan_izin\", \"covered_sessions\": [\"kegiatan_1\", \"kegiatan_2\"]}}</action>

Ingat:
- Tipe izin harus bernilai salah satu dari: 'izin', 'cuti', 'sakit' (lowercase).
- Format tanggal harus YYYY-MM-DD.
- Array covered_sessions harus berisi pilihan dari: 'Kajian', 'Sholat', 'Tahsin', 'Acara'. Jika santri tidak menyebutkan, asumsikan semua kegiatan tercakup.
- Jangan menyertakan tag <action> jika informasi belum lengkap atau tidak ada pengajuan izin baru yang disepakati.";
        }

        $systemPrompt = $systemPrompts[$topic] ?? "Kamu adalah Ustadz AI, pembimbing rohani virtual yang bijaksana untuk santri.";

        // 4. Construct messages payload
        $messages = [];
        $messages[] = ['role' => 'system', 'content' => $systemPrompt];
        foreach ($pastMessages as $msg) {
            $messages[] = [
                'role' => $msg->role,
                'content' => $msg->message
            ];
        }

        // Determine AI Provider & Model dynamically with automatic fallbacks
        $provider = config('services.openai.provider', 'nvidia');
        $nvidiaApiKey = config('services.nvidia.api_key');
        $openaiApiKey = config('services.openai.api_key');
        $geminiApiKey = config('services.gemini.api_key');
        $groqApiKey = config('services.groq.api_key');
        $answer = '';

        $attempts = [];
        if ($provider === 'openai') {
            if ($openaiApiKey) $attempts[] = 'openai';
            if ($nvidiaApiKey) $attempts[] = 'nvidia';
            if ($geminiApiKey) $attempts[] = 'gemini';
            if ($groqApiKey) $attempts[] = 'groq';
        } elseif ($provider === 'gemini') {
            if ($geminiApiKey) $attempts[] = 'gemini';
            if ($nvidiaApiKey) $attempts[] = 'nvidia';
            if ($groqApiKey) $attempts[] = 'groq';
            if ($openaiApiKey) $attempts[] = 'openai';
        } elseif ($provider === 'groq') {
            if ($groqApiKey) $attempts[] = 'groq';
            if ($geminiApiKey) $attempts[] = 'gemini';
            if ($nvidiaApiKey) $attempts[] = 'nvidia';
            if ($openaiApiKey) $attempts[] = 'openai';
        } else {
            if ($nvidiaApiKey) $attempts[] = 'nvidia';
            if ($geminiApiKey) $attempts[] = 'gemini';
            if ($groqApiKey) $attempts[] = 'groq';
            if ($openaiApiKey) $attempts[] = 'openai';
        }

        $success = false;

         foreach ($attempts as $currentProvider) {
            if ($currentProvider === 'openai') {
                try {
                    $model = config('services.openai.model', 'gpt-4o-mini');
                    $response = Http::timeout(5)->withHeaders([
                        'Authorization' => "Bearer {$openaiApiKey}",
                        'Content-Type' => 'application/json',
                    ])->post('https://api.openai.com/v1/chat/completions', [
                        'model' => $model,
                        'messages' => $messages,
                        'temperature' => 0.7,
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        $answer = $data['choices'][0]['message']['content'] ?? '';
                        if (!empty($answer)) {
                            $success = true;
                            break;
                        }
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('OpenAI call failed, falling back: ' . $e->getMessage());
                }
            } elseif ($currentProvider === 'gemini') {
                try {
                    $model = config('services.gemini.model', 'gemini-2.5-flash');
                    $response = Http::timeout(5)->withHeaders([
                        'Authorization' => "Bearer {$geminiApiKey}",
                        'Content-Type' => 'application/json',
                    ])->post('https://generativelanguage.googleapis.com/v1beta/openai/chat/completions', [
                        'model' => $model,
                        'messages' => $messages,
                        'temperature' => 0.7,
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        $answer = $data['choices'][0]['message']['content'] ?? '';
                        if (!empty($answer)) {
                            $success = true;
                            break;
                        }
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('Gemini call failed, falling back: ' . $e->getMessage());
                }
            } elseif ($currentProvider === 'groq') {
                try {
                    $model = config('services.groq.model', 'llama-3.3-70b-versatile');
                    $response = Http::timeout(5)->withHeaders([
                        'Authorization' => "Bearer {$groqApiKey}",
                        'Content-Type' => 'application/json',
                    ])->post('https://api.groq.com/openai/v1/chat/completions', [
                        'model' => $model,
                        'messages' => $messages,
                        'temperature' => 0.7,
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        $answer = $data['choices'][0]['message']['content'] ?? '';
                        if (!empty($answer)) {
                            $success = true;
                            break;
                        }
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('Groq call failed, falling back: ' . $e->getMessage());
                }
            } elseif ($currentProvider === 'nvidia') {
                try {
                    $model = config('services.nvidia.model', 'nvidia/nemotron-3-ultra-550b-a55b');
                    
                    $payload = [
                        'model' => $model,
                        'messages' => $messages,
                        'temperature' => 0.7,
                        'top_p' => 0.95,
                        'max_tokens' => 4096,
                    ];

                    $response = Http::timeout(5)->withHeaders([
                        'Authorization' => "Bearer {$nvidiaApiKey}",
                        'Content-Type' => 'application/json',
                    ])->post('https://integrate.api.nvidia.com/v1/chat/completions', $payload);

                    if ($response->successful()) {
                        $data = $response->json();
                        $answer = $data['choices'][0]['message']['content'] ?? '';
                        $reasoning = $data['choices'][0]['message']['reasoning_content'] ?? '';

                        if (!empty($reasoning)) {
                            $answer = "<thinking>" . $reasoning . "</thinking>\n" . $answer;
                        }

                        if (!empty($answer)) {
                            $success = true;
                            break;
                        }
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('NVIDIA call failed, falling back: ' . $e->getMessage());
                }
            }
        }

        // Final fallback to mock if all providers failed or no keys were provided
        if (!$success) {
            $answer = $this->getMockResponse($topic, $messageText);
            $answer .= "\n\n*(Info Ustadz AI: Hubungkan AI_PROVIDER dan API_KEY yang aktif di file .env Anda)*";
        }

        // 5. Check if the AI triggered any system actions
        $actionMessage = '';
        if (preg_match('/<action>(.*?)<\/action>/s', $answer, $matches)) {
            $actionData = json_decode($matches[1], true);
            if ($actionData && isset($actionData['type'])) {
                $actionResult = $this->executeStudentAction($actionData['type'], $actionData['params'] ?? [], $user);
                if ($actionResult['success']) {
                    $actionMessage = "\n\n*Sistem: " . $actionResult['message'] . "*";
                } else {
                    $actionMessage = "\n\n*Sistem (Gagal): " . $actionResult['message'] . "*";
                }
            }
            $answer = preg_replace('/<action>.*?<\/action>/s', '', $answer);
            $answer .= $actionMessage;
        }

        // 6. Save assistant's reply
        $user->aiChats()->create([
            'topic' => $topic,
            'role' => 'assistant',
            'message' => $answer
        ]);

        return response()->json([
            'success' => true,
            'message' => $answer
        ]);
    }

    /**
     * Local Mock responses tailored per topic.
     */
    private function getMockResponse($topic, $message)
    {
        $message = strtolower($message);

        if ($topic === 'absen') {
            return "Maaf, Ustadz AI tidak bisa memproses absensi tanpa API Key NVIDIA yang aktif. Pastikan API Key di file .env Anda terisi dan benar.";
        }

        if ($topic === 'materi') {
            if (str_contains($message, 'fiqih') || str_contains($message, 'hukum')) {
                return "Belajar fiqih sangatlah penting untuk mengetahui sah tidaknya ibadah kita. Rasulullah SAW bersabda: 'Barang siapa yang dikehendaki kebaikan oleh Allah, maka Dia akan memahamkannya dalam urusan agama.' (HR. Bukhari). Ada topik fiqih spesifik yang sedang dipelajari di kajian pondok saat ini?";
            }
            return "Pertanyaan yang bagus mengenai materi kajian! Menuntut ilmu adalah kewajiban setiap Muslim. Ingatlah untuk selalu mencatat pelajaran agar ilmu tersebut terikat dan bisa diamalkan dengan baik.";
        }

        if ($topic === 'spiritual') {
            return "Ustadz sangat mengerti, rasa lelah atau futur (jenuh) dalam beribadah adalah hal yang manusiawi. Rasulullah SAW bersabda: 'Setiap amal itu ada masa semangatnya, dan setiap masa semangat itu ada masa jenuhnya.' (HR. Ahmad). Istirahat sejenak, perbarui niat ikhlas karena Allah, dan jangan ragu untuk berdiskusi dengan partner Mitsur-mu.";
        }

        if ($topic === 'istiqomah') {
            return "Agar tetap istiqomah, mulailah dari amalan yang kecil namun dikerjakan secara konsisten (rutin). Allah sangat menyukai amalan tersebut sebagaimana sabda Nabi SAW: 'Amalan yang paling dicintai oleh Allah adalah amalan yang kontinu walaupun sedikit.' (HR. Muslim). Buatlah jadwal harian dan patuhi pelan-pelan.";
        }

        if ($topic === 'adab') {
            return "Adab mendahului ilmu. Para ulama terdahulu mempelajari adab selama puluhan tahun sebelum mempelajari ilmu. Jagalah adab di majelis ilmu, dengarkan penjelasan guru dengan khidmat, dan hormati sesama santri agar ilmu yang kita peroleh membawa keberkahan dunia dan akhirat.";
        }

        return "MasyaAllah. Tetap semangat ya dalam belajar dan beribadah di pondok pesantren Daaru Hiraa!";
    }

    /**
     * Execute actions requested by the student AI agent.
     */
    private function executeStudentAction($type, $params, $user)
    {
        if ($type === 'create_leave_request') {
            try {
                $student = $user;
                if (!$student) {
                    return ['success' => false, 'message' => 'Data santri tidak ditemukan untuk user ini.'];
                }

                $leaveType = $params['type'] ?? 'izin';
                if (!in_array($leaveType, ['izin', 'cuti', 'sakit'])) {
                    $leaveType = 'izin';
                }

                $startDate = $params['start_date'] ?? now()->toDateString();
                $endDate = $params['end_date'] ?? $startDate;
                $reason = $params['reason'] ?? 'Izin via Ustadz AI';
                $coveredSessions = $params['covered_sessions'] ?? ['Kajian', 'Sholat', 'Tahsin', 'Acara'];

                $leave = \App\Models\LeaveRequest::create([
                    'student_id' => $student->id,
                    'type' => $leaveType,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'reason' => $reason,
                    'covered_sessions' => $coveredSessions,
                    'status' => 'pending',
                ]);

                return [
                    'success' => true,
                    'message' => "Pengajuan {$leave->type_label} berhasil dikirim secara otomatis untuk tanggal {$startDate} s/d {$endDate} dengan alasan '{$reason}'."
                ];
            } catch (\Exception $e) {
                return ['success' => false, 'message' => 'Gagal membuat pengajuan: ' . $e->getMessage()];
            }
        }

        return ['success' => false, 'message' => 'Tindakan tidak dikenal.'];
    }
}
