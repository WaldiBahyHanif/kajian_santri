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

            // Cek apakah sudah ada log untuk santri ini
            $existing = AttendanceLog::where([
                'student_id' => $santri->id,
                'attendance_date' => $selectedDate,
                'session_type' => 'Kajian',
            ])->first();

            if ($existing) {
                // Update data yang sudah ada (termasuk jika status tidak berubah)
                $existing->status = $status;
                $existing->kajian_topic = 'Kajian Rutin';
                $existing->saveQuietly(); // pakai saveQuietly agar tetap tersimpan meski dirty check
            } else {
                // Buat data baru
                AttendanceLog::create([
                    'student_id' => $santri->id,
                    'attendance_date' => $selectedDate,
                    'session_type' => 'Kajian',
                    'status' => $status,
                    'kajian_topic' => 'Kajian Rutin',
                    'attendance_time' => now(),
                ]);
            }

            $santri->recalculateStats();
        }

        return redirect()->route('admin.attendance.index', ['date' => $selectedDate])
            ->with('success', "Data Absensi Tanggal " . Carbon::parse($selectedDate)->format('d-m-Y') . " Berhasil Disimpan!");
    }
}
