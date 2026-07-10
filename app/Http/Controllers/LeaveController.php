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
            'type' => ['required', 'in:izin,cuti,sakit'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'reason' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'covered_sessions' => ['required', 'array', 'min:1'],
            'covered_sessions.*' => ['in:Kajian,Sholat,Tahsin,Acara'],
        ]);

        LeaveRequest::create([
            'student_id' => $student->id,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'notes' => $request->notes,
            'covered_sessions' => $request->covered_sessions,
        ]);

        return redirect()->route('izin.index')
            ->with('success', 'Pengajuan ' . $request->type . ' berhasil dikirim dan menunggu persetujuan admin.');
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