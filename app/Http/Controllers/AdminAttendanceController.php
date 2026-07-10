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

            $log = AttendanceLog::firstOrNew([
                'student_id' => $santri->id,
                'attendance_date' => $selectedDate,
                'session_type' => 'Kajian',
            ]);

            $log->status = $status;
            $log->kajian_topic = 'Kajian Rutin';
            if (!$log->exists) {
                $log->attendance_time = now();
            }
            $log->save();

            $santri->recalculateStats();
        }

        return redirect()->route('admin.attendance.index', ['date' => $selectedDate])
            ->with('success', "Data Absensi Tanggal " . Carbon::parse($selectedDate)->format('d-m-Y') . " Berhasil Disimpan!");
    }
}
