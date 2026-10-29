<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TahfizhSetoran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TahfizhController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $config = Setting::getSimakanConfig();
        $barisPerHalaman = max(1, (int) ($config['baris_per_halaman'] ?? 15));
        $hitungMengulang = !empty($config['hitung_mengulang']);

        $jenisFilter = $request->query('jenis', '');
        $bulanFilter = $request->query('bulan', Carbon::now('Asia/Jakarta')->format('Y-m'));

        $query = TahfizhSetoran::where('student_id', $user->id)
            ->orderByDesc('tanggal_setor')
            ->orderByDesc('id');

        if ($jenisFilter && in_array($jenisFilter, ['ziyadah', 'murojaah', 'tilawah'])) {
            $query->where('jenis', $jenisFilter);
        }

        if ($bulanFilter && preg_match('/^\d{4}-\d{2}$/', $bulanFilter)) {
            [$yr, $mo] = explode('-', $bulanFilter);
            $query->whereYear('tanggal_setor', (int) $yr)
                  ->whereMonth('tanggal_setor', (int) $mo);
        }

        $setorans = $query->paginate(20)->withQueryString();

        // Statistik keseluruhan santri
        $allValidQuery = TahfizhSetoran::where('student_id', $user->id);
        if (!$hitungMengulang) {
            $allValidQuery->where('predikat', '!=', 'Mengulang');
        }
        $allValid = $allValidQuery->get();

        $totalBarisZiyadah = (int) $allValid->where('jenis', 'ziyadah')->sum('jumlah_baris');
        $totalBarisMurojaah = (int) $allValid->where('jenis', 'murojaah')->sum('jumlah_baris');
        $totalBarisTilawah = (int) $allValid->where('jenis', 'tilawah')->sum('jumlah_baris');

        $halamanZiyadah = round($totalBarisZiyadah / $barisPerHalaman, 1);
        $halamanMurojaah = round($totalBarisMurojaah / $barisPerHalaman, 1);

        // Setoran minggu ini
        $startOfWeek = Carbon::now('Asia/Jakarta')->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now('Asia/Jakarta')->endOfWeek()->toDateString();

        $mingguIniCount = TahfizhSetoran::where('student_id', $user->id)
            ->whereBetween('tanggal_setor', [$startOfWeek, $endOfWeek])
            ->when(!$hitungMengulang, fn($q) => $q->where('predikat', '!=', 'Mengulang'))
            ->count();

        $targetMingguan = max(1, (int) ($config['target_mingguan'] ?? 3));

        return view('tahfizh', compact(
            'user',
            'config',
            'setorans',
            'jenisFilter',
            'bulanFilter',
            'barisPerHalaman',
            'totalBarisZiyadah',
            'totalBarisMurojaah',
            'totalBarisTilawah',
            'halamanZiyadah',
            'halamanMurojaah',
            'mingguIniCount',
            'targetMingguan'
        ));
    }
}

