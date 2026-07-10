<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->title === 'Admin') {
            return redirect()->route('admin.dashboard');
        }

        $recentLogs = $user->attendanceLogs()->latest()->take(7)->get()->reverse()->values();
        
        $topStreaks = Student::where('status_aktif', 'Aktif')
            ->orderBy('current_streak', 'desc')
            ->orderBy('name', 'asc')
            ->take(3)
            ->get();

        $allStreaks = Student::select(['id', 'name', 'current_streak', 'avatar', 'title', 'room'])
            ->where('status_aktif', 'Aktif')
            ->orderBy('current_streak', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        $reflections = \App\Models\Reflection::with('user')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Mood Tracker Integration
        $todayMood = \App\Models\DailyMood::where('student_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        // Get past 7 days of moods (for SVG chart)
        $pastMoods = \App\Models\DailyMood::where('student_id', $user->id)
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->orderBy('created_at', 'asc')
            ->get();

        // Musyrif Alert Integration
        $flaggedSantri = [];
        if ($user->title === 'Musyrif') {
            $flaggedSantri = \App\Models\DailyMood::with('student')
                ->whereDate('created_at', now()->toDateString())
                ->whereIn('mood_type', ['Futur', 'Butuh Cerita'])
                ->get();
        }

        // Load upcoming kajian (event)
        $upcomingKajianRaw = \App\Models\Kajian::with(['asatiz', 'program'])
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $upcomingKajian = collect();
        foreach ($upcomingKajianRaw as $k) {
            $item = new \stdClass();
            $item->id = 'event_' . $k->id;
            $item->is_routine = false;
            $item->title = $k->title;
            $item->asatiz = $k->asatiz;
            $item->asatiz_id = $k->asatiz_id;
            $item->program = $k->program;
            $item->date = \Carbon\Carbon::parse($k->date);
            $item->time = $k->time;
            $item->location = $k->location;
            $item->description = $k->description;
            $item->quota = $k->quota;

            $kajianDateTime = \Carbon\Carbon::parse($item->date->format('Y-m-d') . ' ' . $item->time);
            $diffInMinutes = now()->diffInMinutes($kajianDateTime, false);

            $item->diff_in_minutes = $diffInMinutes;
            $item->is_incoming_soon = ($diffInMinutes > 0 && $diffInMinutes <= 30);
            $item->is_ongoing = ($diffInMinutes <= 0 && $diffInMinutes >= -90);

            $upcomingKajian->push($item);
        }

        // Load kajian tetap (rutin)
        $topics = \App\Models\Topic::with('asatiz')->get();
        $routineKajian = collect();

        for ($i = 0; $i < 7; $i++) {
            $currentDate = now()->addDays($i);
            $dayOfWeekIso = $currentDate->dayOfWeekIso;

            $dayTopics = $topics->where('day_index', $dayOfWeekIso);

            foreach ($dayTopics as $topic) {
                $item = new \stdClass();
                $item->id = 'routine_' . $topic->id;
                $item->is_routine = true;
                $item->title = $topic->title;
                $item->asatiz = $topic->asatiz;
                $item->asatiz_id = $topic->asatiz_id;
                $item->program = null;
                $item->date = $currentDate->copy()->startOfDay();
                $item->time = $topic->start_time ?? '00:00:00';
                $item->location = 'Aula Utama Pondok';
                $item->description = $topic->description;
                $item->quota = null;

                $kajianDateTime = \Carbon\Carbon::parse($currentDate->format('Y-m-d') . ' ' . $item->time);
                $diffInMinutes = now()->diffInMinutes($kajianDateTime, false);

                $item->diff_in_minutes = $diffInMinutes;
                $item->is_incoming_soon = ($diffInMinutes > 0 && $diffInMinutes <= 30);
                $item->is_ongoing = ($diffInMinutes <= 0 && $diffInMinutes >= -90);

                $routineKajian->push($item);
            }
        }

        // Merge, filter past sessions, sort and limit to 3
        $nextKajians = $upcomingKajian->concat($routineKajian)
            ->filter(function($item) {
                $kajianDateTime = \Carbon\Carbon::parse($item->date->format('Y-m-d') . ' ' . $item->time);
                return now()->isBefore($kajianDateTime->addMinutes(90));
            })
            ->sortBy(function($item) {
                return $item->date->format('Y-m-d') . ' ' . $item->time;
            })
            ->take(3)
            ->values();
        
        $setting = \App\Models\Setting::first();
        if (!$setting) {
            $setting = \App\Models\Setting::create([
                'id' => 1,
                'announcement_text' => '',
                'is_popup_active' => false,
                'garden_status' => 'subur',
                'garden_message' => 'Selamat beraktivitas! Mari hiasi hari kita dengan zikir dan kajian berilmu di pondok Daaru Hiraa.',
            ]);
        }

        // Hitung status kebun otomatis atau gunakan manual berdasarkan setting
        if (($setting->garden_mode ?? 'auto') === 'auto') {
            $todayStr = now()->toDateString();
            $totalStudents = Student::where('status_aktif', 'Aktif')->whereIn('title', ['Santri', 'Musyrif'])->count();
            $presentToday = AttendanceLog::where('attendance_date', $todayStr)->where('status', 'H')->count();
            $attendanceRate = $totalStudents > 0 ? ($presentToday / $totalStudents) * 100 : 0;
            $reflectionsCount = \App\Models\Reflection::whereDate('created_at', '>=', now()->startOfDay())->count();

            // Tentukan status dinamis
            $autoStatus = 'subur';
            if ($attendanceRate >= 75 && $reflectionsCount >= 3) {
                $autoStatus = 'subur_sekali';
            } elseif ($attendanceRate >= 45 || $reflectionsCount >= 1) {
                $autoStatus = 'subur';
            } elseif ($attendanceRate > 0 && $reflectionsCount == 0) {
                $autoStatus = 'biasa';
            } else {
                $autoStatus = 'kering';
            }

            // Terapkan ke setting runtime agar dibaca oleh view
            $setting->garden_status = $autoStatus;
        }
        
        return view('dashboard', compact(
            'user', 
            'recentLogs', 
            'topStreaks', 
            'allStreaks', 
            'reflections', 
            'todayMood', 
            'pastMoods',
            'flaggedSantri',
            'nextKajians',
            'setting'
        ));
    }

    public function askAI(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500'
        ]);

        $question = $request->input('question');
        $apiKey = env('NVIDIA_API_KEY');

        if (!$apiKey) {
            // Local mock response
            return response()->json([
                'success' => true,
                'answer' => $this->getMockResponse($question) . "\n\n*(Info Ustadz AI: Hubungkan NVIDIA_API_KEY di file .env Anda untuk jawaban bertenaga DeepSeek)*"
            ]);
        }

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type' => 'application/json',
            ])->post('https://integrate.api.nvidia.com/v1/chat/completions', [
                'model' => 'deepseek-ai/deepseek-v4-flash',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Kamu adalah Ustadz AI, pembimbing rohani virtual yang bijaksana untuk santri di pondok pesantren Daaru Hiraa. Jawab pertanyaan berikut dengan santun, memotivasi, dan sertakan dalil (Quran/Hadits) jika relevan: \n\n{$question}"
                    ]
                ],
                'temperature' => 1,
                'top_p' => 0.95,
                'max_tokens' => 4096,
                'extra_body' => [
                    'chat_template_kwargs' => [
                        'thinking' => true,
                        'reasoning_effort' => 'high'
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $answer = $data['choices'][0]['message']['content'] ?? 'Maaf, Ustadz AI sedang tidak bisa menjawab saat ini.';
                return response()->json([
                    'success' => true,
                    'answer' => $answer
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal terhubung dengan API DeepSeek (NVIDIA).'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getMockResponse($question)
    {
        $question = strtolower($question);
        
        if (str_contains($question, 'tanya') || str_contains($question, 'halo') || str_contains($question, 'assalamualaikum')) {
            return "Wa'alaikumussalam warahmatullahi wabarakatuh. Halo santri! Saya Ustadz AI. Apa yang bisa saya bantu hari ini seputar ibadah, ilmu, atau materi kajian?";
        }
        if (str_contains($question, 'malas') || str_contains($question, 'semangat') || str_contains($question, 'bosan') || str_contains($question, 'lelah')) {
            return "Ketika malas atau jenuh (futur) melanda dalam belajar, ingatlah sabda Rasulullah SAW: 'Setiap amal itu ada masa semangatnya, dan setiap masa semangat itu ada masa jenuhnya.' (HR. Ahmad). Tips dari ustadz: mulailah dengan amalan kecil tapi rutin, perbarui niat belajarmu karena Allah, dan cari teman belajar shalih yang saling menyemangati.";
        }
        if (str_contains($question, 'zikir') || str_contains($question, 'tasbih') || str_contains($question, 'wirid')) {
            return "Zikir adalah penyejuk hati kita. Allah SWT berfirman: 'Ingatlah, hanya dengan mengingati Allah-lah hati menjadi tenteram.' (QS. Ar-Ra'd: 28). Rutinkanlah membaca zikir pagi dan petang di menu 'Tasbih Digital' di aplikasi ini untuk mengisi waktu luangmu dengan pahala.";
        }
        if (str_contains($question, 'absensi') || str_contains($question, 'hadir') || str_contains($question, 'scan') || str_contains($question, 'qr')) {
            return "Disiplin hadir di majelis ilmu memiliki keutamaan luar biasa. Rasulullah SAW bersabda: 'Barang siapa menempuh suatu jalan untuk mencari ilmu, maka Allah akan memudahkan jalannya menuju surga.' (HR. Muslim). Selalu lakukan scan absensi QR tepat waktu ya sebagai wujud keseriusan belajarmu.";
        }
        if (str_contains($question, 'refleksi') || str_contains($question, 'jurnal') || str_contains($question, 'menulis')) {
            return "Menulis refleksi harian membantu kita bermuhasabah diri setiap harinya. Imam Syafi'i rahimahullah berkata: 'Ikatlah ilmu dengan menulisnya.' Gunakan menu Refleksi Harian untuk merenungi pelajaran berharga yang kamu petik hari ini.";
        }
        if (str_contains($question, 'mitsur') || str_contains($question, 'duo') || str_contains($question, 'pasangan')) {
            return "Fitur Mitsur Duo dirancang agar santri saling mendukung dan menyemangati dalam ibadah dan belajar. Carilah partner belajar yang shalih dan rajinlah berdiskusi atau saling mengirim pesan motivasi harian.";
        }
        
        return "Pertanyaan yang luar biasa! Sebagai penuntut ilmu, teruslah haus akan wawasan keislaman yang bermanfaat. Allah SWT berfirman: 'Maka bertanyalah kepada orang yang mempunyai pengetahuan jika kamu tidak mengetahui.' (QS. An-Nahl: 43). Tetap istiqomah dalam belajar ya!";
    }

    public function storeMood(Request $request)
    {
        $request->validate([
            'mood_type' => 'required|in:Bersemangat,Biasa,Futur,Butuh Cerita'
        ]);

        $user = Auth::user();

        $todayMood = \App\Models\DailyMood::where('student_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        if ($todayMood) {
            $todayMood->update([
                'mood_type' => $request->mood_type
            ]);
        } else {
            \App\Models\DailyMood::create([
                'student_id' => $user->id,
                'mood_type' => $request->mood_type,
                'created_at' => now()
            ]);
        }

        $message = 'Alhamdulillah, kondisi ruhani hari ini berhasil dicatat!';
        if (in_array($request->mood_type, ['Futur', 'Butuh Cerita'])) {
            $message = 'Kondisi ruhani dicatat. Tetap semangat santri! Partner Mitsur Anda telah dikabari.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function storeSaran(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        \App\Models\Suggestion::create([
            'student_id' => Auth::id(),
            'message' => $request->input('message'),
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Saran & masukan Anda berhasil dikirim ke Admin Daaru Hiraa! Terima kasih.');
    }

    public function syncZikir(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:1|max:1000'
        ]);

        $user = Auth::user();
        $newTotal = ($user->total_zikir ?? 0) + $request->count;
        $user->update([
            'total_zikir' => $newTotal
        ]);

        return response()->json([
            'success' => true,
            'total_zikir' => $newTotal
        ]);
    }
}
