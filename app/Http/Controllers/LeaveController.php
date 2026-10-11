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

        $request->validate([
            'type' => ['required', 'in:pengajian,izin,cuti,sakit'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'duration' => ['required', 'integer', 'min:1', 'max:30'],
            'reason' => ['required', 'string', 'max:500'],
            'pengajian_jenis' => ['required_if:type,pengajian', 'nullable', 'in:Kajian,Tahsin'],
            'covered_sessions' => ['required_unless:type,pengajian', 'array', 'min:1'],
            'covered_sessions.*' => ['in:Kajian,Sholat,Tahsin,Acara'],
        ]);

        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = $startDate->copy()->addDays($request->duration - 1);

        $coveredSessions = $request->type === 'pengajian'
            ? [$request->pengajian_jenis]
            : $request->covered_sessions;

        $leave = LeaveRequest::create([
            'student_id' => $student->id,
            'type' => $request->type,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'reason' => $request->reason,
            'covered_sessions' => $coveredSessions,
            'status' => 'approved',
        ]);

        return redirect()->away($leave->whatsapp_link);
    }

    public function show($id)
    {
        $student = Auth::user();
        $leave = LeaveRequest::with(['student', 'approver'])
            ->where('student_id', $student->id)
            ->findOrFail($id);
        return view('izin.show', compact('leave'));
    }
}