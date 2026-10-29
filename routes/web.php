<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlumniController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $setting = \App\Models\Setting::first();
    $landingPage = $setting ? $setting->landing_page : \App\Models\Setting::defaultLandingPage();
    return view('welcome', compact('landingPage'));
});

// PWA Offline fallback page
Route::get('/offline', function () {
    return response()->file(public_path('offline.html'));
})->name('offline');

// Liqo Attendance (public, gated by shared secret code, no login required)
Route::middleware(['liqo.access'])->prefix('liqo')->group(function () {
    Route::get('/{code}', [\App\Http\Controllers\LiqoAttendanceController::class, 'show'])->name('liqo.show');
    Route::get('/{code}/roster', [\App\Http\Controllers\LiqoAttendanceController::class, 'roster'])->name('liqo.roster');
    Route::post('/{code}', [\App\Http\Controllers\LiqoAttendanceController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('liqo.store');
});

// Simakan & Setor Hafalan Ustadz Penyimak (public, gated by shared secret code + PIN Ustadz)
Route::middleware(['simakan.access'])->prefix('simakan')->group(function () {
    Route::get('/{code}', [\App\Http\Controllers\SimakanController::class, 'show'])->name('simakan.show');
    Route::post('/{code}', [\App\Http\Controllers\SimakanController::class, 'store'])
        ->middleware('throttle:25,1')
        ->name('simakan.store');
    Route::delete('/{code}/{id}', [\App\Http\Controllers\SimakanController::class, 'destroy'])->name('simakan.destroy');
});

// PWA Push Subscriptions routes
Route::post('/push/subscribe', [\App\Http\Controllers\PushSubscriptionController::class, 'store'])->name('push.subscribe');
Route::post('/push/unsubscribe', [\App\Http\Controllers\PushSubscriptionController::class, 'destroy'])->name('push.unsubscribe');
Route::post('/push/test', [\App\Http\Controllers\PushSubscriptionController::class, 'sendTestPush'])->name('push.test');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/mood', [DashboardController::class, 'storeMood'])->name('mood.store');
    Route::post('/zikir/sync', [DashboardController::class, 'syncZikir'])->name('zikir.sync');
    Route::get('/scan', [AttendanceController::class, 'scan'])->name('attendance.scan');
    Route::post('/scan', [AttendanceController::class, 'processScan'])->name('attendance.process');
    Route::get('/rapor', [\App\Http\Controllers\ReportController::class, 'index'])->name('rapor');
    Route::get('/rekap', [\App\Http\Controllers\RekapController::class, 'index'])->name('rekap');
    Route::get('/rekap/detail', [\App\Http\Controllers\RekapController::class, 'detail'])->name('rekap.detail');
    Route::get('/rekap/export/excel', [\App\Http\Controllers\RekapController::class, 'exportExcel'])->name('rekap.export.excel');
    Route::get('/rekap/export/pdf', [\App\Http\Controllers\RekapController::class, 'exportPdf'])->name('rekap.export.pdf');
    Route::get('/zikir', function() { return view('zikir'); })->name('zikir');
    Route::get('/mitsur', [\App\Http\Controllers\MitsurController::class, 'index'])->name('mitsur');
    Route::post('/mitsur', [\App\Http\Controllers\MitsurController::class, 'updateReport'])->name('mitsur.update');
    Route::get('/mitsur/messages', [\App\Http\Controllers\MitsurController::class, 'getMessages'])->name('mitsur.messages');
    Route::post('/mitsur/messages', [\App\Http\Controllers\MitsurController::class, 'sendMessage'])->name('mitsur.send');
    Route::get('/refleksi', [\App\Http\Controllers\ReflectionController::class, 'index'])->name('refleksi');
    Route::post('/refleksi', [\App\Http\Controllers\ReflectionController::class, 'store'])->name('refleksi.store');
    Route::delete('/refleksi/{id}', [\App\Http\Controllers\ReflectionController::class, 'destroy'])->name('refleksi.destroy');
    Route::get('/setoran', [\App\Http\Controllers\TahfizhController::class, 'index'])->name('setoran.index');
    Route::post('/saran', [DashboardController::class, 'storeSaran'])->name('saran.store');
    Route::get('/api/announcements/active', [\App\Http\Controllers\AnnouncementNotificationController::class, 'activeReminders'])->name('announcements.active-reminders');

    // Izin & Cuti Routes
    Route::get('/izin', [\App\Http\Controllers\LeaveController::class, 'index'])->name('izin.index');
    Route::get('/izin/create', [\App\Http\Controllers\LeaveController::class, 'create'])->name('izin.create');
    Route::post('/izin', [\App\Http\Controllers\LeaveController::class, 'store'])->name('izin.store');
    Route::get('/izin/{id}', [\App\Http\Controllers\LeaveController::class, 'show'])->name('izin.show');

    // Kalender Routes
    Route::get('/kalender', [\App\Http\Controllers\CalendarController::class, 'index'])->name('kalender.index');
    Route::get('/kalender/data', [\App\Http\Controllers\CalendarController::class, 'data'])->name('kalender.data');

    // Kajian Routes
    Route::get('/kajian', [\App\Http\Controllers\KajianController::class, 'index'])->name('kajian');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Alumni & Mahasantri
    Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
});

// Admin Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/sync-streaks', [\App\Http\Controllers\AdminController::class, 'syncStreaks'])->name('sync-streaks');

    // Kelola Kajian
    Route::resource('kajian', \App\Http\Controllers\AdminKajianController::class);
    Route::resource('program-kajian', \App\Http\Controllers\AdminKajianProgramController::class)->except(['create', 'show', 'edit']);

    // Kelola Santri
    Route::resource('santri', \App\Http\Controllers\AdminSantriController::class)->except(['create', 'show', 'edit']);

    // Kelola Ustadz
    Route::resource('asatiz', \App\Http\Controllers\AdminAsatizController::class)->except(['create', 'show', 'edit']);
    Route::post('/asatiz/attendance', [\App\Http\Controllers\AdminAsatizController::class, 'storeAttendance'])->name('asatiz.attendance.store');
    Route::put('/asatiz/attendance/{id}', [\App\Http\Controllers\AdminAsatizController::class, 'updateAttendance'])->name('asatiz.attendance.update');
    Route::delete('/asatiz/attendance/{id}', [\App\Http\Controllers\AdminAsatizController::class, 'destroyAttendance'])->name('asatiz.attendance.destroy');

    // Kelola Topik
    Route::resource('topik', \App\Http\Controllers\AdminTopikController::class)->except(['create', 'show', 'edit']);
    // Resource route uses 'topik' as param name, bind to Topic model
    Route::model('topik', \App\Models\Topic::class);

    // Kelola Materi
    Route::resource('materi', \App\Http\Controllers\AdminMateriController::class)->except(['create', 'show', 'edit']);
    Route::model('materi', \App\Models\Material::class);

    // Kelola Absensi
    Route::get('/attendance', [\App\Http\Controllers\AdminAttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [\App\Http\Controllers\AdminAttendanceController::class, 'store'])->name('attendance.store');

    // Kelola Liqo
    Route::get('/liqo', [\App\Http\Controllers\AdminLiqoController::class, 'index'])->name('liqo.index');
    Route::post('/liqo', [\App\Http\Controllers\AdminLiqoController::class, 'store'])->name('liqo.store');
    Route::put('/liqo/{liqo}', [\App\Http\Controllers\AdminLiqoController::class, 'update'])->name('liqo.update');
    Route::delete('/liqo/{liqo}', [\App\Http\Controllers\AdminLiqoController::class, 'destroy'])->name('liqo.destroy');
    Route::get('/liqo/{liqo}/anggota', [\App\Http\Controllers\AdminLiqoController::class, 'members'])->name('liqo.members');
    Route::post('/liqo/{liqo}/anggota', [\App\Http\Controllers\AdminLiqoController::class, 'addMember'])->name('liqo.members.add');
    Route::delete('/liqo/{liqo}/anggota/{student}', [\App\Http\Controllers\AdminLiqoController::class, 'removeMember'])->name('liqo.members.remove');
    Route::get('/liqo/template/download', [\App\Http\Controllers\AdminLiqoController::class, 'downloadTemplate'])->name('liqo.template');
    Route::post('/liqo/import', [\App\Http\Controllers\AdminLiqoController::class, 'import'])->name('liqo.import');

    // QR Generator
    Route::get('/qr-generator', [\App\Http\Controllers\AdminQrController::class, 'index'])->name('qr.index');
    Route::post('/qr-generator', [\App\Http\Controllers\AdminQrController::class, 'store'])->name('qr.store');

    // Surat Peringatan (SP)
    Route::get('/sp', [\App\Http\Controllers\AdminSpController::class, 'index'])->name('sp.index');
    Route::post('/sp/store', [\App\Http\Controllers\AdminSpController::class, 'store'])->name('sp.store');
    Route::get('/sp/print-warning/{id}', [\App\Http\Controllers\AdminSpController::class, 'printWarning'])->name('sp.print-warning');
    Route::delete('/sp/delete/{id}', [\App\Http\Controllers\AdminSpController::class, 'destroy'])->name('sp.destroy');
    Route::post('/sp/print/{student_id}', [\App\Http\Controllers\AdminSpController::class, 'print'])->name('sp.print');

    // Refleksi Santri
    Route::get('/refleksi', [\App\Http\Controllers\AdminRefleksiController::class, 'index'])->name('refleksi.index');
    Route::delete('/refleksi/{id}', [\App\Http\Controllers\AdminRefleksiController::class, 'destroy'])->name('refleksi.destroy');

    // Saran & Masukan
    Route::get('/saran', [\App\Http\Controllers\AdminSaranController::class, 'index'])->name('saran.index');
    Route::delete('/saran/{id}', [\App\Http\Controllers\AdminSaranController::class, 'destroy'])->name('saran.destroy');

    // Mitsur Pairs
    Route::get('/mitsur', [\App\Http\Controllers\AdminMitsurController::class, 'index'])->name('mitsur.index');
    Route::post('/mitsur', [\App\Http\Controllers\AdminMitsurController::class, 'store'])->name('mitsur.store');
    Route::delete('/mitsur/{id}', [\App\Http\Controllers\AdminMitsurController::class, 'destroy'])->name('mitsur.destroy');

    // Pengumuman
    Route::resource('pengumuman', \App\Http\Controllers\AdminPengumumanController::class)->except(['create', 'show', 'edit']);
    Route::model('pengumuman', \App\Models\Announcement::class);

    // Landing Page
    Route::get('/landing-page', [\App\Http\Controllers\AdminLandingPageController::class, 'edit'])->name('landing-page.edit');
    Route::put('/landing-page', [\App\Http\Controllers\AdminLandingPageController::class, 'update'])->name('landing-page.update');

    // Pengaturan
    Route::get('/pengaturan', [\App\Http\Controllers\AdminPengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [\App\Http\Controllers\AdminPengaturanController::class, 'update'])->name('pengaturan.update');
    Route::post('/pengaturan/archive-export', [\App\Http\Controllers\AdminPengaturanController::class, 'exportArchive'])->name('pengaturan.archive-export');
    Route::post('/pengaturan/archive-purge', [\App\Http\Controllers\AdminPengaturanController::class, 'purgeArchive'])->name('pengaturan.archive-purge');
    Route::post('/pengaturan/admin', [\App\Http\Controllers\AdminPengaturanController::class, 'storeAdmin'])->name('pengaturan.admin.store');
    Route::delete('/pengaturan/admin/{id}', [\App\Http\Controllers\AdminPengaturanController::class, 'destroyAdmin'])->name('pengaturan.admin.destroy');
    Route::post('/pengaturan/liqo-code/regenerate', [\App\Http\Controllers\AdminPengaturanController::class, 'regenerateLiqoCode'])->name('pengaturan.liqo-code.regenerate');

    // Kelola Santri Rollover
    Route::post('/santri/rollover', [\App\Http\Controllers\AdminSantriController::class, 'rollover'])->name('santri.rollover');

    // Log Aktivitas
    Route::get('/activity-log', [\App\Http\Controllers\AdminActivityLogController::class, 'index'])->name('activity-log.index');

    // Kalender Kegiatan
    Route::get('/kalender', [\App\Http\Controllers\AdminCalendarController::class, 'index'])->name('kalender.index');
    Route::post('/kalender', [\App\Http\Controllers\AdminCalendarController::class, 'store'])->name('kalender.store');
    Route::put('/kalender/{id}', [\App\Http\Controllers\AdminCalendarController::class, 'update'])->name('kalender.update');
    Route::delete('/kalender/{id}', [\App\Http\Controllers\AdminCalendarController::class, 'destroy'])->name('kalender.destroy');
    Route::get('/kalender/data', [\App\Http\Controllers\AdminCalendarController::class, 'calendarData'])->name('kalender.data');

    // Izin & Cuti
    Route::get('/izin', [\App\Http\Controllers\AdminIzinController::class, 'index'])->name('izin.index');
    Route::post('/izin/{id}/approve', [\App\Http\Controllers\AdminIzinController::class, 'approve'])->name('izin.approve');
    Route::post('/izin/{id}/reject', [\App\Http\Controllers\AdminIzinController::class, 'reject'])->name('izin.reject');
    Route::delete('/izin/{id}', [\App\Http\Controllers\AdminIzinController::class, 'destroy'])->name('izin.destroy');

    // Simakan & Setor Hafalan
    Route::get('/simakan', [\App\Http\Controllers\AdminSimakanController::class, 'index'])->name('simakan.index');
    Route::put('/simakan/config', [\App\Http\Controllers\AdminSimakanController::class, 'updateConfig'])->name('simakan.config.update');
    Route::post('/simakan/code/regenerate', [\App\Http\Controllers\AdminSimakanController::class, 'regenerateCode'])->name('simakan.code.regenerate');
    Route::post('/simakan/penyimak', [\App\Http\Controllers\AdminSimakanController::class, 'storePenyimak'])->name('simakan.penyimak.store');
    Route::put('/simakan/penyimak/{id}', [\App\Http\Controllers\AdminSimakanController::class, 'updatePenyimak'])->name('simakan.penyimak.update');
    Route::delete('/simakan/penyimak/{id}', [\App\Http\Controllers\AdminSimakanController::class, 'destroyPenyimak'])->name('simakan.penyimak.destroy');
    Route::delete('/simakan/{id}', [\App\Http\Controllers\AdminSimakanController::class, 'destroy'])->name('simakan.destroy');

    // Clear Cache Route
    Route::get('/clear-cache', function () {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }
        return redirect()->back()->with('success', '⚡ Cache sistem & views berhasil dibersihkan!');
    })->name('clear-cache');
});

require __DIR__.'/auth.php';
