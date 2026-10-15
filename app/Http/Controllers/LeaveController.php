<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        $leaves = LeaveRequest::where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('izin.index', compact('leaves'));
    }

    public function create()
    {
        return view('izin.create');
    }

    public function store(Request $request)
    {
        $student = Auth::user();

        $allowedSessions = $request->type === 'pengajian' ? ['Kajian', 'Tahsin'] : ['Kajian', 'Sholat', 'Tahsin', 'Acara'];

        $request->validate([
            'type' => ['required', 'in:pengajian,izin,cuti,sakit'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'duration' => ['required', 'integer', 'min:1', 'max:30'],
            'reason' => ['required', 'string', 'max:500'],
            'covered_sessions' => ['required', 'array', 'min:1'],
            'covered_sessions.*' => ['in:' . implode(',', $allowedSessions)],
        ]);

        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = $startDate->copy()->addDays($request->duration - 1);

        $leave = LeaveRequest::create([
            'student_id' => $student->id,
            'type' => $request->type,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'reason' => $request->reason,
            'covered_sessions' => $request->covered_sessions,
        ]);

        return redirect()->away($leave->whatsapp_link);
    }

    public function show($id)
    {
        $student = Auth::user();
        $leave = LeaveRequest::with(['student', 'approver', 'approverStudent'])
            ->where('student_id', $student->id)
            ->findOrFail($id);
        return view('izin.show', compact('leave'));
    }
}