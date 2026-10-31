<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Setting;
use App\Models\SimakanPenyimak;
use App\Models\Student;
use App\Models\TahfizhSetoran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SimakanController extends Controller
{
    public function show(Request $request, string $code)
    {
        $config = Setting::getSimakanConfig();
        $penyimakList = SimakanPenyimak::where('is_active', true)->orderBy('name')->get();
        $students = Student::where('status_aktif', 'Aktif')->orderBy('name')->get(['id', 'name', 'title']);
        $surahList = TahfizhSetoran::surahList();
        $predikatList = TahfizhSetoran::predikatList();

        $today = Carbon::today('Asia/Jakarta')->toDateString();
        $selectedDate = $request->query('date', $today);

        $todaySetorans = TahfizhSetoran::with('student:id,name')
            ->whereDate('tanggal_setor', $selectedDate)
            ->latest()
            ->get();

        $verifiedPenyimakId = session('simakan_verified_penyimak_id');
        $verifiedPin = session('simakan_verified_pin');

        return view('simakan.form', compact(
            'code',
            'config',
            'penyimakList',
            'students',
            'surahList',
            'predikatList',
            'today',
            'selectedDate',
            'todaySetorans',
            'verifiedPenyimakId',
            'verifiedPin'
        ));
    }

    public function store(Request $request, string $code)
    {
        $config = Setting::getSimakanConfig();

        if (empty($config['is_active'])) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Sesi input simakan sedang ditutup oleh Admin Pondok.']);
        }

        $allowedJenis = [];
        if (!empty($config['enable_ziyadah'])) $allowedJenis[] = 'ziyadah';
        if (!empty($config['enable_murojaah'])) $allowedJenis[] = 'murojaah';
        if (!empty($config['enable_tilawah'])) $allowedJenis[] = 'tilawah';

        if (empty($allowedJenis)) {
            $allowedJenis = ['ziyadah', 'murojaah', 'tilawah'];
        }

        $jenis = (string) $request->input('jenis', 'ziyadah');
        $minBaris = match ($jenis) {
            'ziyadah' => (int) ($config['min_baris_ziyadah'] ?? 2),
            'murojaah' => (int) ($config['min_baris_murojaah'] ?? 6),
            'tilawah' => (int) ($config['min_baris_tilawah'] ?? 5),
            default => 1,
        };

        $validated = $request->validate([
            'penyimak_id' => ['required', 'exists:simakan_penyimaks,id'],
            'pin' => ['required', 'string'],
            'student_id' => ['required', 'exists:students,id'],
            'jenis' => ['required', 'in:' . implode(',', $allowedJenis)],
            'surah' => ['required', 'string', 'max:100'],
            'surah_akhir' => ['nullable', 'string', 'max:100'],
            'ayat_awal' => ['nullable', 'integer', 'min:1', 'max:286'],
            'ayat_akhir' => ['nullable', 'integer', 'min:1', 'max:286'],
            'halaman' => ['nullable', 'string', 'max:50'],
            'jumlah_baris' => ['required', 'integer', 'min:' . $minBaris, 'max:600'],
            'predikat' => ['required', 'string', 'max:40'],
            'catatan' => ['nullable', 'string', 'max:500'],
            'tanggal_setor' => ['required', 'date'],
        ], [
            'jumlah_baris.min' => match ($jenis) {
                'ziyadah' => "Setor Hafalan Baru (Ziyadah) wajib minimal {$minBaris} baris!",
                'murojaah' => "Setor Muroja'ah wajib minimal {$minBaris} baris!",
                'tilawah' => "Setor Tilawah wajib minimal {$minBaris} baris!",
                default => "Jumlah baris minimal {$minBaris} baris.",
            },
            'penyimak_id.required' => 'Pilih nama Ustadz Penyimak terlebih dahulu.',
            'student_id.required' => 'Pilih nama Santri yang menyetor.',
            'pin.required' => 'Masukkan PIN Verifikasi Ustadz Penyimak.',
        ]);

        $surahAwal = trim($validated['surah']);
        $surahAkhir = !empty($validated['surah_akhir']) ? trim($validated['surah_akhir']) : null;
        $combinedSurah = ($surahAkhir && $surahAkhir !== $surahAwal)
            ? "{$surahAwal} s/d {$surahAkhir}"
            : $surahAwal;

        $penyimak = SimakanPenyimak::where('is_active', true)->findOrFail($validated['penyimak_id']);
        $inputPin = trim($validated['pin']);
        $globalPin = trim((string) ($config['global_pin'] ?? '1234'));
        $personalPin = $penyimak->pin ? trim((string) $penyimak->pin) : null;

        // Jika penyimak memiliki PIN khusus yang diatur di Admin, validasi ke PIN khusus tersebut (atau PIN Global).
        // Jika penyimak tidak memiliki PIN khusus, validasi ke PIN Global.
        $pinValid = false;
        if ($personalPin !== null && $personalPin !== '' && hash_equals($personalPin, $inputPin)) {
            $pinValid = true;
        } elseif ($globalPin !== '' && hash_equals($globalPin, $inputPin)) {
            $pinValid = true;
        }

        if (!$pinValid) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['pin' => 'PIN Ustadz Penyimak tidak sesuai! Silakan periksa kembali PIN Anda.']);
        }

        // Simpan ke session agar Ustadz tidak perlu ketik ulang PIN untuk antrean santri berikutnya
        session([
            'simakan_verified_penyimak_id' => $penyimak->id,
            'simakan_verified_pin' => $inputPin,
        ]);

        $setoran = TahfizhSetoran::create([
            'student_id' => $validated['student_id'],
            'penyimak_id' => $penyimak->id,
            'penyimak_nama' => $penyimak->name,
            'jenis' => $validated['jenis'],
            'surah' => $combinedSurah,
            'ayat_awal' => $validated['ayat_awal'] ?? null,
            'ayat_akhir' => $validated['ayat_akhir'] ?? null,
            'halaman' => $validated['halaman'] ?? null,
            'jumlah_baris' => $validated['jumlah_baris'],
            'predikat' => $validated['predikat'],
            'catatan' => $validated['catatan'] ?? null,
            'tanggal_setor' => $validated['tanggal_setor'],
        ]);

        // Otomatis catat hadir Tahsin & Tahfidz saat santri selesai setor oleh Ustadz Penyimak
        $autoAttend = $config['auto_attend_tahsin'] ?? true;
        $allowMengulang = !empty($config['hitung_mengulang']);
        $shouldAttend = $autoAttend && ($validated['predikat'] !== 'Mengulang' || $allowMengulang);

        $student = Student::find($validated['student_id']);

        if ($shouldAttend) {
            $existingLog = AttendanceLog::where(function ($q) use ($validated) {
                    $q->where('student_id', $validated['student_id'])
                      ->orWhere('user_id', $validated['student_id']);
                })
                ->whereDate('attendance_date', $validated['tanggal_setor'])
                ->where('session_type', 'Tahsin')
                ->first();

            $noteText = "Otomatis dari Setoran {$setoran->jenis_label} (QS. {$setoran->surah}, {$setoran->jumlah_baris} baris) - Penyimak: {$penyimak->name}";

            if (!$existingLog) {
                $logPayload = [
                    'student_id' => $validated['student_id'],
                    'attendance_date' => $validated['tanggal_setor'],
                    'attendance_time' => Carbon::now('Asia/Jakarta')->toTimeString(),
                    'status' => 'H',
                    'session_type' => 'Tahsin',
                    'kajian_topic' => "Setoran {$setoran->jenis_label}: QS. {$setoran->surah}",
                    'notes' => $noteText,
                ];
                if (\Illuminate\Support\Facades\Schema::hasColumn('attendance_logs', 'user_id')) {
                    $logPayload['user_id'] = $validated['student_id'];
                }
                AttendanceLog::create($logPayload);
            } elseif ($existingLog->status !== 'H') {
                // Jika sebelumnya tercatat Alpha/Izin pada hari tersebut, ubah menjadi Hadir (H) karena sudah setor
                $existingLog->update([
                    'status' => 'H',
                    'attendance_time' => Carbon::now('Asia/Jakarta')->toTimeString(),
                    'kajian_topic' => "Setoran {$setoran->jenis_label}: QS. {$setoran->surah}",
                    'notes' => $noteText,
                ]);
            }

            if ($student) {
                try {
                    $student->recalculateStats();
                } catch (\Throwable $e) {
                    // Ignore stats recalculation error
                }
            }
        }

        $absenNote = $shouldAttend ? ' & otomatis tercatat HADIR Absen Tahsin & Tahfidz!' : '!';

        return redirect()->route('simakan.show', ['code' => $code, 'date' => $validated['tanggal_setor']])
            ->with('success', "✅ Setoran {$setoran->jenis_label} ({$setoran->jumlah_baris} baris - QS. {$setoran->surah}) untuk {$student->name} berhasil disahkan oleh {$penyimak->name}{$absenNote}");
    }

    public function destroy(Request $request, string $code, int $id)
    {
        $config = Setting::getSimakanConfig();
        $setoran = TahfizhSetoran::findOrFail($id);

        $inputPin = trim((string) $request->input('pin', session('simakan_verified_pin', '')));
        $globalPin = trim((string) ($config['global_pin'] ?? '1234'));

        $penyimak = $setoran->penyimak_id ? SimakanPenyimak::find($setoran->penyimak_id) : null;
        $personalPin = ($penyimak && $penyimak->pin) ? trim((string) $penyimak->pin) : null;

        $pinValid = ($globalPin !== '' && hash_equals($globalPin, $inputPin))
            || ($personalPin !== null && $personalPin !== '' && hash_equals($personalPin, $inputPin));

        if (!$pinValid) {
            return redirect()->back()->withErrors(['pin' => 'PIN tidak valid untuk menghapus data setoran ini.']);
        }

        $date = $setoran->tanggal_setor->toDateString();
        $setoran->delete();

        return redirect()->route('simakan.show', ['code' => $code, 'date' => $date])
            ->with('success', 'Data setoran berhasil dihapus.');
    }
}
