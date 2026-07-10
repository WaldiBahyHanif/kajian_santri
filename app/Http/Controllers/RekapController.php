<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RekapController extends Controller
{
    /**
     * Overview page: charts and navigation cards.
     */
    public function index(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $santris = Student::select(['id', 'name'])
            ->where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->orderBy('name', 'asc')
            ->get();

        $cacheKey = "rekap_overview_{$month}_{$year}";
        $ttl = now()->month == $month && now()->year == $year ? 15 * 60 : 60 * 60; // 15 menit bulan ini, 1 jam bulan lalu

        [$totalKBMDays, $studentStats, $sessionStats] = Cache::remember($cacheKey, $ttl, function () use ($month, $year, $santris) {

            // Total KBM days
            $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->where('session_type', 'Kajian')
                ->distinct('attendance_date')
                ->count('attendance_date');

            // Ambil semua log bulan ini sekaligus — 1 query, bukan N query
            $allLogs = AttendanceLog::selectRaw('student_id, status, COUNT(*) as count')
                ->whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->where('session_type', 'Kajian')
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

            // Sort by percentage descending for bar chart
            usort($studentStats, fn($a, $b) => $b['percentage'] <=> $a['percentage']);

            // Per-session-type ring chart — 1 query GROUP BY
            $sessionRaw = AttendanceLog::selectRaw('session_type, status, COUNT(*) as count')
                ->whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->whereIn('session_type', ['Kajian', 'Subuh', 'Tahsin'])
                ->groupBy('session_type', 'status')
                ->get()
                ->groupBy('session_type');

            $sessionStats = [];
            foreach (['Kajian', 'Subuh', 'Tahsin'] as $type) {
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
            'month', 'year', 'studentStats', 'sessionStats', 'totalKBMDays'
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

        $santris = Student::where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->orderBy('name', 'asc')
            ->get();

        // Build date for the month
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;

        if ($view === 'tahunan') {
            $cacheKeyTahunan = "rekap_tahunan_{$year}";
            [$totalKBMDays, $rows] = Cache::remember($cacheKeyTahunan, 30 * 60, function () use ($month, $year, $santris) {

                // KBM days untuk bulan yang sedang dipilih
                $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $month)
                    ->whereYear('attendance_date', $year)
                    ->where('session_type', 'Kajian')
                    ->distinct('attendance_date')
                    ->count('attendance_date');

                // Ambil semua hadir per santri per bulan — 1 query saja
                $yearlyLogs = AttendanceLog::selectRaw('student_id, MONTH(attendance_date) as month, COUNT(*) as count')
                    ->whereYear('attendance_date', $year)
                    ->where('session_type', 'Kajian')
                    ->whereIn('status', ['H', 'I'])
                    ->groupBy('student_id', 'month')
                    ->get()
                    ->groupBy('student_id');

                // KBM days per bulan — 12 query (1 per bulan, bukan 1 per santri×bulan)
                $kbmPerBulan = [];
                for ($m = 1; $m <= 12; $m++) {
                    $kbmPerBulan[$m] = AttendanceLog::whereMonth('attendance_date', $m)
                        ->whereYear('attendance_date', $year)
                        ->where('session_type', 'Kajian')
                        ->distinct('attendance_date')
                        ->count('attendance_date');
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
                'month', 'year', 'view', 'daysInMonth', 'rows', 'totalKBMDays'
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
            ->where('session_type', 'Kajian')
            ->get();

            $grid = [];
            foreach ($logs as $log) {
                $grid[$log->student_id][$log->attendance_date] = $log->status;
            }

            $totalKBMDays = AttendanceLog::whereBetween('attendance_date', [
                $startOfWeek->toDateString(), 
                $endOfWeek->toDateString()
            ])
            ->where('session_type', 'Kajian')
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
                'selectedDate', 'startOfWeek', 'endOfWeek', 'prevWeekDate', 'nextWeekDate'
            ));
        } else {
            // Bulanan (default)
            $logs = AttendanceLog::whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->where('session_type', 'Kajian')
                ->get();

            $grid = [];
            foreach ($logs as $log) {
                $grid[$log->student_id][$log->attendance_date] = $log->status;
            }

            $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->where('session_type', 'Kajian')
                ->distinct('attendance_date')
                ->count('attendance_date');

            $rows = [];
            foreach ($santris as $index => $santri) {
                $hadirCount = 0;
                $dailyStatuses = [];

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    $status = $grid[$santri->id][$dateStr] ?? null;
                    $dailyStatuses[$day] = $status;

                    if (in_array($status, ['H', 'I'])) {
                        $hadirCount++;
                    }
                }

                $percentage = $totalKBMDays > 0 ? round(($hadirCount / $totalKBMDays) * 100) : 0;

                $rows[] = [
                    'no' => $index + 1,
                    'name' => $santri->name,
                    'statuses' => $dailyStatuses,
                    'total_hadir' => $hadirCount,
                    'percentage' => $percentage,
                ];
            }

            return view('rekap-detail', compact(
                'month', 'year', 'view', 'daysInMonth', 'rows', 'totalKBMDays'
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

        if ($view === 'tahunan') {
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\RekapTahunanExport($year), 
                "rekap_tahunan_{$year}.xlsx"
            );
        }

        if ($view === 'mingguan') {
            $date = $request->get('date', now()->toDateString());
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\RekapMingguanExport($date), 
                "rekap_mingguan_{$date}.xlsx"
            );
        }

        $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $monthNameStr = strtolower($monthNames[$month]);

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\RekapBulananExport($month, $year), 
            "rekap_{$monthNameStr}_{$year}.xlsx"
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

        $santris = Student::where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->orderBy('name', 'asc')
            ->get();

        $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $monthName = $monthNames[$month];

        if ($view === 'tahunan') {
            $rows = [];
            foreach ($santris as $index => $santri) {
                $totalHadirYearly = 0;
                $totalKBMYearly = 0;
                $monthlyPercentages = [];

                for ($m = 1; $m <= 12; $m++) {
                    $hadir = AttendanceLog::where('student_id', $santri->id)
                        ->whereMonth('attendance_date', $m)
                        ->whereYear('attendance_date', $year)
                        ->where('session_type', 'Kajian')
                        ->whereIn('status', ['H', 'I'])
                        ->count();

                    $totalKBM = AttendanceLog::whereMonth('attendance_date', $m)
                        ->whereYear('attendance_date', $year)
                        ->where('session_type', 'Kajian')
                        ->distinct('attendance_date')
                        ->count('attendance_date');

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

            return $pdf->download("rekap_tahunan_{$year}.pdf");
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
            ->where('session_type', 'Kajian')
            ->get();

            $grid = [];
            foreach ($logs as $log) {
                $grid[$log->student_id][$log->attendance_date] = $log->status;
            }

            $totalKBMDays = AttendanceLog::whereBetween('attendance_date', [
                $startOfWeek->toDateString(), 
                $endOfWeek->toDateString()
            ])
            ->where('session_type', 'Kajian')
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

            return $pdf->download("rekap_mingguan_{$selectedDate}.pdf");
        }

        // Harian / Bulanan (default)
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
        $logs = AttendanceLog::whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->where('session_type', 'Kajian')
            ->get();

        $grid = [];
        foreach ($logs as $log) {
            $grid[$log->student_id][$log->attendance_date] = $log->status;
        }

        $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->where('session_type', 'Kajian')
            ->distinct('attendance_date')
            ->count('attendance_date');

        $rows = [];
        foreach ($santris as $index => $santri) {
            $hadirCount = 0;
            $dailyStatuses = [];

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $status = $grid[$santri->id][$dateStr] ?? null;
                $dailyStatuses[$day] = $status;

                if (in_array($status, ['H', 'I'])) {
                    $hadirCount++;
                }
            }

            $percentage = $totalKBMDays > 0 ? round(($hadirCount / $totalKBMDays) * 100) : 0;

            $rows[] = [
                'no' => $index + 1,
                'name' => $santri->name,
                'statuses' => $dailyStatuses,
                'total_hadir' => $hadirCount,
                'percentage' => $percentage,
            ];
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.rekap-bulanan-pdf', compact(
            'monthName', 'year', 'daysInMonth', 'rows', 'totalKBMDays'
        ))->setPaper('a4', 'landscape');

        $monthNameStr = strtolower($monthName);
        return $pdf->download("rekap_{$monthNameStr}_{$year}.pdf");
    }
}
