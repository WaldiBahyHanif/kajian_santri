<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\AttendanceLog;
use App\Models\Asatiz;
use App\Models\Topic;
use App\Models\Reflection;
use App\Models\Suggestion;
use App\Models\Kajian;
use App\Models\AsatizAttendance;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $today = Carbon::today()->toDateString();

        // Statistik utama
        $totalSantri = Student::where('title', 'Santri')->where('status_aktif', 'Aktif')->count();
        $totalMusyrif = Student::where('title', 'Musyrif')->where('status_aktif', 'Aktif')->count();
        $totalUstadz = Asatiz::count();
        $totalTopik = Topic::count();

        $hadirHariIni = AttendanceLog::where('attendance_date', $today)
            ->whereIn('status', ['H', 'I'])
            ->where('session_type', 'Kajian')
            ->count();

        $persen = ($totalSantri > 0) ? round(($hadirHariIni / $totalSantri) * 100) : 0;

        // Refleksi & saran terbaru
        $refleksiTerbaru = Reflection::orderBy('created_at', 'desc')->take(5)->get();
        $saranTerbaru = Suggestion::orderBy('created_at', 'desc')->take(5)->get();

        // Ustadz scheduled for today (from asatiz_attendance table — recorded)
        $recordedAttendances = AsatizAttendance::with('asatiz')
            ->whereDate('attendance_date', $today)
            ->get();

        // Kajian tetap (rutin) hari ini from topics table (day_index: 1=Mon ... 7=Sun)
        $todayDayIndex = Carbon::today()->dayOfWeekIso; // 1=Monday ... 7=Sunday
        $todayTopics = Topic::with('asatiz')
            ->where('day_index', $todayDayIndex)
            ->get();

        // Build combined list: topics not already in recordedAttendances (by asatiz_id)
        $recordedAsatizIds = $recordedAttendances->pluck('asatiz_id')->toArray();
        $unrecordedTopics = $todayTopics->filter(fn($t) => !in_array($t->asatiz_id, $recordedAsatizIds));

        // Convert unrecorded topics to stdClass objects mimicking AsatizAttendance for the view
        $syntheticAttendances = $unrecordedTopics->map(function ($t) use ($today) {
            $obj = new \stdClass();
            $obj->id = null;
            $obj->asatiz_id = $t->asatiz_id;
            $obj->kajian_topic = $t->title . ($t->start_time ? ' (' . substr($t->start_time, 0, 5) . ' WIB)' : '');
            $obj->attendance_date = $today;
            $obj->status = null;
            $obj->asatiz = $t->asatiz;
            $obj->topic_id = $t->id;
            $obj->is_synthetic = true;
            return $obj;
        });

        // Merge: real attendances first, then synthetic
        $todayUstadzAttendances = $recordedAttendances->concat($syntheticAttendances->values());

        // Absensi 7 hari terakhir — 1 query GROUP BY (bukan 7 query terpisah)
        $startDate = Carbon::today()->subDays(6)->toDateString();
        $endDate   = Carbon::today()->toDateString();

        $rawAbsensi = AttendanceLog::selectRaw('attendance_date, COUNT(*) as count')
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->whereIn('status', ['H', 'I'])
            ->where('session_type', 'Kajian')
            ->groupBy('attendance_date')
            ->pluck('count', 'attendance_date');

        $absensi7Hari = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $absensi7Hari[] = [
                'date'  => Carbon::parse($date)->translatedFormat('d M'),
                'count' => $rawAbsensi[$date] ?? 0,
            ];
        }

        $stats = [
            'total_santri' => $totalSantri,
            'total_musyrif' => $totalMusyrif,
            'total_ustadz' => $totalUstadz,
            'total_topik' => $totalTopik,
            'hadir' => $hadirHariIni,
            'persen' => $persen,
        ];

        return view('admin.dashboard', compact('stats', 'refleksiTerbaru', 'saranTerbaru', 'absensi7Hari', 'todayUstadzAttendances'));
    }

    public function syncStreaks()
    {
        $santris = Student::where('status_aktif', 'Aktif')->get();

        foreach ($santris as $santri) {
            $santri->recalculateStats();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Semua streak santri berhasil disinkronkan!');
    }
}
