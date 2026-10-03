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

class RekapMingguanExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $date;
    protected $sessionType;

    public function __construct($date, $sessionType = 'Kajian')
    {
        $this->date = $date;
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

        $carbonDate = Carbon::parse($this->date);
        $startOfWeek = $carbonDate->copy()->startOfWeek();
        $endOfWeek = $carbonDate->copy()->endOfWeek();

        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $weekDays[] = $startOfWeek->copy()->addDays($i)->toDateString();
        }

        // Get all logs for Kajian in the week
        $logs = AttendanceLog::whereBetween('attendance_date', [
            $startOfWeek->toDateString(), 
            $endOfWeek->toDateString()
        ])
        ->where('session_type', $this->sessionType)
        ->get();

        $grid = [];
        foreach ($logs as $log) {
            $grid[$log->student_id][$log->attendance_date] = $log->status;
        }

        $totalKBMDays = AttendanceLog::whereBetween('attendance_date', [
            $startOfWeek->toDateString(), 
            $endOfWeek->toDateString()
        ])
        ->where('session_type', $this->sessionType)
        ->distinct('attendance_date')
        ->count('attendance_date');

        $rows = [];
        foreach ($santris as $index => $santri) {
            $hadirCount = 0;
            $row = [
                'no' => $index + 1,
                'name' => $santri->name,
            ];

            foreach ($weekDays as $dayStr) {
                $status = $grid[$santri->id][$dayStr] ?? null;
                $row[$dayStr] = $status ?: '-';

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
        $carbonDate = Carbon::parse($this->date);
        $startOfWeek = $carbonDate->copy()->startOfWeek();
        
        $indonesianDayNames = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad'];
        
        $headings = ['No', 'Nama Santri'];
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);
            $headings[] = $indonesianDayNames[$i] . ' (' . $day->format('d/m') . ')';
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
        $carbonDate = Carbon::parse($this->date);
        $start = $carbonDate->copy()->startOfWeek()->format('d M Y');
        $end = $carbonDate->copy()->endOfWeek()->format('d M Y');
        return 'Rekap Mingguan ' . $start . ' - ' . $end;
    }

    /**
     * Styles for Excel formatting.
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
