<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveApprovalController extends Controller
{
    public function show(LeaveRequest $leave, string $token)
    {
        $this->authorizeMusyrif($leave, $token);

        $leave->load(['student', 'approverStudent']);

        return view('izin.respond', compact('leave'));
    }

    public function approve(LeaveRequest $leave, string $token)
    {
        $this->authorizeMusyrif($leave, $token);

        if ($leave->status === 'pending') {
            $leave->approveByMusyrif(Auth::id());
        }

        return redirect()->route('izin.respond', ['leave' => $leave->id, 'token' => $token])
            ->with('success', 'Pengajuan izin berhasil diizinkan.');
    }

    public function reject(Request $request, LeaveRequest $leave, string $token)
    {
        $this->authorizeMusyrif($leave, $token);

        $request->validate([
            'rejection_reason' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($leave->status === 'pending') {
            $leave->rejectByMusyrif(Auth::id(), $request->input('rejection_reason'));
        }

        return redirect()->route('izin.respond', ['leave' => $leave->id, 'token' => $token])
            ->with('success', 'Pengajuan izin ditolak.');
    }

    private function authorizeMusyrif(LeaveRequest $leave, string $token): void
    {
        abort_unless(
            !empty($leave->approval_token) && hash_equals($leave->approval_token, $token),
            404
        );

        $user = Auth::user();

        abort_unless($user && $user->title === 'Musyrif', 403, 'Hanya akun musyrif yang bisa mengakses halaman ini.');

        abort_if($user->id === $leave->student_id, 403, 'Tidak bisa menyetujui atau menolak pengajuan izin sendiri.');
    }
}
