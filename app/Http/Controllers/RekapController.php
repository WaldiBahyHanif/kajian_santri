<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RekapController extends Controller
{
    private const VALID_SESSIONS = ['Kajian', 'Tahsin', 'Liqo'];

    private function resolveSessionType(Request $request): string
    {
        $type = $request->get('session_type', 'Kajian');
        return in_array($type, self::VALID_SESSIONS, true) ? $type : 'Kajian';
    }

    private function getActiveSantris()
    {
        return Student::select(['id', 'name'])
            ->where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->orderBy('name', 'asc')
            ->get();
    }

    public static function resolveBulananActiveDates(int $month, int $year, string $sessionType): array
    {
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;

        if ($sessionType === 'Liqo') {
            // Liqo tidak punya jadwal tetap harian/mingguan di level aplikasi (tiap
            // kelompok MR bebas menentukan sendiri) - jadi "hari KBM" hanya tanggal
            // yang benar-benar punya submission, bukan diasumsikan setiap hari.
            $existingLogDates = AttendanceLog::whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->where('session_type', 'Liqo')
                ->distinct('attendance_date')
                ->pluck('attendance_date')
                ->toArray();

            $activeDates = [];
            foreach ($existingLogDates as $dateStr) {
                $dt = Carbon::parse($dateStr);
                $activeDates[$dateStr] = [
                    'date'          => $dateStr,
                    'day'           => $dt->day,
                    'day_name'      => \App\Models\Setting::getDayName($dt->dayOfWeekIso, true),
                    'day_name_full' => \App\Models\Setting::getDayName($dt->dayOfWeekIso, false),
                ];
            }
            ksort($activeDates);
            return array_values($activeDates);
        }

        if ($sessionType !== 'Tahsin') {
            $activeDates = [];
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $dt = Carbon::create($year, $month, $day);
                $activeDates[] = [
                    'date'          => $dt->toDateString(),
                    'day'           => $day,
                    'day_name'      => \App\Models\Setting::getDayName($dt->dayOfWeekIso, true),
                    'day_name_full' => \App\Models\Setting::getDayName($dt->dayOfWeekIso, false),
                ];
            }
            return $activeDates;
        }

        // Khusus Tahsin: Filter berdasarkan 2 hari jadwal yang ditentukan Admin + tanggal riil yang ada datanya
        $tahsinDays = \App\Models\Setting::getTahsinDays(); // [2, 5]
        $existingLogDates = AttendanceLog::whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->where('session_type', 'Tahsin')
            ->distinct('attendance_date')
            ->pluck('attendance_date')
            ->toArray();

        $datesMap = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dt = Carbon::create($year, $month, $day);
            $dateStr = $dt->toDateString();
            if (in_array($dt->dayOfWeekIso, $tahsinDays, true) || in_array($dateStr, $existingLogDates, true)) {
                $datesMap[$dateStr] = [
                    'date'          => $dateStr,
                    'day'           => $day,
                    'day_name'      => \App\Models\Setting::getDayName($dt->dayOfWeekIso, true),
                    'day_name_full' => \App\Models\Setting::getDayName($dt->dayOfWeekIso, false),
                ];
            }
        }

        ksort($datesMap);
        return array_values($datesMap);
    }


    /**
     * Overview page: charts and navigation cards.
     */
    public function index(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);
        $sessionType = $this->resolveSessionType($request);

        $santris = $this->getActiveSantris();

        $cacheKey = "rekap_overview_{$sessionType}_{$month}_{$year}";
        $ttl = now()->month == $month && now()->year == $year ? 15 * 60 : 60 * 60;

        [$totalKBMDays, $studentStats, $sessionStats] = Cache::remember($cacheKey, $ttl, function () use ($month, $year, $santris, $sessionType) {

            // Total KBM days for selected session type
            $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->where('session_type', $sessionType)
                ->distinct('attendance_date')
                ->count('attendance_date');

            // Ambil semua log bulan ini sekaligus — 1 query
            $allLogs = AttendanceLog::selectRaw('student_id, status, COUNT(*) as count')
                ->whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->where('session_type', $sessionType)
                ->groupBy('student_id', 'status')
                ->get()
                ->groupBy('student_id');

            $studentStats = [];
            foreach ($santris as $santri) {
                $logs = $allLogs->get($santri->id, collect());
                $hadir = $logs->whereIn('status', ['H', 'I'])->sum('count');
                $total = $logs->sum('count');
                $percentage = $totalKBMDays > 0 ? round(($hadir / $totalKBMDays) * 100) : 0;

                $studentStats[] = [
                    'name'       => $santri->name,
                    'hadir'      => $hadir,
                    'total'      => $total,
                    'kbm'        => $totalKBMDays,
                    'percentage' => $percentage,
                ];
            }

            // Sort by percentage descending
            usort($studentStats, fn($a, $b) => $b['percentage'] <=> $a['percentage']);

            // Per-session-type ring chart — 1 query GROUP BY
            $sessionRaw = AttendanceLog::selectRaw('session_type, status, COUNT(*) as count')
                ->whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->whereIn('session_type', ['Kajian', 'Subuh', 'Tahsin', 'Liqo'])
                ->groupBy('session_type', 'status')
                ->get()
                ->groupBy('session_type');

            $sessionStats = [];
            foreach (['Kajian', 'Subuh', 'Tahsin', 'Liqo'] as $type) {
                $rows = $sessionRaw->get($type, collect());
                $totalLogs = $rows->sum('count');
                $hadirLogs = $rows->whereIn('status', ['H', 'I'])->sum('count');
                $sessionStats[$type] = [
                    'total'      => $totalLogs,
                    'hadir'      => $hadirLogs,
                    'percentage' => $totalLogs > 0 ? round(($hadirLogs / $totalLogs) * 100) : 0,
                ];
            }

            return [$totalKBMDays, $studentStats, $sessionStats];
        });

        return view('rekap', compact(
            'month', 'year', 'studentStats', 'sessionStats', 'totalKBMDays', 'sessionType'
        ));
    }

    /**
     * Detail table page: weekly / monthly / yearly grid.
     */
    public function detail(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);
        $view = $request->get('view', 'bulanan');
        $selectedDate = $request->get('date', now()->toDateString());
        $sessionType = $this->resolveSessionType($request);

        $santris = $this->getActiveSantris();

        // Build date for the month
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;

        if ($view === 'tahunan') {
            $cacheKeyTahunan = "rekap_tahunan_{$sessionType}_{$year}";
            [$totalKBMDays, $rows] = Cache::remember($cacheKeyTahunan, 30 * 60, function () use ($month, $year, $santris, $sessionType) {

                $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $month)
                    ->whereYear('attendance_date', $year)
                    ->where('session_type', $sessionType)
                    ->distinct('attendance_date')
                    ->count('attendance_date');

                // Ambil semua hadir per santri per bulan — 1 query
                $yearlyLogs = AttendanceLog::selectRaw('student_id, MONTH(attendance_date) as month, COUNT(*) as count')
                    ->whereYear('attendance_date', $year)
                    ->where('session_type', $sessionType)
                    ->whereIn('status', ['H', 'I'])
                    ->groupBy('student_id', 'month')
                    ->get()
                    ->groupBy('student_id');

                // KBM days per bulan — 1 query with groupBy instead of 12 separate queries
                $kbmRaw = AttendanceLog::selectRaw('MONTH(attendance_date) as month, COUNT(DISTINCT attendance_date) as days')
                    ->whereYear('attendance_date', $year)
                    ->where('session_type', $sessionType)
                    ->groupByRaw('MONTH(attendance_date)')
                    ->pluck('days', 'month');

                $kbmPerBulan = [];
                for ($m = 1; $m <= 12; $m++) {
                    $kbmPerBulan[$m] = $kbmRaw->get($m, 0);
                }

                $rows = [];
                foreach ($santris as $index => $santri) {
                    $santriLogs = $yearlyLogs->get($santri->id, collect())->keyBy('month');
                    $totalHadirYearly = 0;
                    $totalKBMYearly   = 0;
                    $monthlyPercentages = [];

                    for ($m = 1; $m <= 12; $m++) {
                        $hadir    = $santriLogs->has($m) ? $santriLogs[$m]->count : 0;
                        $totalKBM = $kbmPerBulan[$m];

                        $totalHadirYearly += $hadir;
                        $totalKBMYearly   += $totalKBM;

                        $monthlyPercentages[$m] = $totalKBM > 0 ? round(($hadir / $totalKBM) * 100) . '%' : '-';
                    }

                    $yearlyPercentage = $totalKBMYearly > 0 ? round(($totalHadirYearly / $totalKBMYearly) * 100) : 0;

                    $rows[] = [
                        'no'          => $index + 1,
                        'name'        => $santri->name,
                        'months'      => $monthlyPercentages,
                        'total_hadir' => $totalHadirYearly,
                        'total_kbm'   => $totalKBMYearly,
                        'percentage'  => $yearlyPercentage,
                    ];
                }

                return [$totalKBMDays, $rows];
            });

            return view('rekap-detail', compact(
                'month', 'year', 'view', 'daysInMonth', 'rows', 'totalKBMDays', 'sessionType'
            ));
        } elseif ($view === 'mingguan') {
            $carbonDate = Carbon::parse($selectedDate);
            $startOfWeek = $carbonDate->copy()->startOfWeek(); // Monday
            $endOfWeek = $carbonDate->copy()->endOfWeek(); // Sunday

            $weekDays = [];
            $indonesianDayNames = [
                1 => 'Senin',
                2 => 'Selasa',
                3 => 'Rabu',
                4 => 'Kamis',
                5 => 'Jumat',
                6 => 'Sabtu',
                7 => 'Ahad'
            ];

            for ($i = 0; $i < 7; $i++) {
                $currentDay = $startOfWeek->copy()->addDays($i);
                $weekDays[] = [
                    'date' => $currentDay->toDateString(),
                    'day_name' => $indonesianDayNames[$currentDay->dayOfWeekIso],
                    'date_formatted' => $currentDay->format('d/m'),
                ];
            }

            $logs = AttendanceLog::whereBetween('attendance_date', [
                $startOfWeek->toDateString(), 
                $endOfWeek->toDateString()
            ])
            ->where('session_type', $sessionType)
            ->get();

            $grid = [];
            foreach ($logs as $log) {
                $grid[$log->student_id][$log->attendance_date] = $log->status;
            }

            $totalKBMDays = AttendanceLog::whereBetween('attendance_date', [
                $startOfWeek->toDateString(), 
                $endOfWeek->toDateString()
            ])
            ->where('session_type', $sessionType)
            ->distinct('attendance_date')
            ->count('attendance_date');

            $rows = [];
            foreach ($santris as $index => $santri) {
                $hadirCount = 0;
                $statuses = [];

                foreach ($weekDays as $dayInfo) {
                    $dStr = $dayInfo['date'];
                    $status = $grid[$santri->id][$dStr] ?? null;
                    $statuses[$dStr] = $status;

                    if (in_array($status, ['H', 'I'])) {
                        $hadirCount++;
                    }
                }

                $percentage = $totalKBMDays > 0 ? round(($hadirCount / $totalKBMDays) * 100) : 0;

                $rows[] = [
                    'no' => $index + 1,
                    'name' => $santri->name,
                    'statuses' => $statuses,
                    'total_hadir' => $hadirCount,
                    'percentage' => $percentage,
                ];
            }

            $prevWeekDate = $startOfWeek->copy()->subWeek()->toDateString();
            $nextWeekDate = $startOfWeek->copy()->addWeek()->toDateString();

            return view('rekap-detail', compact(
                'month', 'year', 'view', 'rows', 'totalKBMDays', 'weekDays', 
                'selectedDate', 'startOfWeek', 'endOfWeek', 'prevWeekDate', 'nextWeekDate', 'sessionType'
            ));
        } else {
            // Bulanan (default)
            $activeDates = $this->resolveBulananActiveDates($month, $year, $sessionType);

            $logs = AttendanceLog::whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->where('session_type', $sessionType)
                ->get();

            $grid = [];
            foreach ($logs as $log) {
                $grid[$log->student_id][$log->attendance_date] = $log->status;
            }

            $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->where('session_type', $sessionType)
                ->distinct('attendance_date')
                ->count('attendance_date');

            $rows = [];
            foreach ($santris as $index => $santri) {
                $hadirCount = 0;
                $dailyStatuses = [];

                foreach ($activeDates as $dateInfo) {
                    $dateStr = $dateInfo['date'];
                    $status = $grid[$santri->id][$dateStr] ?? null;
                    $dailyStatuses[$dateInfo['day']] = $status;

                    if (in_array($status, ['H', 'I'])) {
                        $hadirCount++;
                    }
                }

                $percentage = $totalKBMDays > 0 ? round(($hadirCount / $totalKBMDays) * 100) : 0;

                $rows[] = [
                    'no'          => $index + 1,
                    'name'        => $santri->name,
                    'statuses'    => $dailyStatuses,
                    'total_hadir' => $hadirCount,
                    'percentage'  => $percentage,
                ];
            }

            return view('rekap-detail', compact(
                'month', 'year', 'view', 'daysInMonth', 'rows', 'totalKBMDays', 'sessionType', 'activeDates'
            ));
        }
    }

    /**
     * Export to Excel.
     */
    public function exportExcel(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);
        $view = $request->get('view', 'bulanan');
        $sessionType = $this->resolveSessionType($request);
        $sessionSuffix = $sessionType === 'Tahsin' ? '_tahsin' : '';

        if ($view === 'tahunan') {
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\RekapTahunanExport($year, $sessionType), 
                "rekap_tahunan{$sessionSuffix}_{$year}.xlsx"
            );
        }

        if ($view === 'mingguan') {
            $date = $request->get('date', now()->toDateString());
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\RekapMingguanExport($date, $sessionType), 
                "rekap_mingguan{$sessionSuffix}_{$date}.xlsx"
            );
        }

        $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $monthNameStr = strtolower($monthNames[$month]);

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\RekapBulananExport($month, $year, $sessionType), 
            "rekap{$sessionSuffix}_{$monthNameStr}_{$year}.xlsx"
        );
    }

    /**
     * Export to PDF.
     */
    public function exportPdf(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);
        $view = $request->get('view', 'bulanan');
        $sessionType = $this->resolveSessionType($request);
        $sessionSuffix = $sessionType === 'Tahsin' ? '_tahsin' : '';

        $santris = $this->getActiveSantris();

        $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $monthName = $monthNames[$month];

        if ($view === 'tahunan') {
            // Ambil semua hadir per santri per bulan — 1 query
            $yearlyLogs = AttendanceLog::selectRaw('student_id, MONTH(attendance_date) as month, COUNT(*) as count')
                ->whereYear('attendance_date', $year)
                ->where('session_type', $sessionType)
                ->whereIn('status', ['H', 'I'])
                ->groupBy('student_id', 'month')
                ->get()
                ->groupBy('student_id');

            // KBM days per bulan — 1 optimized query
            $kbmRaw = AttendanceLog::selectRaw('MONTH(attendance_date) as month, COUNT(DISTINCT attendance_date) as days')
                ->whereYear('attendance_date', $year)
                ->where('session_type', $sessionType)
                ->groupByRaw('MONTH(attendance_date)')
                ->pluck('days', 'month');

            $kbmPerBulan = [];
            for ($m = 1; $m <= 12; $m++) {
                $kbmPerBulan[$m] = $kbmRaw->get($m, 0);
            }

            $rows = [];
            foreach ($santris as $index => $santri) {
                $santriLogs = $yearlyLogs->get($santri->id, collect())->keyBy('month');
                $totalHadirYearly = 0;
                $totalKBMYearly = 0;
                $monthlyPercentages = [];

                for ($m = 1; $m <= 12; $m++) {
                    $hadir = isset($santriLogs[$m]) ? $santriLogs[$m]->count : 0;
                    $totalKBM = $kbmPerBulan[$m];

                    $totalHadirYearly += $hadir;
                    $totalKBMYearly += $totalKBM;

                    $monthlyPercentages[$m] = $totalKBM > 0 ? round(($hadir / $totalKBM) * 100) . '%' : '-';
                }

                $yearlyPercentage = $totalKBMYearly > 0 ? round(($totalHadirYearly / $totalKBMYearly) * 100) : 0;

                $rows[] = [
                    'no' => $index + 1,
                    'name' => $santri->name,
                    'months' => $monthlyPercentages,
                    'total_hadir' => $totalHadirYearly,
                    'total_kbm' => $totalKBMYearly,
                    'percentage' => $yearlyPercentage,
                ];
            }

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.rekap-tahunan-pdf', compact('year', 'rows'))
                ->setPaper('a4', 'landscape');

            return $pdf->download("rekap_tahunan{$sessionSuffix}_{$year}.pdf");
        } elseif ($view === 'mingguan') {
            $selectedDate = $request->get('date', now()->toDateString());
            $carbonDate = Carbon::parse($selectedDate);
            $startOfWeek = $carbonDate->copy()->startOfWeek();
            $endOfWeek = $carbonDate->copy()->endOfWeek();

            $weekDays = [];
            $indonesianDayNames = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad'];

            for ($i = 0; $i < 7; $i++) {
                $currentDay = $startOfWeek->copy()->addDays($i);
                $weekDays[] = [
                    'date' => $currentDay->toDateString(),
                    'day_name' => $indonesianDayNames[$i],
                    'date_formatted' => $currentDay->format('d/m'),
                ];
            }

            $logs = AttendanceLog::whereBetween('attendance_date', [
                $startOfWeek->toDateString(), 
                $endOfWeek->toDateString()
            ])
            ->where('session_type', $sessionType)
            ->get();

            $grid = [];
            foreach ($logs as $log) {
                $grid[$log->student_id][$log->attendance_date] = $log->status;
            }

            $totalKBMDays = AttendanceLog::whereBetween('attendance_date', [
                $startOfWeek->toDateString(), 
                $endOfWeek->toDateString()
            ])
            ->where('session_type', $sessionType)
            ->distinct('attendance_date')
            ->count('attendance_date');

            $rows = [];
            foreach ($santris as $index => $santri) {
                $hadirCount = 0;
                $statuses = [];

                foreach ($weekDays as $dayInfo) {
                    $dStr = $dayInfo['date'];
                    $status = $grid[$santri->id][$dStr] ?? null;
                    $statuses[$dStr] = $status;

                    if (in_array($status, ['H', 'I'])) {
                        $hadirCount++;
                    }
                }

                $percentage = $totalKBMDays > 0 ? round(($hadirCount / $totalKBMDays) * 100) : 0;

                $rows[] = [
                    'no' => $index + 1,
                    'name' => $santri->name,
                    'statuses' => $statuses,
                    'total_hadir' => $hadirCount,
                    'percentage' => $percentage,
                ];
            }

            $startOfWeekFormatted = $startOfWeek->isoFormat('D MMMM Y');
            $endOfWeekFormatted = $endOfWeek->isoFormat('D MMMM Y');
            $startOfWeek = $startOfWeek->toDateString();
            $endOfWeek = $endOfWeek->toDateString();

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.rekap-mingguan-pdf', compact(
                'rows', 'totalKBMDays', 'weekDays', 'startOfWeek', 'endOfWeek', 'startOfWeekFormatted', 'endOfWeekFormatted'
            ))->setPaper('a4', 'landscape');

            return $pdf->download("rekap_mingguan{$sessionSuffix}_{$selectedDate}.pdf");
        }

        // Harian / Bulanan (default)
        $activeDates = $this->resolveBulananActiveDates($month, $year, $sessionType);
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
        $logs = AttendanceLog::whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->where('session_type', $sessionType)
            ->get();

        $grid = [];
        foreach ($logs as $log) {
            $grid[$log->student_id][$log->attendance_date] = $log->status;
        }

        $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->where('session_type', $sessionType)
            ->distinct('attendance_date')
            ->count('attendance_date');

        $rows = [];
        foreach ($santris as $index => $santri) {
            $hadirCount = 0;
            $dailyStatuses = [];

            foreach ($activeDates as $dateInfo) {
                $dateStr = $dateInfo['date'];
                $status = $grid[$santri->id][$dateStr] ?? null;
                $dailyStatuses[$dateInfo['day']] = $status;

                if (in_array($status, ['H', 'I'])) {
                    $hadirCount++;
                }
            }

            $percentage = $totalKBMDays > 0 ? round(($hadirCount / $totalKBMDays) * 100) : 0;

            $rows[] = [
                'no'          => $index + 1,
                'name'        => $santri->name,
                'statuses'    => $dailyStatuses,
                'total_hadir' => $hadirCount,
                'percentage'  => $percentage,
            ];
        }

        $sessionTitle = $sessionType === 'Tahsin' ? 'Tahsin & Tahfidz' : 'Kajian Rutin';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.rekap-bulanan-pdf', compact(
            'monthName', 'year', 'daysInMonth', 'rows', 'totalKBMDays', 'sessionType', 'sessionTitle', 'activeDates'
        ))->setPaper('a4', 'landscape');

        $monthNameStr = strtolower($monthName);
        return $pdf->download("rekap{$sessionSuffix}_{$monthNameStr}_{$year}.pdf");
    }
}
