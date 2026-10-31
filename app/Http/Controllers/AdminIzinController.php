<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\AdminActivityLog;
use App\Models\Setting;
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
        $izinWa = Setting::getIzinWaNumbers();

        return view('admin.izin.index', compact('leaves', 'izinWa'));
    }

    public function updateWaSettings(Request $request)
    {
        $validated = $request->validate([
            'wa_1_hari' => ['required', 'string', 'max:30'],
            'wa_2_hari' => ['required', 'string', 'max:30'],
            'wa_lebih_2_hari' => ['required', 'string', 'max:30'],
        ]);

        $normalize = function (string $num): string {
            $clean = preg_replace('/[^0-9]/', '', $num);
            if (str_starts_with($clean, '0')) {
                $clean = '62' . substr($clean, 1);
            }
            return $clean;
        };

        $setting = Setting::firstOrCreate([]);
        $landingPage = is_array($setting->landing_page) ? $setting->landing_page : [];
        $landingPage['izin_wa'] = [
            'wa_1_hari' => $normalize($validated['wa_1_hari']),
            'wa_2_hari' => $normalize($validated['wa_2_hari']),
            'wa_lebih_2_hari' => $normalize($validated['wa_lebih_2_hari']),
        ];
        $setting->landing_page = $landingPage;
        $setting->save();

        AdminActivityLog::log('update_izin_wa', 'Memperbarui pengaturan nomor WhatsApp tujuan perizinan (1 Hari, 2 Hari, >2 Hari)');

        return redirect()->back()->with('success', '✅ Nomor WhatsApp Tujuan Perizinan berhasil disimpan!');
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
