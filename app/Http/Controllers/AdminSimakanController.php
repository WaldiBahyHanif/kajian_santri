<?php

namespace App\Http\Controllers;

use App\Models\AdminActivityLog;
use App\Models\Setting;
use App\Models\SimakanPenyimak;
use App\Models\Student;
use App\Models\TahfizhSetoran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminSimakanController extends Controller
{
    public function index(Request $request)
    {
        $config = Setting::getSimakanConfig();
        $simakanCode = Setting::getOrCreateSimakanAccessCode();
        $simakanLink = url('/simakan/' . $simakanCode);

        $penyimakList = SimakanPenyimak::withCount('setorans')->orderBy('name')->get();
        $students = Student::where('status_aktif', 'Aktif')->orderBy('name')->get(['id', 'name']);
        $surahList = TahfizhSetoran::surahList();
        $predikatList = TahfizhSetoran::predikatList();

        $search = $request->query('search', '');
        $jenis = $request->query('jenis', '');
        $penyimakId = $request->query('penyimak_id', '');
        $tanggal = $request->query('tanggal', '');

        $query = TahfizhSetoran::with(['student:id,name', 'penyimak:id,name'])
            ->orderByDesc('tanggal_setor')
            ->orderByDesc('id');

        if ($search !== '') {
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
        if ($jenis !== '' && in_array($jenis, ['ziyadah', 'murojaah', 'tilawah'])) {
            $query->where('jenis', $jenis);
        }
        if ($penyimakId !== '') {
            $query->where('penyimak_id', $penyimakId);
        }
        if ($tanggal !== '') {
            $query->whereDate('tanggal_setor', $tanggal);
        }

        $setorans = $query->paginate(25)->withQueryString();

        // Statistik ringkasan
        $today = Carbon::today('Asia/Jakarta')->toDateString();
        $todayCount = TahfizhSetoran::whereDate('tanggal_setor', $today)->count();
        $totalZiyadahBaris = (int) TahfizhSetoran::where('jenis', 'ziyadah')
            ->where('predikat', '!=', 'Mengulang')
            ->sum('jumlah_baris');
        $totalMurojaahBaris = (int) TahfizhSetoran::where('jenis', 'murojaah')
            ->where('predikat', '!=', 'Mengulang')
            ->sum('jumlah_baris');

        return view('admin.simakan.index', compact(
            'config',
            'simakanLink',
            'penyimakList',
            'students',
            'surahList',
            'predikatList',
            'setorans',
            'search',
            'jenis',
            'penyimakId',
            'tanggal',
            'todayCount',
            'totalZiyadahBaris',
            'totalMurojaahBaris'
        ));
    }

    public function storePenyimak(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'pin' => ['nullable', 'string', 'max:20'],
        ]);

        $penyimak = SimakanPenyimak::create([
            'name' => trim($validated['name']),
            'pin' => !empty($validated['pin']) ? trim($validated['pin']) : null,
            'is_active' => true,
        ]);

        AdminActivityLog::log('add_penyimak', "Menambahkan Ustadz Penyimak Setoran: {$penyimak->name}");

        return redirect()->back()->with('success', "✅ Ustadz Penyimak '{$penyimak->name}' berhasil ditambahkan!");
    }

    public function updatePenyimak(Request $request, int $id)
    {
        $penyimak = SimakanPenyimak::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'pin' => ['nullable', 'string', 'max:20'],
            'is_active' => ['required', 'boolean'],
        ]);

        $penyimak->update([
            'name' => trim($validated['name']),
            'pin' => !empty($validated['pin']) ? trim($validated['pin']) : null,
            'is_active' => (bool) $validated['is_active'],
        ]);

        AdminActivityLog::log('update_penyimak', "Memperbarui data Ustadz Penyimak: {$penyimak->name}");

        return redirect()->back()->with('success', "Data Ustadz Penyimak '{$penyimak->name}' berhasil diperbarui!");
    }

    public function destroyPenyimak(int $id)
    {
        $penyimak = SimakanPenyimak::findOrFail($id);
        $name = $penyimak->name;
        $penyimak->delete();

        AdminActivityLog::log('delete_penyimak', "Menghapus Ustadz Penyimak: {$name}");

        return redirect()->back()->with('success', "Ustadz Penyimak '{$name}' berhasil dihapus.");
    }

    public function updateConfig(Request $request)
    {
        $validated = $request->validate([
            'is_active' => ['required', 'boolean'],
            'global_pin' => ['required', 'string', 'min:3', 'max:20'],
            'min_baris_ziyadah' => ['required', 'integer', 'min:1', 'max:100'],
            'min_baris_murojaah' => ['required', 'integer', 'min:1', 'max:300'],
            'min_baris_tilawah' => ['required', 'integer', 'min:1', 'max:300'],
            'baris_per_halaman' => ['required', 'integer', 'min:5', 'max:30'],
            'target_mingguan' => ['required', 'integer', 'min:1', 'max:21'],
            'enable_ziyadah' => ['required', 'boolean'],
            'enable_murojaah' => ['required', 'boolean'],
            'enable_tilawah' => ['required', 'boolean'],
            'auto_attend_tahsin' => ['required', 'boolean'],
            'hitung_mengulang' => ['required', 'boolean'],
        ]);

        $setting = Setting::firstOrCreate([]);
        $landingPage = is_array($setting->landing_page) ? $setting->landing_page : [];
        $currentConfig = Setting::getSimakanConfig();

        $landingPage['simakan_config'] = array_merge($currentConfig, [
            'is_active' => (bool) $validated['is_active'],
            'global_pin' => trim($validated['global_pin']),
            'min_baris_ziyadah' => (int) $validated['min_baris_ziyadah'],
            'min_baris_murojaah' => (int) $validated['min_baris_murojaah'],
            'min_baris_tilawah' => (int) $validated['min_baris_tilawah'],
            'baris_per_halaman' => (int) $validated['baris_per_halaman'],
            'target_mingguan' => (int) $validated['target_mingguan'],
            'enable_ziyadah' => (bool) $validated['enable_ziyadah'],
            'enable_murojaah' => (bool) $validated['enable_murojaah'],
            'enable_tilawah' => (bool) $validated['enable_tilawah'],
            'auto_attend_tahsin' => (bool) $validated['auto_attend_tahsin'],
            'hitung_mengulang' => (bool) $validated['hitung_mengulang'],
        ]);

        $setting->landing_page = $landingPage;
        $setting->save();

        AdminActivityLog::log(
            'update_simakan_config',
            "Memperbarui aturan Simakan (Min Ziyadah: {$validated['min_baris_ziyadah']} brs, Min Murojaah: {$validated['min_baris_murojaah']} brs)"
        );

        return redirect()->back()->with('success', '⚙️ Pengaturan Simakan & Setor Hafalan berhasil disimpan!');
    }

    public function regenerateCode()
    {
        Setting::regenerateSimakanAccessCode();

        AdminActivityLog::log('regenerate_simakan_code', 'Meregenerasi link khusus Ustadz Penyimak (link lama hangus)');

        return redirect()->back()->with('success', '🔐 Link khusus Ustadz Penyimak berhasil diperbarui! Link lama sudah tidak berlaku.');
    }

    public function destroy(int $id)
    {
        $setoran = TahfizhSetoran::with('student')->findOrFail($id);
        $studentName = $setoran->student->name ?? 'Santri';
        $info = "{$setoran->jenis_label} ({$setoran->surah} - {$setoran->jumlah_baris} baris)";

        $setoran->delete();

        AdminActivityLog::log('delete_simakan', "Menghapus data setoran {$studentName}: {$info}");

        return redirect()->back()->with('success', 'Data setoran berhasil dihapus.');
    }
}
