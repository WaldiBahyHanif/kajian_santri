<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->get('date') 
            ? Carbon::parse($request->get('date'))->format('Y-m-d') 
            : Carbon::today()->toDateString();

        $santris = Student::whereIn('status_aktif', ['Aktif', 'aktif'])
            ->where(function ($q) {
                $q->whereIn('title', ['Santri', 'Musyrif', 'santri', 'musyrif', 'Mahasantri', 'mahasantri'])
                  ->orWhereNull('title')
                  ->orWhere('title', '!=', 'Admin');
            })
            ->orderBy('name', 'asc')
            ->get();

        // Get attendance for selected date (key by student ID)
        $attendanceLogs = AttendanceLog::whereDate('attendance_date', $selectedDate)
            ->whereIn('session_type', ['Kajian', 'kajian'])
            ->get()
            ->keyBy(function ($item) {
                return (int) ($item->student_id ?? $item->user_id);
            });

        return view('admin.attendance.index', compact('santris', 'selectedDate', 'attendanceLogs'));
    }

    public function store(Request $request)
    {
        $selectedDate = $request->input('date') 
            ? Carbon::parse($request->input('date'))->format('Y-m-d') 
            : Carbon::today()->toDateString();

        $statuses = $request->input('status', []);

        $hasUserIdCol    = Schema::hasColumn('attendance_logs', 'user_id');
        $hasStudentIdCol = Schema::hasColumn('attendance_logs', 'student_id');
        $hasUpdatedAtCol = Schema::hasColumn('attendance_logs', 'updated_at');
        $hasCreatedAtCol = Schema::hasColumn('attendance_logs', 'created_at');

        foreach ($statuses as $studentId => $status) {
            $studentId = (int) $studentId;
            if ($studentId <= 0) {
                continue;
            }

            // Direct DB search
            $existing = DB::table('attendance_logs')
                ->whereDate('attendance_date', $selectedDate)
                ->whereIn('session_type', ['Kajian', 'kajian'])
                ->where(function ($q) use ($studentId) {
                    $q->where('student_id', $studentId)
                      ->orWhere('user_id', $studentId);
                })
                ->first();

            if ($existing) {
                $updateData = [
                    'status'          => $status,
                    'attendance_time' => Carbon::now()->toTimeString(),
                ];
                if ($hasUpdatedAtCol) {
                    $updateData['updated_at'] = Carbon::now();
                }

                DB::table('attendance_logs')
                    ->where('id', $existing->id)
                    ->update($updateData);
            } else {
                $dataToInsert = [
                    'attendance_date' => $selectedDate,
                    'session_type'    => 'Kajian',
                    'status'          => $status,
                    'attendance_time' => Carbon::now()->toTimeString(),
                ];

                if ($hasStudentIdCol) {
                    $dataToInsert['student_id'] = $studentId;
                }
                if ($hasUserIdCol) {
                    $dataToInsert['user_id'] = $studentId;
                }
                if ($hasCreatedAtCol) {
                    $dataToInsert['created_at'] = Carbon::now();
                }
                if ($hasUpdatedAtCol) {
                    $dataToInsert['updated_at'] = Carbon::now();
                }

                DB::table('attendance_logs')->insert($dataToInsert);
            }

            $santri = Student::find($studentId);
            if ($santri) {
                try {
                    $santri->recalculateStats();
                } catch (\Throwable $e) {
                    // Prevent error in stats recalculation from blocking attendance save
                }
            }
        }

        return redirect()->route('admin.attendance.index', ['date' => $selectedDate])
            ->with('success', "Data Absensi Tanggal " . Carbon::parse($selectedDate)->format('d-m-Y') . " Berhasil Disimpan!");
    }
}
