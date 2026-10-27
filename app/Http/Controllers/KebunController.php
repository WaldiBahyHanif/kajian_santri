<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Student;
use Carbon\Carbon;

class KebunController extends Controller
{
    public function index()
    {
        $students = Student::where('status_aktif', 'Aktif')
            ->where('title', '!=', 'Admin')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'avatar', 'username']);

        $startDate = Carbon::today()->subDays(29)->toDateString();
        $endDate = Carbon::today()->toDateString();

        $hadirCounts = AttendanceLog::selectRaw('student_id, COUNT(*) as c')
            ->where('session_type', 'Kajian')
            ->where('status', 'H')
            ->where('attendance_date', '>=', $startDate)
            ->where('attendance_date', '<=', $endDate)
            ->groupBy('student_id')
            ->pluck('c', 'student_id');

        $students = $students->map(function ($student) use ($hadirCounts) {
            $count = (int) ($hadirCounts[$student->id] ?? 0);
            $percentage = ($count / 30) * 100;

            if ($percentage >= 85) {
                $stage = 4;
            } elseif ($percentage >= 60) {
                $stage = 3;
            } elseif ($percentage >= 30) {
                $stage = 2;
            } else {
                $stage = 1;
            }

            $student->garden_stage = $stage;

            return $student;
        });

        return view('kebun-pondok', compact('students'));
    }
}
