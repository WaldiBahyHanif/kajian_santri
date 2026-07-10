<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapBulananExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Return the data rows for Excel.
     */
    public function collection()
    {
        $santris = Student::where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->orderBy('name', 'asc')
            ->get();

        $daysInMonth = Carbon::create($this->year, $this->month, 1)->daysInMonth;

        // Get all logs for Kajian in the month
        $logs = AttendanceLog::whereMonth('attendance_date', $this->month)
            ->whereYear('attendance_date', $this->year)
            ->where('session_type', 'Kajian')
            ->get();

        $grid = [];
        foreach ($logs as $log) {
            $grid[$log->student_id][$log->attendance_date] = $log->status;
        }

        $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $this->month)
            ->whereYear('attendance_date', $this->year)
            ->where('session_type', 'Kajian')
            ->distinct('attendance_date')
            ->count('attendance_date');

        $rows = [];
        foreach ($santris as $index => $santri) {
            $hadirCount = 0;
            $row = [
                'no' => $index + 1,
                'name' => $santri->name,
            ];

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $dateStr = sprintf('%04d-%02d-%02d', $this->year, $this->month, $day);
                $status = $grid[$santri->id][$dateStr] ?? null;
                
                $row['day_' . $day] = $status ?: '-';

                if (in_array($status, ['H', 'I'])) {
                    $hadirCount++;
                }
            }

            $percentage = $totalKBMDays > 0 ? round(($hadirCount / $totalKBMDays) * 100) : 0;
            
            $row['total_hadir'] = $hadirCount;
            $row['percentage'] = $percentage . '%';

            $rows[] = $row;
        }

        return collect($rows);
    }

    /**
     * Define the headings.
     */
    public function headings(): array
    {
        $daysInMonth = Carbon::create($this->year, $this->month, 1)->daysInMonth;
        
        $headings = ['No', 'Nama Santri'];
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $headings[] = (string) $d;
        }
        $headings[] = 'JML';
        $headings[] = '%';

        return $headings;
    }

    /**
     * Sheet Title.
     */
    public function title(): string
    {
        $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        return 'Rekap ' . $monthNames[$this->month] . ' ' . $this->year;
    }

    /**
     * Styles for Excel formatting.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold green background
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
