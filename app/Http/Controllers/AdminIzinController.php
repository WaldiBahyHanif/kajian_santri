<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class AdminIzinController extends Controller
{
    public function index(Request $request)
    {
        $query = LeaveRequest::with(['student', 'approver']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search by student name
        if ($request->filled('search')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->where('start_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('end_date', '<=', $request->date_to);
        }

        $leaves = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.izin.index', compact('leaves'));
    }

    public function approve($id)
    {
        $leave = LeaveRequest::findOrFail($id);

        if ($leave->status !== 'pending') {
            return redirect()->route('admin.izin.index')
                ->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $leave->approve(auth()->guard('admin')->id());

        AdminActivityLog::log('approve_izin', "Menyetujui pengajuan {$leave->type_label} dari {$leave->student->name} (tgl {$leave->start_date->translatedFormat('d M Y')})");

        return redirect()->route('admin.izin.index')
            ->with('success', "Pengajuan {$leave->type_label} dari {$leave->student->name} telah disetujui.");
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => ['nullable', 'string', 'max:1000'],
        ]);

        $leave = LeaveRequest::findOrFail($id);

        if ($leave->status !== 'pending') {
            return redirect()->route('admin.izin.index')
                ->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $leave->reject(auth()->guard('admin')->id(), $request->rejection_reason);

        AdminActivityLog::log('reject_izin', "Menolak pengajuan {$leave->type_label} dari {$leave->student->name} (tgl {$leave->start_date->translatedFormat('d M Y')})" . ($request->rejection_reason ? ": {$request->rejection_reason}" : ''));

        return redirect()->route('admin.izin.index')
            ->with('success', "Pengajuan {$leave->type_label} dari {$leave->student->name} telah ditolak.");
    }

    public function destroy($id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $studentName = $leave->student->name;
        $leave->delete();

        AdminActivityLog::log('delete_izin', "Menghapus pengajuan {$leave->type_label} dari {$studentName}");

        return redirect()->route('admin.izin.index')
            ->with('success', 'Data pengajuan berhasil dihapus.');
    }
}