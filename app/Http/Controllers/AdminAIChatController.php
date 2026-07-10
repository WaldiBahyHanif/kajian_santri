<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\AttendanceLog;
use App\Models\Announcement;
use App\Models\AdminActivityLog;
use App\Models\Student;
use App\Models\Asatiz;
use App\Models\AsatizAttendance;
use App\Models\Kajian;
use App\Models\StudentWarning;
use App\Models\ActivityEvent;
use App\Models\Suggestion;
use App\Models\MitsurPair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminAIChatController extends Controller
{
    public function index()
    {
        $history = session()->get('admin_ai_chat_history', []);
        return view('admin.ai-assistant', compact('history'));
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000'
        ]);

        // Perpanjang batas waktu eksekusi PHP agar tidak mati saat menunggu AI API
        set_time_limit(300); // 5 menit
        ini_set('max_execution_time', 300);

        $messageText = $request->input('message');

        // 1. Get/Initialize History from Session
        $history = session()->get('admin_ai_chat_history', []);

        // Append user's message
        $history[] = [
            'role'       => 'user',
            'message'    => $messageText,
            'created_at' => now()->toDateTimeString()
        ];

        // Keep last 20 messages for context limit
        if (count($history) > 20) {
            $history = array_slice($history, -20);
        }

        // ─────────────────────────────────────────────────
        // 2. Fetch data RINGKAS untuk System Prompt
        // (Hanya data penting — jaga agar prompt tetap kecil)
        // ─────────────────────────────────────────────────

        // --- Statistik cepat ---
        $totalAktif  = Student::where('status_aktif','Aktif')->whereIn('title',['Santri','Musyrif'])->count();
        $totalAlumni = Student::where('status_aktif','Lulus')->count();
        $totalAsatiz = Asatiz::count();
        $totalKajian = Kajian::count();

        // --- Izin Pending ---
        $pendingLeaves = LeaveRequest::with('student')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();
        $totalPending = $pendingLeaves->count();

        $pendingLeavesText = "Tidak ada izin pending.";
        if ($pendingLeaves->isNotEmpty()) {
            $arr = [];
            foreach ($pendingLeaves as $l) {
                $arr[] = "[ID:{$l->id}] " . ($l->student->name ?? 'N/A')
                    . " | {$l->type_label} | {$l->start_date->format('d/m')}–{$l->end_date->format('d/m')}"
                    . " | '{$l->reason}'";
            }
            $pendingLeavesText = implode("\n", $arr);
        }

        // --- Top 5 Alpha ---
        $topAbsentees = AttendanceLog::where('status','A')
            ->selectRaw('student_id, count(*) as count')
            ->groupBy('student_id')->orderByDesc('count')
            ->with('student')->take(5)->get();
        $absenteesText = "Tidak ada data alpha.";
        if ($topAbsentees->isNotEmpty()) {
            $arr = [];
            foreach ($topAbsentees as $a) {
                if ($a->student) $arr[] = "- {$a->student->name} [ID:{$a->student->id}] → {$a->count}x alpha";
            }
            $absenteesText = implode("\n", $arr);
        }

        // --- Pengumuman Aktif ---
        $announcementsText = "Tidak ada pengumuman aktif.";
        $anns = Announcement::where('is_active',true)->orderBy('created_at','desc')->take(3)->get();
        if ($anns->isNotEmpty()) {
            $announcementsText = $anns->map(fn($a) => "[ID:{$a->id}] {$a->message}")->implode("\n");
        }

        // --- Ustadz (kompak) ---
        $asatizListText = Asatiz::orderBy('name')->get()->map(fn($u) => "[{$u->id}] {$u->name}")->implode(" | ");
        if (!$asatizListText) $asatizListText = "Belum ada ustadz.";

        // --- 5 Kajian Terbaru ---
        $kajianListText = "Belum ada kajian.";
        $kajians = Kajian::with('asatiz')->orderBy('date','desc')->take(5)->get();
        if ($kajians->isNotEmpty()) {
            $kajianListText = $kajians->map(fn($k) =>
                "[ID:{$k->id}] {$k->title} | " . ($k->asatiz->name ?? '-') . " | {$k->date->format('Y-m-d')} {$k->time}"
            )->implode("\n");
        }

        // --- SP Terbaru (kompak) ---
        $warningsText = "Tidak ada SP.";
        $warns = StudentWarning::with('student')->orderBy('id','desc')->take(5)->get();
        if ($warns->isNotEmpty()) {
            $warningsText = $warns->map(fn($w) =>
                "[ID:{$w->id}] " . ($w->student->name ?? 'N/A') . " SP-{$w->sp_number} {$w->period_label}"
            )->implode("\n");
        }

        // --- SANTRI: hanya 30 terbaru (untuk referensi ID) ---
        $santriRef = Student::select(['id','name','title','universitas','angkatan','generation','room'])
            ->where('status_aktif','Aktif')
            ->orderBy('name')
            ->take(30)
            ->get()
            ->map(fn($s) => "[{$s->id}]{$s->name}" . ($s->universitas ? "/{$s->universitas}" : "") . ($s->angkatan ? "/{$s->angkatan}" : ""))
            ->implode(" | ");
        $santriRefNote = "(Untuk cari santri lain, minta admin sebutkan nama/ID lebih spesifik)";

        // ─────────────────────────────────────────────────
        // 3. Bangun System Prompt RINGKAS
        // ─────────────────────────────────────────────────
        $now = $this->now()->translatedFormat('l, d F Y H:i');
        $systemPrompt = <<<PROMPT
Kamu adalah Asisten AI Admin Pondok Pesantren **Daaru Hiraa**. Cekatan, bijaksana, dan bisa melakukan aksi operasional langsung.
Waktu sekarang: $now WIB.

## STATISTIK
Santri Aktif: $totalAktif | Alumni: $totalAlumni | Ustadz: $totalAsatiz | Kajian: $totalKajian | Izin Pending: $totalPending

## IZIN PENDING (perlu diproses)
$pendingLeavesText

## TOP 5 ALPHA TERBANYAK
$absenteesText

## PENGUMUMAN AKTIF
$announcementsText

## USTADZ / ASATIZ
$asatizListText

## 5 KAJIAN TERBARU
$kajianListText

## SP TERBARU
$warningsText

## REFERENSI SANTRI (30 pertama, A-Z)
$santriRef
$santriRefNote

## AKSI YANG TERSEDIA
Kirim tag <action>JSON</action> di akhir balasan jika ada perintah. Format:

Perizinan: {"type":"approve_leave_request","params":{"id":ID}} | {"type":"reject_leave_request","params":{"id":ID,"reason":"alasan"}}
Pengumuman: {"type":"create_announcement","params":{"message":"teks"}} | {"type":"delete_announcement","params":{"id":ID}}
Absen Santri: {"type":"set_attendance","params":{"date":"YYYY-MM-DD","default_status":"H","exceptions":[{"student_id":ID,"status":"A"}]}}
Hapus Absen: {"type":"delete_attendance","params":{"date":"YYYY-MM-DD","student_id":ID}}
Absen Ustadz: {"type":"set_asatiz_attendance","params":{"asatiz_id":ID,"date":"YYYY-MM-DD","status":"H","kajian_topic":"topik"}}
Hapus Absen Ustadz: {"type":"delete_asatiz_attendance","params":{"date":"YYYY-MM-DD","asatiz_id":ID}}
Tambah Santri: {"type":"create_student","params":{"name":"Nama","username":"user","title":"Santri","room":"A1","generation":"Ang-X","universitas":"UGM","angkatan":2023,"status_aktif":"Aktif"}}
Update Santri: {"type":"update_student","params":{"student_id":ID,"name":"Nama","universitas":"Univ","angkatan":2023}}
Reset Password: {"type":"reset_password","params":{"student_id":ID,"new_password":"pass"}}
Hapus Santri: {"type":"delete_student","params":{"student_id":ID}}
Tambah Ustadz: {"type":"create_asatiz","params":{"name":"Nama"}}
Update Ustadz: {"type":"update_asatiz","params":{"asatiz_id":ID,"name":"Nama"}}
Hapus Ustadz: {"type":"delete_asatiz","params":{"asatiz_id":ID}}
Buat Kajian: {"type":"create_kajian","params":{"title":"Judul","asatiz_id":ID,"date":"YYYY-MM-DD","time":"19:30","location":"Masjid"}}
Update Kajian: {"type":"update_kajian","params":{"kajian_id":ID,"title":"Judul"}}
Hapus Kajian: {"type":"delete_kajian","params":{"kajian_id":ID}}
SP: {"type":"issue_warning","params":{"student_id":ID,"sp_number":1,"period_label":"Mei-Jun 2025","attendance_percentage":45.5,"threshold":75,"pengasuh_name":"Pengasuh","musyrif_name":"Musyrif"}}
Hapus SP: {"type":"delete_warning","params":{"warning_id":ID}}
Event: {"type":"create_activity_event","params":{"title":"Nama","event_date":"YYYY-MM-DD","location":"Lokasi"}}

Jangan kirim <action> jika hanya bertanya / data tidak lengkap.
Jika admin menyebut nama santri yang tidak ada di referensi, tanyakan ID-nya.
Untuk update BANYAK santri sekaligus (mis. 5 nama), kirim MULTIPLE <action> tag berurutan.
PROMPT;

        // ─────────────────────────────────────────────────
        // 4. Bangun payload messages
        // ─────────────────────────────────────────────────
        $messages = [];
        $messages[] = ['role' => 'system', 'content' => $systemPrompt];
        foreach ($history as $msg) {
            $messages[] = [
                'role'    => $msg['role'],
                'content' => $msg['message']
            ];
        }

        // ─────────────────────────────────────────────────
        // 5. Kirim ke AI Provider (dengan fallback otomatis)
        // ─────────────────────────────────────────────────
        $provider     = config('services.openai.provider', 'nvidia');
        $nvidiaApiKey = config('services.nvidia.api_key');
        $openaiApiKey = config('services.openai.api_key');
        $geminiApiKey = config('services.gemini.api_key');
        $groqApiKey   = config('services.groq.api_key');
        $answer       = '';
        $success      = false;

        $attempts = [];
        if ($provider === 'openai') {
            if ($openaiApiKey) $attempts[] = 'openai';
            if ($nvidiaApiKey) $attempts[] = 'nvidia';
            if ($geminiApiKey) $attempts[] = 'gemini';
            if ($groqApiKey)   $attempts[] = 'groq';
        } elseif ($provider === 'gemini') {
            if ($geminiApiKey) $attempts[] = 'gemini';
            if ($nvidiaApiKey) $attempts[] = 'nvidia';
            if ($groqApiKey)   $attempts[] = 'groq';
            if ($openaiApiKey) $attempts[] = 'openai';
        } elseif ($provider === 'groq') {
            if ($groqApiKey)   $attempts[] = 'groq';
            if ($geminiApiKey) $attempts[] = 'gemini';
            if ($nvidiaApiKey) $attempts[] = 'nvidia';
            if ($openaiApiKey) $attempts[] = 'openai';
        } else { // default: nvidia
            if ($nvidiaApiKey) $attempts[] = 'nvidia';
            if ($geminiApiKey) $attempts[] = 'gemini';
            if ($groqApiKey)   $attempts[] = 'groq';
            if ($openaiApiKey) $attempts[] = 'openai';
        }

        foreach ($attempts as $currentProvider) {
            if ($currentProvider === 'openai') {
                try {
                    $model    = config('services.openai.model', 'gpt-4o-mini');
                    $response = Http::timeout(90)->withHeaders([
                        'Authorization' => "Bearer {$openaiApiKey}",
                        'Content-Type'  => 'application/json',
                    ])->post('https://api.openai.com/v1/chat/completions', [
                        'model'       => $model,
                        'messages'    => $messages,
                        'temperature' => 0.6,
                    ]);
                    if ($response->successful()) {
                        $data   = $response->json();
                        $answer = $data['choices'][0]['message']['content'] ?? '';
                        if (!empty($answer)) { $success = true; break; }
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('Admin AI OpenAI failed: ' . $e->getMessage());
                }

            } elseif ($currentProvider === 'gemini') {
                try {
                    $model    = config('services.gemini.model', 'gemini-2.5-flash');
                    $response = Http::timeout(90)->withHeaders([
                        'Authorization' => "Bearer {$geminiApiKey}",
                        'Content-Type'  => 'application/json',
                    ])->post('https://generativelanguage.googleapis.com/v1beta/openai/chat/completions', [
                        'model'       => $model,
                        'messages'    => $messages,
                        'temperature' => 0.6,
                    ]);
                    if ($response->successful()) {
                        $data   = $response->json();
                        $answer = $data['choices'][0]['message']['content'] ?? '';
                        if (!empty($answer)) { $success = true; break; }
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('Admin AI Gemini failed: ' . $e->getMessage());
                }

            } elseif ($currentProvider === 'groq') {
                try {
                    $model    = config('services.groq.model', 'llama-3.3-70b-versatile');
                    $response = Http::timeout(90)->withHeaders([
                        'Authorization' => "Bearer {$groqApiKey}",
                        'Content-Type'  => 'application/json',
                    ])->post('https://api.groq.com/openai/v1/chat/completions', [
                        'model'       => $model,
                        'messages'    => $messages,
                        'temperature' => 0.6,
                    ]);
                    if ($response->successful()) {
                        $data   = $response->json();
                        $answer = $data['choices'][0]['message']['content'] ?? '';
                        if (!empty($answer)) { $success = true; break; }
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('Admin AI Groq failed: ' . $e->getMessage());
                }

            } elseif ($currentProvider === 'nvidia') {
                try {
                    $model    = config('services.nvidia.model', 'nvidia/nemotron-3-ultra-550b-a55b');
                    $response = Http::timeout(90)->withHeaders([
                        'Authorization' => "Bearer {$nvidiaApiKey}",
                        'Content-Type'  => 'application/json',
                    ])->post('https://integrate.api.nvidia.com/v1/chat/completions', [
                        'model'       => $model,
                        'messages'    => $messages,
                        'temperature' => 0.6,
                        'top_p'       => 0.95,
                        'max_tokens'  => 4096,
                    ]);
                    if ($response->successful()) {
                        $data      = $response->json();
                        $answer    = $data['choices'][0]['message']['content'] ?? '';
                        $reasoning = $data['choices'][0]['message']['reasoning_content'] ?? '';
                        if (!empty($reasoning)) {
                            $answer = "<thinking>" . $reasoning . "</thinking>\n" . $answer;
                        }
                        if (!empty($answer)) { $success = true; break; }
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('Admin AI NVIDIA failed: ' . $e->getMessage());
                }
            }
        }

        if (!$success) {
            $answer = "Maaf, asisten AI sedang tidak dapat terhubung. Pastikan API Key sudah dikonfigurasi di file .env (NVIDIA/GEMINI/GROQ/OPENAI).";
        }

        // ─────────────────────────────────────────────────
        // 6. Eksekusi Action-Action jika ada
        // ─────────────────────────────────────────────────
        if (preg_match_all('/<action>(.*?)<\/action>/s', $answer, $matches)) {
            $actionResults = [];
            foreach ($matches[1] as $match) {
                $actionData = json_decode(trim($match), true);
                if ($actionData && isset($actionData['type'])) {
                    $actionResult = $this->executeAdminAction($actionData['type'], $actionData['params'] ?? []);
                    $prefix = $actionResult['success'] ? "\n✅ *Sistem: " : "\n❌ *Sistem (Gagal): ";
                    $actionResults[] = $prefix . $actionResult['message'] . "*";
                }
            }
            // Hapus semua tag action dari teks utama jawaban
            $answer = preg_replace('/<action>.*?<\/action>/s', '', $answer);
            
            // Gabungkan hasil eksekusi di bagian paling akhir
            if (!empty($actionResults)) {
                $answer .= "\n" . implode("\n", $actionResults);
            }
        }

        // 7. Simpan balasan & update session
        $history[] = [
            'role'       => 'assistant',
            'message'    => $answer,
            'created_at' => now()->toDateTimeString()
        ];
        session()->put('admin_ai_chat_history', $history);

        return response()->json([
            'success' => true,
            'message' => $answer
        ]);
    }

    /**
     * Helper: now() wrapper agar bisa digunakan di heredoc.
     */
    private function now(): Carbon
    {
        return Carbon::now();
    }

    /**
     * Reset chat history.
     */
    public function clearHistory()
    {
        session()->forget('admin_ai_chat_history');
        return redirect()->route('admin.ai.assistant')
            ->with('success', 'Riwayat obrolan asisten AI berhasil dihapus.');
    }

    /**
     * Eksekusi semua aksi administratif dari AI Agent.
     */
    private function executeAdminAction(string $type, array $params): array
    {
        try {
            $adminId = Auth::guard('admin')->id();

            // ────────────────────────────────
            // 1. SETUJUI IZIN
            // ────────────────────────────────
            if ($type === 'approve_leave_request') {
                $leave = LeaveRequest::findOrFail($params['id']);
                if ($leave->status !== 'pending') {
                    return ['success' => false, 'message' => "Izin ID #{$params['id']} sudah diproses sebelumnya."];
                }
                $leave->approve($adminId);
                AdminActivityLog::log('approve_izin', "Menyetujui {$leave->type_label} dari {$leave->student->name} (tgl {$leave->start_date->translatedFormat('d M Y')}) via AI");
                return ['success' => true, 'message' => "Izin ID #{$leave->id} dari {$leave->student->name} berhasil DISETUJUI."];
            }

            // ────────────────────────────────
            // 2. TOLAK IZIN
            // ────────────────────────────────
            if ($type === 'reject_leave_request') {
                $leave  = LeaveRequest::findOrFail($params['id']);
                if ($leave->status !== 'pending') {
                    return ['success' => false, 'message' => "Izin ID #{$params['id']} sudah diproses sebelumnya."];
                }
                $reason = $params['reason'] ?? 'Ditolak via AI Assistant';
                $leave->reject($adminId, $reason);
                AdminActivityLog::log('reject_izin', "Menolak {$leave->type_label} dari {$leave->student->name} via AI: {$reason}");
                return ['success' => true, 'message' => "Izin ID #{$leave->id} dari {$leave->student->name} DITOLAK. Alasan: '{$reason}'."];
            }

            // ────────────────────────────────
            // 3. BUAT PENGUMUMAN
            // ────────────────────────────────
            if ($type === 'create_announcement') {
                if (empty($params['message'])) {
                    return ['success' => false, 'message' => 'Konten pengumuman tidak boleh kosong.'];
                }
                $ann = Announcement::create(['message' => $params['message'], 'is_active' => true]);
                AdminActivityLog::log('create_announcement', "Membuat pengumuman via AI: " . substr($params['message'], 0, 60));
                return ['success' => true, 'message' => "Pengumuman baru (ID#{$ann->id}) berhasil dipublikasikan ke seluruh santri."];
            }

            // ────────────────────────────────
            // 4. HAPUS / NONAKTIFKAN PENGUMUMAN
            // ────────────────────────────────
            if ($type === 'delete_announcement') {
                $ann = Announcement::findOrFail($params['id']);
                $msg = substr($ann->message, 0, 50);
                $ann->delete();
                AdminActivityLog::log('delete_announcement', "Menghapus pengumuman ID#{$params['id']} via AI: '{$msg}...'");
                return ['success' => true, 'message' => "Pengumuman ID#{$params['id']} berhasil dihapus/dinonaktifkan."];
            }

            // ────────────────────────────────
            // 5. SET ABSENSI SANTRI
            // ────────────────────────────────
            if ($type === 'set_attendance') {
                $date          = $params['date'] ?? now()->toDateString();
                $defaultStatus = strtoupper($params['default_status'] ?? 'H');
                $exceptions    = $params['exceptions'] ?? [];
                $validStatuses = ['H', 'I', 'S', 'A'];
                if (!in_array($defaultStatus, $validStatuses)) $defaultStatus = 'H';

                $students      = Student::where('status_aktif', 'Aktif')->whereIn('title', ['Santri', 'Musyrif'])->get();
                $exceptionsMap = [];
                foreach ($exceptions as $exc) {
                    if (isset($exc['student_id'], $exc['status'])) {
                        $sv = strtoupper($exc['status']);
                        if (in_array($sv, $validStatuses)) {
                            $exceptionsMap[$exc['student_id']] = $sv;
                        }
                    }
                }

                $updatedCount = 0;
                foreach ($students as $santri) {
                    $status = $exceptionsMap[$santri->id] ?? $defaultStatus;
                    $log    = AttendanceLog::firstOrNew([
                        'student_id'      => $santri->id,
                        'attendance_date' => $date,
                        'session_type'    => 'Kajian',
                    ]);
                    $log->status       = $status;
                    $log->kajian_topic = 'Kajian Rutin';
                    if (!$log->exists) $log->attendance_time = now();
                    $log->save();
                    $santri->recalculateStats();
                    $updatedCount++;
                }

                $formattedDate = Carbon::parse($date)->translatedFormat('l, d F Y');
                $desc = "Absen Kajian tgl {$formattedDate}: {$updatedCount} santri → {$defaultStatus}";
                if ($exceptionsMap) {
                    $excDetails = [];
                    foreach ($exceptionsMap as $sId => $st) {
                        $excDetails[] = ($students->firstWhere('id', $sId)?->name ?? "ID#{$sId}") . " ({$st})";
                    }
                    $desc .= ", kecuali: " . implode(', ', $excDetails);
                }
                AdminActivityLog::log('set_attendance', "$desc via AI");
                return ['success' => true, 'message' => "Absensi berhasil dicatat. $desc."];
            }

            // ────────────────────────────────
            // 6. HAPUS ABSENSI SANTRI
            // ────────────────────────────────
            if ($type === 'delete_attendance') {
                $date      = $params['date'] ?? now()->toDateString();
                $studentId = $params['student_id'] ?? null;
                $query     = AttendanceLog::where('attendance_date', $date);
                if ($studentId) $query->where('student_id', $studentId);
                $deletedCount = $query->delete();

                Student::where('status_aktif', 'Aktif')->whereIn('title', ['Santri','Musyrif'])->get()
                    ->each(fn($s) => $s->recalculateStats());

                $formattedDate = Carbon::parse($date)->translatedFormat('l, d F Y');
                $target        = $studentId ? "Santri ID#{$studentId}" : "seluruh santri";
                AdminActivityLog::log('delete_attendance', "Hapus absensi $target tgl {$formattedDate} via AI");
                return ['success' => true, 'message' => "Berhasil menghapus {$deletedCount} entri absensi {$target} pada {$formattedDate}."];
            }

            // ────────────────────────────────
            // 7. SET ABSENSI USTADZ
            // ────────────────────────────────
            if ($type === 'set_asatiz_attendance') {
                $asatizId = $params['asatiz_id'] ?? null;
                if (!$asatizId) return ['success' => false, 'message' => 'ID Ustadz wajib disertakan.'];
                $asatiz      = Asatiz::findOrFail($asatizId);
                $date        = $params['date'] ?? now()->toDateString();
                $status      = strtoupper($params['status'] ?? 'H');
                $kajianTopic = $params['kajian_topic'] ?? 'Kajian Rutin';
                $validSt     = ['H', 'I', 'S', 'A'];
                if (!in_array($status, $validSt)) $status = 'H';

                AsatizAttendance::updateOrCreate(
                    ['asatiz_id' => $asatiz->id, 'attendance_date' => $date],
                    ['status' => $status, 'kajian_topic' => $kajianTopic]
                );
                $formattedDate = Carbon::parse($date)->translatedFormat('l, d F Y');
                $statusLabels  = ['H' => 'Hadir', 'I' => 'Izin', 'S' => 'Sakit', 'A' => 'Alpha'];
                AdminActivityLog::log('set_asatiz_attendance', "Absen Ustadz {$asatiz->name} tgl {$formattedDate}: {$statusLabels[$status]} via AI");
                return ['success' => true, 'message' => "Absensi Ustadz {$asatiz->name} tgl {$formattedDate}: {$statusLabels[$status]}."];
            }

            // ────────────────────────────────
            // 8. HAPUS ABSENSI USTADZ
            // ────────────────────────────────
            if ($type === 'delete_asatiz_attendance') {
                $asatizId = $params['asatiz_id'] ?? null;
                if (!$asatizId) return ['success' => false, 'message' => 'ID Ustadz wajib disertakan.'];
                $asatiz   = Asatiz::findOrFail($asatizId);
                $date     = $params['date'] ?? now()->toDateString();
                AsatizAttendance::where('asatiz_id', $asatiz->id)->where('attendance_date', $date)->delete();
                $formattedDate = Carbon::parse($date)->translatedFormat('l, d F Y');
                AdminActivityLog::log('delete_asatiz_attendance', "Hapus absensi Ustadz {$asatiz->name} tgl {$formattedDate} via AI");
                return ['success' => true, 'message' => "Absensi Ustadz {$asatiz->name} pada {$formattedDate} berhasil dihapus."];
            }

            // ────────────────────────────────
            // 9. TAMBAH SANTRI BARU
            // ────────────────────────────────
            if ($type === 'create_student') {
                $name     = $params['name'] ?? null;
                $username = $params['username'] ?? null;
                if (!$name || !$username) {
                    return ['success' => false, 'message' => 'Nama dan Username wajib disertakan.'];
                }
                if (Student::where('username', $username)->exists()) {
                    return ['success' => false, 'message' => "Username '{$username}' sudah digunakan."];
                }
                $student = Student::create([
                    'name'        => $name,
                    'username'    => $username,
                    'title'       => $params['title'] ?? 'Santri',
                    'room'        => $params['room'] ?? null,
                    'generation'  => $params['generation'] ?? null,
                    'universitas' => $params['universitas'] ?? null,
                    'angkatan'    => !empty($params['angkatan']) ? (int)$params['angkatan'] : null,
                    'status_aktif'=> $params['status_aktif'] ?? 'Aktif',
                    'password'    => Hash::make('123456'),
                ]);
                AdminActivityLog::log('create_santri', "Tambah santri baru: {$student->name} via AI");
                return ['success' => true, 'message' => "Santri baru '{$student->name}' (Username: {$student->username}) berhasil ditambahkan. Password default: 123456."];
            }

            // Helper resolusi santri secara dinamis (ID numerik atau Nama parsial)
            $findStudent = function ($studentId) {
                if (empty($studentId)) return null;
                if (is_numeric($studentId)) {
                    return Student::find($studentId);
                }
                return Student::where('name', 'like', "%{$studentId}%")
                    ->orWhere('username', $studentId)
                    ->first();
            };

            // ────────────────────────────────
            // 10. UPDATE DATA SANTRI
            // ────────────────────────────────
            if ($type === 'update_student') {
                $studentId = $params['student_id'] ?? null;
                if (!$studentId) return ['success' => false, 'message' => 'ID/Nama Santri wajib disertakan.'];
                
                $student = $findStudent($studentId);
                if (!$student) {
                    return ['success' => false, 'message' => "Santri dengan ID/Nama '{$studentId}' tidak ditemukan."];
                }

                $updateData = [];
                if (isset($params['name']))        $updateData['name']        = $params['name'];
                if (isset($params['username'])) {
                    if (Student::where('username', $params['username'])->where('id', '!=', $student->id)->exists()) {
                        return ['success' => false, 'message' => "Username '{$params['username']}' sudah digunakan oleh santri lain."];
                    }
                    $updateData['username'] = $params['username'];
                }
                if (isset($params['title']))        $updateData['title']        = $params['title'];
                if (isset($params['room']))         $updateData['room']         = $params['room'];
                if (isset($params['generation']))   $updateData['generation']   = $params['generation'];
                if (isset($params['universitas']))  $updateData['universitas']  = $params['universitas'];
                if (isset($params['angkatan']))     $updateData['angkatan']     = !empty($params['angkatan']) ? (int)$params['angkatan'] : null;
                if (isset($params['status_aktif'])) $updateData['status_aktif'] = $params['status_aktif'];
                
                $student->update($updateData);
                AdminActivityLog::log('update_santri', "Update data santri: {$student->name} via AI");
                return ['success' => true, 'message' => "Data santri '{$student->name}' berhasil diperbarui."];
            }

            // ────────────────────────────────
            // 11. RESET PASSWORD SANTRI
            // ────────────────────────────────
            if ($type === 'reset_password') {
                $studentId   = $params['student_id'] ?? null;
                $newPassword = $params['new_password'] ?? '123456';
                if (!$studentId) return ['success' => false, 'message' => 'ID/Nama Santri wajib disertakan.'];

                $student = $findStudent($studentId);
                if (!$student) {
                    return ['success' => false, 'message' => "Santri dengan ID/Nama '{$studentId}' tidak ditemukan."];
                }

                $student->update(['password' => Hash::make($newPassword)]);
                AdminActivityLog::log('reset_password', "Reset password santri: {$student->name} via AI");
                return ['success' => true, 'message' => "Password santri '{$student->name}' berhasil direset. Password baru: '{$newPassword}'."];
            }

            // ────────────────────────────────
            // 12. HAPUS SANTRI
            // ────────────────────────────────
            if ($type === 'delete_student') {
                $studentId = $params['student_id'] ?? null;
                if (!$studentId) return ['success' => false, 'message' => 'ID/Nama Santri wajib disertakan.'];

                $student = $findStudent($studentId);
                if (!$student) {
                    return ['success' => false, 'message' => "Santri dengan ID/Nama '{$studentId}' tidak ditemukan."];
                }

                $name = $student->name;
                $student->delete();
                AdminActivityLog::log('delete_santri', "Hapus santri: {$name} via AI");
                return ['success' => true, 'message' => "Santri '{$name}' berhasil dihapus dari database."];
            }

            // ────────────────────────────────
            // 13. TAMBAH USTADZ
            // ────────────────────────────────
            if ($type === 'create_asatiz') {
                $name = $params['name'] ?? null;
                if (!$name) return ['success' => false, 'message' => 'Nama Ustadz wajib disertakan.'];
                $asatiz = Asatiz::create(['name' => $name]);
                AdminActivityLog::log('create_asatiz', "Tambah ustadz baru: {$asatiz->name} via AI");
                return ['success' => true, 'message' => "Ustadz '{$asatiz->name}' (ID#{$asatiz->id}) berhasil ditambahkan."];
            }

            // ────────────────────────────────
            // 14. UPDATE USTADZ
            // ────────────────────────────────
            if ($type === 'update_asatiz') {
                $asatizId = $params['asatiz_id'] ?? null;
                if (!$asatizId) return ['success' => false, 'message' => 'ID Ustadz wajib disertakan.'];
                $asatiz = Asatiz::findOrFail($asatizId);
                if (isset($params['name'])) $asatiz->update(['name' => $params['name']]);
                AdminActivityLog::log('update_asatiz', "Update ustadz ID#{$asatizId}: {$asatiz->name} via AI");
                return ['success' => true, 'message' => "Data Ustadz ID#{$asatizId} berhasil diperbarui menjadi '{$asatiz->name}'."];
            }

            // ────────────────────────────────
            // 15. HAPUS USTADZ
            // ────────────────────────────────
            if ($type === 'delete_asatiz') {
                $asatizId = $params['asatiz_id'] ?? null;
                if (!$asatizId) return ['success' => false, 'message' => 'ID Ustadz wajib disertakan.'];
                $asatiz = Asatiz::findOrFail($asatizId);
                $name   = $asatiz->name;
                $asatiz->delete();
                AdminActivityLog::log('delete_asatiz', "Hapus ustadz: {$name} via AI");
                return ['success' => true, 'message' => "Ustadz '{$name}' berhasil dihapus."];
            }

            // ────────────────────────────────
            // 16. JADWALKAN KAJIAN BARU
            // ────────────────────────────────
            if ($type === 'create_kajian') {
                $title    = $params['title'] ?? null;
                $asatizId = $params['asatiz_id'] ?? null;
                $date     = $params['date'] ?? null;
                $time     = $params['time'] ?? '19:30';
                if (!$title || !$asatizId || !$date) {
                    return ['success' => false, 'message' => 'Judul, Ustadz ID, dan Tanggal wajib disertakan.'];
                }
                $asatiz = Asatiz::findOrFail($asatizId);
                $kajian = Kajian::create([
                    'title'            => $title,
                    'asatiz_id'        => $asatiz->id,
                    'kajian_program_id'=> 1,
                    'date'             => $date,
                    'time'             => $time,
                    'location'         => $params['location'] ?? 'Masjid',
                    'description'      => $params['description'] ?? null,
                ]);
                AsatizAttendance::create([
                    'asatiz_id'       => $kajian->asatiz_id,
                    'attendance_date' => $kajian->date->toDateString(),
                    'kajian_topic'    => $kajian->title,
                    'status'          => null,
                ]);
                $formattedDate = Carbon::parse($date)->translatedFormat('l, d F Y');
                AdminActivityLog::log('create_kajian', "Jadwal kajian baru: '{$title}' via AI");
                return ['success' => true, 'message' => "Kajian '{$title}' bersama Ustadz {$asatiz->name} dijadwalkan pada {$formattedDate} pukul {$time}."];
            }

            // ────────────────────────────────
            // 17. UPDATE KAJIAN
            // ────────────────────────────────
            if ($type === 'update_kajian') {
                $kajianId = $params['kajian_id'] ?? null;
                if (!$kajianId) return ['success' => false, 'message' => 'ID Kajian wajib disertakan.'];
                $kajian      = Kajian::findOrFail($kajianId);
                $oldAsatizId = $kajian->asatiz_id;
                $oldDate     = $kajian->date->toDateString();
                $updateData  = [];
                if (isset($params['title']))      $updateData['title']      = $params['title'];
                if (isset($params['asatiz_id']))  $updateData['asatiz_id']  = $params['asatiz_id'];
                if (isset($params['date']))        $updateData['date']        = $params['date'];
                if (isset($params['time']))        $updateData['time']        = $params['time'];
                if (isset($params['location']))    $updateData['location']    = $params['location'];
                if (isset($params['description'])) $updateData['description'] = $params['description'];
                $kajian->update($updateData);
                AsatizAttendance::updateOrCreate(
                    ['asatiz_id' => $oldAsatizId, 'attendance_date' => $oldDate],
                    ['asatiz_id' => $kajian->asatiz_id, 'attendance_date' => $kajian->date->toDateString(), 'kajian_topic' => $kajian->title]
                );
                AdminActivityLog::log('update_kajian', "Update kajian: '{$kajian->title}' via AI");
                return ['success' => true, 'message' => "Kajian '{$kajian->title}' berhasil diperbarui."];
            }

            // ────────────────────────────────
            // 18. HAPUS KAJIAN
            // ────────────────────────────────
            if ($type === 'delete_kajian') {
                $kajianId = $params['kajian_id'] ?? null;
                if (!$kajianId) return ['success' => false, 'message' => 'ID Kajian wajib disertakan.'];
                $kajian = Kajian::findOrFail($kajianId);
                $title  = $kajian->title;
                AsatizAttendance::where('asatiz_id', $kajian->asatiz_id)
                    ->whereDate('attendance_date', $kajian->date->toDateString())
                    ->delete();
                $kajian->delete();
                AdminActivityLog::log('delete_kajian', "Hapus kajian: '{$title}' via AI");
                return ['success' => true, 'message' => "Kajian '{$title}' berhasil dihapus/dibatalkan."];
            }

            // ────────────────────────────────
            // 19. KELUARKAN SURAT PERINGATAN (SP)
            // ────────────────────────────────
            if ($type === 'issue_warning') {
                $studentId = $params['student_id'] ?? null;
                if (!$studentId) return ['success' => false, 'message' => 'ID Santri wajib disertakan.'];
                $student  = Student::findOrFail($studentId);
                $spNumber = (int)($params['sp_number'] ?? 1);

                $warning = StudentWarning::create([
                    'student_id'            => $student->id,
                    'sp_number'             => $spNumber,
                    'period_label'          => $params['period_label'] ?? 'Periode ini',
                    'start_date'            => $params['start_date'] ?? now()->startOfMonth()->toDateString(),
                    'end_date'              => $params['end_date'] ?? now()->toDateString(),
                    'attendance_percentage' => $params['attendance_percentage'] ?? 0,
                    'threshold'             => $params['threshold'] ?? 75,
                    'yogyakarta_date'       => now()->toDateString(),
                    'pengasuh_name'         => $params['pengasuh_name'] ?? 'Pengasuh Pondok',
                    'musyrif_name'          => $params['musyrif_name'] ?? '-',
                ]);
                AdminActivityLog::log('issue_warning', "Keluarkan SP ke-{$spNumber} untuk santri: {$student->name} via AI");
                return ['success' => true, 'message' => "Surat Peringatan ke-{$spNumber} untuk '{$student->name}' (ID#{$warning->id}) berhasil dibuat."];
            }

            // ────────────────────────────────
            // 20. HAPUS SP
            // ────────────────────────────────
            if ($type === 'delete_warning') {
                $warningId = $params['warning_id'] ?? null;
                if (!$warningId) return ['success' => false, 'message' => 'ID SP wajib disertakan.'];
                $warning  = StudentWarning::with('student')->findOrFail($warningId);
                $name     = $warning->student->name ?? 'N/A';
                $spNum    = $warning->sp_number;
                $warning->delete();
                AdminActivityLog::log('delete_warning', "Hapus SP ke-{$spNum} santri {$name} via AI");
                return ['success' => true, 'message' => "SP ke-{$spNum} untuk '{$name}' (ID#{$warningId}) berhasil dihapus."];
            }

            // ────────────────────────────────
            // 21. BUAT KEGIATAN / EVENT
            // ────────────────────────────────
            if ($type === 'create_activity_event') {
                $title = $params['title'] ?? null;
                $date  = $params['event_date'] ?? null;
                if (!$title || !$date) return ['success' => false, 'message' => 'Judul dan Tanggal kegiatan wajib disertakan.'];
                $event = ActivityEvent::create([
                    'title'       => $title,
                    'start_date'  => $date,
                    'end_date'    => $params['end_date'] ?? $date,
                    'location'    => $params['location'] ?? null,
                    'description' => $params['description'] ?? null,
                    'type'        => $params['type'] ?? 'acara',
                    'is_active'   => true,
                ]);
                $formattedDate = Carbon::parse($date)->translatedFormat('l, d F Y');
                AdminActivityLog::log('create_event', "Buat kegiatan: '{$title}' tgl {$formattedDate} via AI");
                return ['success' => true, 'message' => "Kegiatan '{$title}' pada {$formattedDate} berhasil dijadwalkan (ID#{$event->id})."];
            }

            return ['success' => false, 'message' => "Tipe aksi '{$type}' tidak dikenal."];

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Admin AI Action Error: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Gagal mengeksekusi aksi: ' . $e->getMessage()];
        }
    }
}
