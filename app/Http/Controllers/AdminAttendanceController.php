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
        $selectedDate = \Carbon\Carbon::parse($request->input('date', Carbon::today()->toDateString()))->toDateString();
        $statuses     = $request->input('status', []);

        $santris = Student::whereIn('status_aktif', ['Aktif', 'aktif'])
            ->whereIn('title', ['Santri', 'Musyrif', 'santri', 'musyrif'])
            ->get();

        $hasUserIdCol = \Illuminate\Support\Facades\Schema::hasColumn('attendance_logs', 'user_id');

        foreach ($santris as $santri) {
            $status = $statuses[$santri->id] ?? 'A';

            // Direct DB check
            $existing = \Illuminate\Support\Facades\DB::table('attendance_logs')
                ->where('attendance_date', $selectedDate)
                ->where('session_type', 'Kajian')
                ->where(function ($q) use ($santri) {
                    $q->where('student_id', $santri->id)
                      ->orWhere('user_id', $santri->id);
                })
                ->first();

            $hasUpdatedAtCol = \Illuminate\Support\Facades\Schema::hasColumn('attendance_logs', 'updated_at');
            $hasCreatedAtCol = \Illuminate\Support\Facades\Schema::hasColumn('attendance_logs', 'created_at');

            if ($existing) {
                $updateData = [
                    'status'          => $status,
                    'attendance_time' => \Carbon\Carbon::now()->toTimeString(),
                ];
                if ($hasUpdatedAtCol) {
                    $updateData['updated_at'] = \Carbon\Carbon::now();
                }

                // Direct DB UPDATE
                \Illuminate\Support\Facades\DB::table('attendance_logs')
                    ->where('id', $existing->id)
                    ->update($updateData);
            } else {
                $dataToInsert = [
                    'student_id'      => $santri->id,
                    'attendance_date' => $selectedDate,
                    'session_type'    => 'Kajian',
                    'status'          => $status,
                    'attendance_time' => \Carbon\Carbon::now()->toTimeString(),
                ];

                if ($hasUserIdCol) {
                    $dataToInsert['user_id'] = $santri->id;
                }
                if ($hasCreatedAtCol) {
                    $dataToInsert['created_at'] = \Carbon\Carbon::now();
                }
                if ($hasUpdatedAtCol) {
                    $dataToInsert['updated_at'] = \Carbon\Carbon::now();
                }

                \Illuminate\Support\Facades\DB::table('attendance_logs')->insert($dataToInsert);
            }

            $santri->recalculateStats();
        }

        return redirect()->route('admin.attendance.index', ['date' => $selectedDate])
            ->with('success', "Data Absensi Tanggal " . Carbon::parse($selectedDate)->format('d-m-Y') . " Berhasil Disimpan!");
    }
}
