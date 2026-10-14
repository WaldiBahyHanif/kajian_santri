<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveApprovalController extends Controller
{
    public function show(LeaveRequest $leave, string $token)
    {
        $this->authorizeToken($leave, $token);

        $leave->load('student');

        return view('izin.respond', compact('leave'));
    }

    public function approve(LeaveRequest $leave, string $token)
    {
        $this->authorizeToken($leave, $token);

        if ($leave->status === 'pending') {
            $leave->approve(null);
        }

        return redirect()->route('izin.respond', ['leave' => $leave->id, 'token' => $token])
            ->with('success', 'Pengajuan izin berhasil diizinkan.');
    }

    public function reject(Request $request, LeaveRequest $leave, string $token)
    {
        $this->authorizeToken($leave, $token);

        $request->validate([
            'rejection_reason' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($leave->status === 'pending') {
            $leave->reject(null, $request->input('rejection_reason'));
        }

        return redirect()->route('izin.respond', ['leave' => $leave->id, 'token' => $token])
            ->with('success', 'Pengajuan izin ditolak.');
    }

    private function authorizeToken(LeaveRequest $leave, string $token): void
    {
        abort_unless(
            !empty($leave->approval_token) && hash_equals($leave->approval_token, $token),
            404
        );
    }
}
