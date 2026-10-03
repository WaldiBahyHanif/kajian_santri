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
    protected $sessionType;

    public function __construct($month, $year, $sessionType = 'Kajian')
    {
        $this->month = $month;
        $this->year = $year;
        $this->sessionType = $sessionType;
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

        $activeDates = \App\Http\Controllers\RekapController::resolveBulananActiveDates(
            $this->month, $this->year, $this->sessionType
        );

        // Get all logs for session in the month
        $logs = AttendanceLog::whereMonth('attendance_date', $this->month)
            ->whereYear('attendance_date', $this->year)
            ->where('session_type', $this->sessionType)
            ->get();

        $grid = [];
        foreach ($logs as $log) {
            $grid[$log->student_id][$log->attendance_date] = $log->status;
        }

        $totalKBMDays = AttendanceLog::whereMonth('attendance_date', $this->month)
            ->whereYear('attendance_date', $this->year)
            ->where('session_type', $this->sessionType)
            ->distinct('attendance_date')
            ->count('attendance_date');

        $rows = [];
        foreach ($santris as $index => $santri) {
            $hadirCount = 0;
            $row = [
                'no'   => $index + 1,
                'name' => $santri->name,
            ];

            foreach ($activeDates as $dateInfo) {
                $dateStr = $dateInfo['date'];
                $status = $grid[$santri->id][$dateStr] ?? null;
                
                $row['day_' . $dateInfo['day']] = $status ?: '-';

                if (in_array($status, ['H', 'I'])) {
                    $hadirCount++;
                }
            }

            $percentage = $totalKBMDays > 0 ? round(($hadirCount / $totalKBMDays) * 100) : 0;
            
            $row['total_hadir'] = $hadirCount;
            $row['percentage']  = $percentage . '%';

            $rows[] = $row;
        }

        return collect($rows);
    }

    /**
     * Define the headings.
     */
    public function headings(): array
    {
        $activeDates = \App\Http\Controllers\RekapController::resolveBulananActiveDates(
            $this->month, $this->year, $this->sessionType
        );
        
        $headings = ['No', 'Nama Santri'];
        foreach ($activeDates as $dateInfo) {
            $headings[] = $this->sessionType === 'Tahsin'
                ? "{$dateInfo['day_name']} {$dateInfo['day']}"
                : (string) $dateInfo['day'];
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
