<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class AdminPengaturanController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create([
                'id' => 1,
                'announcement_text' => '',
                'is_popup_active' => false,
            ]);
        }
        $admins = \App\Models\Admin::orderBy('username', 'asc')->get();

        $liqoAccessCode = Setting::getOrCreateLiqoAccessCode();
        $liqoLink = url('/liqo/' . $liqoAccessCode);

        return view('admin.pengaturan.index', compact('setting', 'admins', 'liqoLink'));
    }

    public function regenerateLiqoCode()
    {
        $code = Setting::regenerateLiqoAccessCode();

        AdminActivityLog::log('regenerate_liqo_code', 'Meregenerasi link absensi liqo (link lama tidak berlaku lagi)');

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Link absensi liqo berhasil diperbarui! Link lama sudah tidak berlaku.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'announcement_text' => ['nullable', 'string'],
            'is_popup_active' => ['required', 'boolean'],
            'garden_mode' => ['required', 'string', 'in:auto,manual'],
            'garden_status' => ['required', 'string', 'in:subur_sekali,subur,biasa,kering'],
            'garden_message' => ['nullable', 'string', 'max:500'],
            'tahsin_day_1' => ['required', 'integer', 'between:1,7'],
            'tahsin_day_2' => ['required', 'integer', 'between:1,7', 'different:tahsin_day_1'],
            'wa_musyrif_pengajian' => ['nullable', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'wa_musyrif_asrama_1_malam' => ['nullable', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'wa_musyrif_asrama_lebih_1_malam' => ['nullable', 'string', 'max:20', 'regex:/^[0-9]+$/'],
        ], [
            'tahsin_day_2.different' => 'Hari Tahsin ke-2 tidak boleh sama dengan Hari ke-1.',
            'wa_musyrif_pengajian.regex' => 'Nomor WA hanya boleh angka, format: 62xxxxxxxxxxx (tanpa + atau spasi).',
            'wa_musyrif_asrama_1_malam.regex' => 'Nomor WA hanya boleh angka, format: 62xxxxxxxxxxx (tanpa + atau spasi).',
            'wa_musyrif_asrama_lebih_1_malam.regex' => 'Nomor WA hanya boleh angka, format: 62xxxxxxxxxxx (tanpa + atau spasi).',
        ]);

        $setting = Setting::first();
        $setting->announcement_text = $request->announcement_text;
        $setting->is_popup_active = $request->is_popup_active;
        $setting->garden_mode = $request->garden_mode;
        $setting->garden_status = $request->garden_status;
        $setting->garden_message = $request->garden_message;
        $setting->wa_musyrif_pengajian = $request->wa_musyrif_pengajian;
        $setting->wa_musyrif_asrama_1_malam = $request->wa_musyrif_asrama_1_malam;
        $setting->wa_musyrif_asrama_lebih_1_malam = $request->wa_musyrif_asrama_lebih_1_malam;

        $landingPage = $setting->landing_page ?? [];
        $landingPage['tahsin_days'] = [(int) $request->tahsin_day_1, (int) $request->tahsin_day_2];
        $setting->landing_page = $landingPage;

        $setting->save();

        AdminActivityLog::log('update_settings', "Memperbarui pengaturan pop-up, Kebun Kebaikan, jadwal 2 hari Tahsin, dan nomor WA musyrif");

        return redirect()->route('admin.pengaturan.index')->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function exportArchive(Request $request)
    {
        $request->validate([
            'cutoff_date' => ['required', 'date'],
            'tables' => ['required', 'array', 'min:1'],
            'tables.*' => ['in:attendance_logs,reflections,daily_moods'],
        ]);

        $cutoffDate = $request->input('cutoff_date');
        $tables = $request->input('tables', []);
        
        $tempDir = storage_path('app/temp_archive_' . time());
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        
        $filesCreated = [];
        
        if (in_array('attendance_logs', $tables)) {
            $logs = \DB::table('attendance_logs')
                ->join('students', 'attendance_logs.student_id', '=', 'students.id')
                ->select('attendance_logs.*', 'students.name as student_name', 'students.username as student_username')
                ->where('attendance_date', '<', $cutoffDate)
                ->get();
                
            if ($logs->count() > 0) {
                $filePath = $tempDir . '/attendance_logs.csv';
                $fp = fopen($filePath, 'w');
                fputcsv($fp, ['id', 'student_id', 'student_name', 'student_username', 'attendance_date', 'attendance_time', 'status', 'session_type', 'kajian_topic', 'created_at']);
                foreach ($logs as $log) {
                    fputcsv($fp, [
                        $log->id,
                        $log->student_id,
                        $log->student_name,
                        $log->student_username,
                        $log->attendance_date,
                        $log->attendance_time,
                        $log->status,
                        $log->session_type,
                        $log->kajian_topic,
                        $log->created_at
                    ]);
                }
                fclose($fp);
                $filesCreated[] = $filePath;
            }
        }

        if (in_array('reflections', $tables)) {
            $reflections = \DB::table('reflections')
                ->join('students', 'reflections.user_id', '=', 'students.id')
                ->select('reflections.*', 'students.name as student_name', 'students.username as student_username')
                ->whereDate('reflections.created_at', '<', $cutoffDate)
                ->get();
                
            if ($reflections->count() > 0) {
                $filePath = $tempDir . '/reflections.csv';
                $fp = fopen($filePath, 'w');
                fputcsv($fp, ['id', 'student_id', 'student_name', 'student_username', 'content', 'created_at', 'updated_at']);
                foreach ($reflections as $ref) {
                    fputcsv($fp, [
                        $ref->id,
                        $ref->user_id,
                        $ref->student_name,
                        $ref->student_username,
                        $ref->content,
                        $ref->created_at,
                        $ref->updated_at
                    ]);
                }
                fclose($fp);
                $filesCreated[] = $filePath;
            }
        }

        if (in_array('daily_moods', $tables)) {
            $moods = \DB::table('daily_moods')
                ->join('students', 'daily_moods.student_id', '=', 'students.id')
                ->select('daily_moods.*', 'students.name as student_name', 'students.username as student_username')
                ->whereDate('daily_moods.created_at', '<', $cutoffDate)
                ->get();
                
            if ($moods->count() > 0) {
                $filePath = $tempDir . '/daily_moods.csv';
                $fp = fopen($filePath, 'w');
                fputcsv($fp, ['id', 'student_id', 'student_name', 'student_username', 'mood_type', 'created_at']);
                foreach ($moods as $mood) {
                    fputcsv($fp, [
                        $mood->id,
                        $mood->student_id,
                        $mood->student_name,
                        $mood->student_username,
                        $mood->mood_type,
                        $mood->created_at
                    ]);
                }
                fclose($fp);
                $filesCreated[] = $filePath;
            }
        }

        if (empty($filesCreated)) {
            rmdir($tempDir);
            return redirect()->back()->with('error', 'Tidak ada data ditemukan untuk kriteria tanggal cutoff tersebut.');
        }
        
        $zipPath = storage_path('app/arsip_kajian_' . $cutoffDate . '_' . time() . '.zip');
        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            foreach ($filesCreated as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        }
        
        // Clean up CSV files
        foreach ($filesCreated as $file) {
            unlink($file);
        }
        rmdir($tempDir);

        AdminActivityLog::log('archive_export', "Mengekspor arsip data (Tabel: " . implode(', ', $tables) . ") sebelum tanggal {$cutoffDate}");

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function purgeArchive(Request $request)
    {
        $request->validate([
            'cutoff_date' => ['required', 'date'],
            'tables' => ['required', 'array', 'min:1'],
            'tables.*' => ['in:attendance_logs,reflections,daily_moods'],
        ]);

        $cutoffDate = $request->input('cutoff_date');
        $tables = $request->input('tables', []);
        $deletedCounts = [];

        if (in_array('attendance_logs', $tables)) {
            $count = \DB::table('attendance_logs')->where('attendance_date', '<', $cutoffDate)->delete();
            $deletedCounts['Absensi'] = $count;
        }

        if (in_array('reflections', $tables)) {
            $count = \DB::table('reflections')->whereDate('created_at', '<', $cutoffDate)->delete();
            $deletedCounts['Refleksi'] = $count;
        }

        if (in_array('daily_moods', $tables)) {
            $count = \DB::table('daily_moods')->whereDate('created_at', '<', $cutoffDate)->delete();
            $deletedCounts['Mood'] = $count;
        }

        $detailStr = [];
        foreach ($deletedCounts as $label => $cnt) {
            $detailStr[] = "{$label}: {$cnt} baris";
        }
        $detailMsg = implode(', ', $detailStr);

        AdminActivityLog::log('archive_purge', "Membersihkan data lama sebelum tanggal {$cutoffDate}. Detail terhapus: {$detailMsg}");

        return redirect()->route('admin.pengaturan.index')->with('success', "Pembersihan selesai! Data terhapus: {$detailMsg}");
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:admins,username'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        $admin = \App\Models\Admin::create([
            'username' => $request->username,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        AdminActivityLog::log('add_admin', "Menambahkan akun admin baru: {$admin->username}");

        return redirect()->route('admin.pengaturan.index')
            ->with('success', "Akun admin {$admin->username} berhasil ditambahkan!");
    }

    public function destroyAdmin($id)
    {
        $currentAdminId = auth()->guard('admin')->id();
        
        if ($currentAdminId == $id) {
            return redirect()->route('admin.pengaturan.index')
                ->with('error', 'Anda tidak dapat menghapus akun admin Anda sendiri.');
        }

        $admin = \App\Models\Admin::findOrFail($id);
        
        $totalAdmins = \App\Models\Admin::count();
        if ($totalAdmins <= 1) {
            return redirect()->route('admin.pengaturan.index')
                ->with('error', 'Tidak dapat menghapus admin terakhir.');
        }

        $username = $admin->username;
        $admin->delete();

        AdminActivityLog::log('delete_admin', "Menghapus akun admin: {$username}");

        return redirect()->route('admin.pengaturan.index')
            ->with('success', "Akun admin {$username} berhasil dihapus.");
    }
}
