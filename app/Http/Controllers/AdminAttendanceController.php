<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->get('date', Carbon::today()->toDateString());

        $santris = Student::where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->orderBy('name', 'asc')
            ->get();

        // Get attendance for selected date
        $attendanceLogs = AttendanceLog::where('attendance_date', $selectedDate)
            ->where('session_type', 'Kajian')
            ->get()
            ->keyBy('student_id');

        return view('admin.attendance.index', compact('santris', 'selectedDate', 'attendanceLogs'));
    }

    public function store(Request $request)
    {
        $selectedDate = $request->date;
        $statuses = $request->status ?? [];

        $santris = Student::where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->get();

        foreach ($santris as $santri) {
            $status = $statuses[$santri->id] ?? 'A';

            // Gunakan DB::table langsung agar SELALU update ke database
            // tanpa melewati Eloquent dirty tracking yang bisa skip UPDATE.
            // CATATAN: user_id sengaja di-null karena app sudah pakai student_id.
            // FK user_id -> users sudah di-drop via migration terbaru.
            \Illuminate\Support\Facades\DB::table('attendance_logs')->updateOrInsert(
                [
                    'student_id'      => $santri->id,
                    'attendance_date' => $selectedDate,
                    'session_type'    => 'Kajian',
                ],
                [
                    'student_id'      => $santri->id,
                    'user_id'         => null,
                    'attendance_date' => $selectedDate,
                    'session_type'    => 'Kajian',
                    'status'          => $status,
                    'attendance_time' => \Carbon\Carbon::now()->toTimeString(),
                    'created_at'      => \Carbon\Carbon::now(),
                ]
            );

            $santri->recalculateStats();
        }

        return redirect()->route('admin.attendance.index', ['date' => $selectedDate])
            ->with('success', "Data Absensi Tanggal " . Carbon::parse($selectedDate)->format('d-m-Y') . " Berhasil Disimpan!");
    }
}
