<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\AttendanceLog;
use App\Models\StudentWarning;
use App\Models\AdminActivityLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminSpController extends Controller
{
    public function index(Request $request)
    {
        // Default evaluation period: last month
        $defaultStart = now()->subMonth()->startOfMonth()->toDateString();
        $defaultEnd = now()->subMonth()->endOfMonth()->toDateString();

        $startDate = $request->get('start_date', $defaultStart);
        $endDate = $request->get('end_date', $defaultEnd);
        $threshold = $request->get('threshold', 60);

        // Auto-generate Period Label if not manually set
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $indonesianMonths = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        if ($start->format('Y-m') === $end->format('Y-m')) {
            $autoLabel = $indonesianMonths[$start->month] . ' ' . $start->year;
        } else {
            if ($start->year === $end->year) {
                $autoLabel = $indonesianMonths[$start->month] . '-' . $indonesianMonths[$end->month] . ' ' . $start->year;
            } else {
                $autoLabel = $indonesianMonths[$start->month] . ' ' . $start->year . ' - ' . $indonesianMonths[$end->month] . ' ' . $end->year;
            }
        }
        $periodLabel = $request->get('period_label', $autoLabel);

        // Default signature details
        $yogyakartaDate = $request->get('yogyakarta_date', now()->translatedFormat('d F Y'));
        $pengasuhName = $request->get('pengasuh_name', 'Muhammad Zaki Afif Z., S.Psi., M.Psi.');
        $musyrifName = $request->get('musyrif_name', 'Muhammad Yusuf Akbar');

        // Fetch active students
        $students = Student::where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->orderBy('name', 'asc')
            ->get();

        // Calculate KBM Days (distinct attendance dates) in range
        $totalKBMDays = AttendanceLog::whereBetween('attendance_date', [$startDate, $endDate])
            ->where('session_type', 'Kajian')
            ->distinct('attendance_date')
            ->count('attendance_date');

        // Fetch attendance count for all students in a single query
        $hadirCounts = AttendanceLog::whereIn('student_id', $students->pluck('id'))
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->where('session_type', 'Kajian')
            ->whereIn('status', ['H', 'I'])
            ->groupBy('student_id')
            ->select('student_id', \DB::raw('count(*) as total'))
            ->pluck('total', 'student_id')
            ->toArray();

        $needsSp = [];
        $safe = [];

        foreach ($students as $student) {
            $hadir = $hadirCounts[$student->id] ?? 0;
            $percentage = $totalKBMDays > 0 ? round(($hadir / $totalKBMDays) * 100) : 0;

            // Check if there is already an issued SP for this period
            $existingWarning = StudentWarning::where('student_id', $student->id)
                ->where('period_label', $periodLabel)
                ->first();

            // Count previously issued warnings (excluding this period if already issued)
            $previousWarningsCount = StudentWarning::where('student_id', $student->id)
                ->when($existingWarning, function($query) use ($existingWarning) {
                    return $query->where('id', '!=', $existingWarning->id);
                })
                ->count();

            $studentData = [
                'student' => $student,
                'hadir' => $hadir,
                'total_kbm' => $totalKBMDays,
                'percentage' => $percentage,
                'existing_warning' => $existingWarning,
                'proposed_sp_number' => $previousWarningsCount + 1,
            ];

            if ($percentage < $threshold) {
                $needsSp[] = $studentData;
            } else {
                $safe[] = $studentData;
            }
        }

        // Fetch all issued warnings for the history table
        $issuedWarnings = StudentWarning::with('student')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.sp.index', compact(
            'startDate', 'endDate', 'threshold', 'periodLabel',
            'yogyakartaDate', 'pengasuhName', 'musyrifName',
            'needsSp', 'safe', 'totalKBMDays', 'issuedWarnings'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'sp_number' => 'required|integer|min:1',
            'period_label' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'attendance_percentage' => 'required|integer',
            'threshold' => 'required|integer',
            'yogyakarta_date' => 'required|string',
            'pengasuh_name' => 'required|string',
            'musyrif_name' => 'required|string',
        ]);

        $student = Student::findOrFail($request->student_id);

        $warning = StudentWarning::create($request->all());

        AdminActivityLog::log('issue_sp', "Menerbitkan SP {$warning->sp_number} untuk santri: {$student->name} (Periode: {$warning->period_label})");

        return redirect()->route('admin.sp.index', $request->only([
            'start_date', 'end_date', 'threshold', 'period_label', 
            'yogyakarta_date', 'pengasuh_name', 'musyrif_name'
        ]))->with('success', "Surat Peringatan {$warning->sp_number} berhasil diterbitkan untuk {$student->name}!");
    }

    public function printWarning($id)
    {
        $warning = StudentWarning::with('student')->findOrFail($id);

        // Re-calculate attendance details for accuracy
        $totalKBMDays = AttendanceLog::whereBetween('attendance_date', [$warning->start_date, $warning->end_date])
            ->where('session_type', 'Kajian')
            ->distinct('attendance_date')
            ->count('attendance_date');

        $hadir = AttendanceLog::where('student_id', $warning->student_id)
            ->whereBetween('attendance_date', [$warning->start_date, $warning->end_date])
            ->where('session_type', 'Kajian')
            ->whereIn('status', ['H', 'I'])
            ->count();

        $arabic = new \ArPHP\I18N\Arabic();
        $arabicText1 = $arabic->utf8Glyphs('معهد dar حراء');
        $arabicText1 = $arabic->utf8Glyphs('معهد دار حراء');
        $arabicText2 = $arabic->utf8Glyphs('للتربية الإسلامية لطلاب الجامعة');

        $data = [
            'student' => $warning->student,
            'hadir' => $hadir,
            'total_kbm' => $totalKBMDays,
            'percentage' => $warning->attendance_percentage,
            'threshold' => $warning->threshold,
            'periodLabel' => $warning->period_label,
            'yogyakartaDate' => $warning->yogyakarta_date,
            'pengasuhName' => $warning->pengasuh_name,
            'musyrifName' => $warning->musyrif_name,
            'arabicText1' => $arabicText1,
            'arabicText2' => $arabicText2,
            'spNumber' => $warning->sp_number,
            'spNumberRoman' => $warning->sp_number_roman,
            'spNumberIndonesian' => $warning->sp_number_indonesian,
        ];

        $pdf = Pdf::loadView('pdf.sp', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->stream('SP' . $warning->sp_number . '_' . str_replace(' ', '_', $warning->student->name) . '.pdf');
    }

    public function destroy(Request $request, $id)
    {
        $warning = StudentWarning::with('student')->findOrFail($id);
        $studentName = $warning->student->name;
        $spNumber = $warning->sp_number;
        $period = $warning->period_label;

        $warning->delete();

        AdminActivityLog::log('delete_sp', "Menghapus SP {$spNumber} untuk santri: {$studentName} (Periode: {$period})");

        return redirect()->route('admin.sp.index', $request->only([
            'start_date', 'end_date', 'threshold', 'period_label', 
            'yogyakarta_date', 'pengasuh_name', 'musyrif_name'
        ]))->with('success', "Surat Peringatan {$spNumber} untuk {$studentName} berhasil dihapus!");
    }

    // Fallback direct print method for backward compatibility
    public function print(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $threshold = $request->input('threshold', 60);
        $periodLabel = $request->input('period_label');
        $yogyakartaDate = $request->input('yogyakarta_date');
        $pengasuhName = $request->input('pengasuh_name');
        $musyrifName = $request->input('musyrif_name');

        // Re-calculate attendance
        $totalKBMDays = AttendanceLog::whereBetween('attendance_date', [$startDate, $endDate])
            ->where('session_type', 'Kajian')
            ->distinct('attendance_date')
            ->count('attendance_date');

        $hadir = AttendanceLog::where('student_id', $student->id)
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->where('session_type', 'Kajian')
            ->whereIn('status', ['H', 'I'])
            ->count();

        $percentage = $totalKBMDays > 0 ? round(($hadir / $totalKBMDays) * 100) : 0;

        $previousCount = StudentWarning::where('student_id', $student->id)->count();
        $spNumber = $previousCount > 0 ? $previousCount : 1;

        $tempWarning = new StudentWarning(['sp_number' => $spNumber]);

        $arabic = new \ArPHP\I18N\Arabic();
        $arabicText1 = $arabic->utf8Glyphs('معهد دار حراء');
        $arabicText2 = $arabic->utf8Glyphs('للتربية الإسلامية لطلاب الجامعة');

        $data = [
            'student' => $student,
            'hadir' => $hadir,
            'total_kbm' => $totalKBMDays,
            'percentage' => $percentage,
            'threshold' => $threshold,
            'periodLabel' => $periodLabel,
            'yogyakartaDate' => $yogyakartaDate,
            'pengasuhName' => $pengasuhName,
            'musyrifName' => $musyrifName,
            'arabicText1' => $arabicText1,
            'arabicText2' => $arabicText2,
            'spNumber' => $spNumber,
            'spNumberRoman' => $tempWarning->sp_number_roman,
            'spNumberIndonesian' => $tempWarning->sp_number_indonesian,
        ];

        $pdf = Pdf::loadView('pdf.sp', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->stream('SP' . $spNumber . '_' . str_replace(' ', '_', $student->name) . '.pdf');
    }
}
