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

        // Get attendance for selected date (fallback key student_id / user_id)
        $attendanceLogs = AttendanceLog::where('attendance_date', $selectedDate)
            ->where('session_type', 'Kajian')
            ->get()
            ->keyBy(function ($item) {
                return $item->student_id ?? $item->user_id;
            });

        return view('admin.attendance.index', compact('santris', 'selectedDate', 'attendanceLogs'));
    }

    public function store(Request $request)
    {
        $selectedDate = $request->date;
        $statuses = $request->status ?? [];

        $santris = Student::where('status_aktif', 'Aktif')
            ->whereIn('title', ['Santri', 'Musyrif'])
            ->get();

        $hasUserIdCol = \Illuminate\Support\Facades\Schema::hasColumn('attendance_logs', 'user_id');

        foreach ($santris as $santri) {
            $status = $statuses[$santri->id] ?? 'A';

            $dataToSave = [
                'student_id'      => $santri->id,
                'attendance_date' => $selectedDate,
                'session_type'    => 'Kajian',
                'status'          => $status,
                'attendance_time' => \Carbon\Carbon::now()->toTimeString(),
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ];

            if ($hasUserIdCol) {
                $dataToSave['user_id'] = $santri->id;
            }

            // Update jika ada (by student_id atau user_id), atau buat baru
            $existing = AttendanceLog::where('attendance_date', $selectedDate)
                ->where('session_type', 'Kajian')
                ->where(function ($q) use ($santri) {
                    $q->where('student_id', $santri->id)
                      ->orWhere('user_id', $santri->id);
                })->first();

            if ($existing) {
                $existing->update([
                    'status'          => $status,
                    'attendance_time' => \Carbon\Carbon::now()->toTimeString(),
                    'updated_at'      => \Carbon\Carbon::now(),
                ]);
            } else {
                \Illuminate\Support\Facades\DB::table('attendance_logs')->insert($dataToSave);
            }

            $santri->recalculateStats();
        }

        return redirect()->route('admin.attendance.index', ['date' => $selectedDate])
            ->with('success', "Data Absensi Tanggal " . Carbon::parse($selectedDate)->format('d-m-Y') . " Berhasil Disimpan!");
    }
}
