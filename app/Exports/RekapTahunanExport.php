<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\AttendanceLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapTahunanExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $year;
    protected $sessionType;

    public function __construct($year, $sessionType = 'Kajian')
    {
        $this->year = $year;
        $this->sessionType = $sessionType;
    }

    /**
     * Return collection of yearly data.
     */
    public function collection()
    {
        $santris = Student::where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->orderBy('name', 'asc')
            ->get();

        $yearlyLogs = AttendanceLog::selectRaw('student_id, MONTH(attendance_date) as month, COUNT(*) as count')
            ->whereYear('attendance_date', $this->year)
            ->where('session_type', $this->sessionType)
            ->whereIn('status', ['H', 'I'])
            ->groupBy('student_id', 'month')
            ->get()
            ->groupBy('student_id');

        $kbmRaw = AttendanceLog::selectRaw('MONTH(attendance_date) as month, COUNT(DISTINCT attendance_date) as days')
            ->whereYear('attendance_date', $this->year)
            ->where('session_type', $this->sessionType)
            ->groupByRaw('MONTH(attendance_date)')
            ->pluck('days', 'month');

        $rows = [];
        foreach ($santris as $index => $santri) {
            $row = [
                'no' => $index + 1,
                'name' => $santri->name,
            ];

            $totalHadirYearly = 0;
            $totalKBMYearly = 0;
            $santriLogs = $yearlyLogs->get($santri->id, collect())->keyBy('month');

            for ($m = 1; $m <= 12; $m++) {
                $hadir = $santriLogs->has($m) ? $santriLogs[$m]->count : 0;
                $totalKBM = $kbmRaw->get($m, 0);

                $totalHadirYearly += $hadir;
                $totalKBMYearly += $totalKBM;

                $row['month_' . $m] = $totalKBM > 0 ? round(($hadir / $totalKBM) * 100) . '%' : '-';
            }

            $yearlyPercentage = $totalKBMYearly > 0 ? round(($totalHadirYearly / $totalKBMYearly) * 100) : 0;
            
            $row['total_hadir'] = $totalHadirYearly;
            $row['total_kbm'] = $totalKBMYearly;
            $row['percentage'] = $yearlyPercentage . '%';

            $rows[] = $row;
        }

        return collect($rows);
    }

    /**
     * Headings for yearly report.
     */
    public function headings(): array
    {
        return [
            'No', 'Nama Santri',
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des',
            'JML Hadir', 'Total KBM', 'Rata-Rata'
        ];
    }

    /**
     * Sheet Title.
     */
    public function title(): string
    {
        return 'Rekap Tahunan ' . $this->year;
    }

    /**
     * Sheet Styles.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '003527']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ]
            ],
        ];
    }
}
