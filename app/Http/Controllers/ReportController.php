<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Basic calculations for Rapor based on available database structure
        // Since we don't have 'kajian_topic' in the new schema, we'll base it on 'session_type'
        
        $totalHadir = $user->attendanceLogs()->whereIn('status', ['H', 'I'])->count();
        $totalRecords = $user->attendanceLogs()->count();
        
        $attendanceRate = ($totalRecords > 0) ? round(($totalHadir / $totalRecords) * 100) : 0;
        $gpa = ($attendanceRate / 100) * 4;
        
        $overallGrade = 'E';
        $overallLabel = 'Needs Improvement';
        if($gpa >= 3.8) { $overallGrade = 'A+'; $overallLabel = 'Excellent'; }
        elseif($gpa >= 3.5) { $overallGrade = 'A'; $overallLabel = 'Very Good'; }
        elseif($gpa >= 3.0) { $overallGrade = 'B+'; $overallLabel = 'Good'; }
        elseif($gpa >= 2.5) { $overallGrade = 'B'; $overallLabel = 'Satisfactory'; }
        elseif($gpa >= 2.0) { $overallGrade = 'C'; $overallLabel = 'Pass'; }
        elseif($totalRecords == 0) { $overallGrade = '-'; $overallLabel = 'N/A'; }

        // Get count of each status
        $statusCounts = $user->attendanceLogs()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $totalH = $statusCounts['H'] ?? 0;
        $totalI = $statusCounts['I'] ?? 0;
        $totalA = $statusCounts['A'] ?? 0;
        $totalS = $statusCounts['S'] ?? 0;

        // Group by session_type to act as mapels (subjects)
        $sessionStats = $user->attendanceLogs()
            ->selectRaw('session_type, sum(case when status in ("H", "I") then 1 else 0 end) as hadir_count, count(*) as total_count')
            ->groupBy('session_type')
            ->get();

        return view('rapor', compact(
            'user', 
            'attendanceRate', 
            'overallGrade', 
            'overallLabel', 
            'gpa', 
            'totalH', 
            'totalI', 
            'totalA', 
            'totalS',
            'sessionStats'
        ));
    }
}
