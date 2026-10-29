<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->title === 'Admin') {
            return redirect()->route('admin.dashboard');
        }

        // Recent logs: user-specific
        $recentLogs = $user->attendanceLogs()->latest()->take(7)->get()->reverse()->values();
        
        // Top 3 streaks santri (direct query)
        $topStreaks = Student::where('status_aktif', 'Aktif')
            ->orderBy('current_streak', 'desc')
            ->orderBy('name', 'asc')
            ->take(3)
            ->get();

        // All streaks dengan LIMIT 50
        $allStreaks = Student::select(['id', 'name', 'current_streak', 'avatar', 'title'])
            ->where('status_aktif', 'Aktif')
            ->orderBy('current_streak', 'desc')
            ->orderBy('name', 'asc')
            ->limit(50)
            ->get();

        // Refleksi terbaru (diambil lebih banyak untuk carousel 5-per-halaman di home)
        $reflections = \App\Models\Reflection::with(['user', 'topic'])
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        // Persentase Kehadiran Kajian Hari Ini
        $todayDate = now()->toDateString();
        $totalSantri = Student::where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->count();
        
        $todaySummary = AttendanceLog::selectRaw('session_type, status, COUNT(*) as c')
            ->where('attendance_date', $todayDate)
            ->whereIn('session_type', ['Kajian', 'Tahsin'])
            ->groupBy('session_type', 'status')
            ->get()
            ->groupBy('session_type');

        $buildStats = function (string $type) use ($todaySummary, $totalSantri) {
            $rows = $todaySummary->get($type, collect())->pluck('c', 'status');
            $h = (int) $rows->get('H', 0);
            $i = (int) $rows->get('I', 0);
            $s = (int) $rows->get('S', 0);
            return (object) [
                'total_santri' => $totalSantri,
                'hadir'        => $h,
                'izin'         => $i,
                'sakit'        => $s,
                'alpha'        => max(0, $totalSantri - ($h + $i + $s)),
                'percentage'   => $totalSantri > 0 ? round(($h / $totalSantri) * 100) : 0,
                'has_session'  => $rows->isNotEmpty(),
            ];
        };

        $attendanceStats = $buildStats('Kajian');
        $tahsinStats = $buildStats('Tahsin');
        $percentage = $attendanceStats->percentage;

        // Hitung Stage Kebun Kebaikan Kartun (1=Benih, 2=Tunas, 3=Pohon Rimbun, 4=Pohon Berbuah)
        if ($percentage >= 85) {
            $gardenStage = 4;
        } elseif ($percentage >= 60) {
            $gardenStage = 3;
        } elseif ($percentage >= 30) {
            $gardenStage = 2;
        } else {
            $gardenStage = 1;
        }

        // Jadwal Sholat Otomatis Maguwoharjo, Sleman, DIY: cached 24 jam (simpan sebagai array di cache)
        $prayerTimesArray = Cache::remember('prayer_times_sleman_' . $todayDate, now()->endOfDay(), function () {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(2)
                    ->get('https://api.aladhan.com/v1/timings', [
                        'latitude'  => -7.7656,
                        'longitude' => 110.4308,
                        'method'    => 20, // Kemenag / MWL standard for ID
                    ]);

                if ($response->successful()) {
                    $timings = $response->json('data.timings');
                    if ($timings) {
                        return [
                            'Fajr'     => substr($timings['Fajr'] ?? '04:35', 0, 5),
                            'Sunrise'  => substr($timings['Sunrise'] ?? '05:48', 0, 5),
                            'Dhuhr'    => substr($timings['Dhuhr'] ?? '11:52', 0, 5),
                            'Asr'      => substr($timings['Asr'] ?? '15:12', 0, 5),
                            'Maghrib'  => substr($timings['Maghrib'] ?? '17:50', 0, 5),
                            'Isha'     => substr($timings['Isha'] ?? '19:00', 0, 5),
                            'location' => 'Maguwoharjo, Sleman, DIY',
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Fallback jika offline/timeout
            }

            return [
                'Fajr'     => '04:35',
                'Sunrise'  => '05:48',
                'Dhuhr'    => '11:52',
                'Asr'      => '15:12',
                'Maghrib'  => '17:50',
                'Isha'     => '19:00',
                'location' => 'Maguwoharjo, Sleman, DIY',
            ];
        });
        $prayerTimes = (object) $prayerTimesArray;

        // Upcoming kajian
        $upcomingKajianRaw = \App\Models\Kajian::with(['asatiz', 'program'])
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $upcomingKajian = collect();
        foreach ($upcomingKajianRaw as $k) {
            $id = data_get($k, 'id');
            if (!$id) continue;

            $item = new \stdClass();
            $item->id = 'event_' . $id;
            $item->is_routine = false;
            $item->title = data_get($k, 'title');
            $item->asatiz = data_get($k, 'asatiz');
            $item->asatiz_id = data_get($k, 'asatiz_id');
            $item->program = data_get($k, 'program');
            $rawDate = data_get($k, 'date');
            $item->date = $rawDate instanceof \Carbon\Carbon ? $rawDate : \Carbon\Carbon::parse($rawDate);
            $item->time = data_get($k, 'time');
            $item->location = data_get($k, 'location');
            $item->description = data_get($k, 'description');
            $item->quota = data_get($k, 'quota');

            $kajianDateTime = \Carbon\Carbon::parse($item->date->format('Y-m-d') . ' ' . $item->time);
            $diffInMinutes = now()->diffInMinutes($kajianDateTime, false);

            $item->diff_in_minutes = $diffInMinutes;
            $item->is_incoming_soon = ($diffInMinutes > 0 && $diffInMinutes <= 30);
            $item->is_ongoing = ($diffInMinutes <= 0 && $diffInMinutes >= -90);

            $upcomingKajian->push($item);
        }

        // Topics rutin
        $topics = \App\Models\Topic::with('asatiz')->get();

        $routineKajian = collect();

        for ($i = 0; $i < 7; $i++) {
            $currentDate = now()->addDays($i);
            $dayOfWeekIso = $currentDate->dayOfWeekIso;

            $dayTopics = collect($topics)->filter(fn($t) => data_get($t, 'day_index') == $dayOfWeekIso);

            foreach ($dayTopics as $topic) {
                $topicId = data_get($topic, 'id');
                if (!$topicId) continue;

                $item = new \stdClass();
                $item->id = 'routine_' . $topicId;
                $item->is_routine = true;
                $item->title = data_get($topic, 'title');
                $item->asatiz = data_get($topic, 'asatiz');
                $item->asatiz_id = data_get($topic, 'asatiz_id');
                $item->program = null;
                $item->date = $currentDate->copy()->startOfDay();
                $item->time = data_get($topic, 'start_time') ?? '00:00:00';
                $item->location = 'Aula Utama Pondok';
                $item->description = data_get($topic, 'description');
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
        
        // Setting: query langsung 1 row
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

        // Kebun Pondok: pohon pixel art per-santri (persentase kehadiran Kajian 30 hari terakhir)
        $villageStudents = Student::where('status_aktif', 'Aktif')
            ->where('title', '!=', 'Admin')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'avatar']);

        $villageStartDate = now()->subDays(29)->toDateString();
        $villageEndDate = now()->toDateString();

        $villageHadirCounts = AttendanceLog::selectRaw('student_id, COUNT(*) as c')
            ->where('session_type', 'Kajian')
            ->where('status', 'H')
            ->where('attendance_date', '>=', $villageStartDate)
            ->where('attendance_date', '<=', $villageEndDate)
            ->groupBy('student_id')
            ->pluck('c', 'student_id');

        $villageStudents = $villageStudents->map(function ($student) use ($villageHadirCounts) {
            $count = (int) ($villageHadirCounts[$student->id] ?? 0);
            $villagePercentage = min(100, ($count / 30) * 100);

            $student->hadir_count = $count;
            $student->attendance_pct = (int) round($villagePercentage);

            if ($villagePercentage >= 85) {
                $student->garden_stage = 4;
            } elseif ($villagePercentage >= 60) {
                $student->garden_stage = 3;
            } elseif ($villagePercentage >= 30) {
                $student->garden_stage = 2;
            } else {
                $student->garden_stage = 1;
            }

            return $student;
        });

        // Santri yang butuh perhatian (untuk Musyrif)
        $flaggedSantri = collect();
        if ($user->title === 'Musyrif') {
            $flaggedSantri = \App\Models\DailyMood::with('student')
                ->whereIn('mood_type', ['Futur', 'Butuh Cerita'])
                ->whereDate('created_at', now()->toDateString())
                ->get();
        }
        
        return view('dashboard', compact(
            'user', 
            'recentLogs', 
            'topStreaks', 
            'allStreaks', 
            'reflections', 
            'attendanceStats',
            'tahsinStats',
            'prayerTimes',
            'gardenStage',
            'villageStudents',
            'nextKajians',
            'setting',
            'flaggedSantri'
        ));
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
