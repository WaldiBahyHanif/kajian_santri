# Implementation Plan: Absensi Liqo via Link Rahasia Bersama

**Spec rujukan:** `docs/superpowers/specs/2026-10-10-liqo-attendance-design.md`
**Status:** Siap dikerjakan

Urutan di bawah disusun supaya setiap langkah bisa dijalankan & diverifikasi (`php artisan migrate`, buka halaman) sebelum lanjut ke langkah berikutnya. Laravel 13, driver DB diasumsikan MySQL (sesuai `config/database.php` default Laragon).

## Fase 1 — Skema Database

1. **Migration `create_liqo_groups_table`**
   - Kolom: `id`, `name` (string), `is_active` (boolean, default true), timestamps.
2. **Migration `add_liqo_group_id_to_students_table`**
   - `liqo_group_id` unsignedBigInteger nullable, setelah kolom `generation`.
   - Foreign key ke `liqo_groups.id`, `onDelete('set null')`.
3. **Migration `add_liqo_access_code_to_settings_table`**
   - `liqo_access_code` string nullable.
4. **Migration `add_liqo_to_attendance_logs_session_type_enum`**
   - Raw SQL modify enum: tambah `'Liqo'` ke daftar `session_type`.
   - Cek dulu di `AsatizAttendance`/tempat lain apakah ada enum serupa yang perlu konsisten — tidak perlu, `asatiz_attendance` enum `status` beda konteks.
5. Jalankan `php artisan migrate`, verifikasi lewat `php artisan tinker` bahwa insert `AttendanceLog::create([..., 'session_type' => 'Liqo'])` tidak error.

## Fase 2 — Model & Relasi

6. Buat `app/Models/LiqoGroup.php`:
   - `$fillable = ['name', 'is_active']`
   - `members()` → `hasMany(Student::class, 'liqo_group_id')`
7. Edit `app/Models/Student.php`:
   - Tambah `'liqo_group_id'` ke `$fillable`.
   - Tambah method `liqoGroup()` → `belongsTo(LiqoGroup::class, 'liqo_group_id')`.
8. Edit `app/Models/Setting.php`:
   - Tambah `'liqo_access_code'` ke `$fillable` (cek dulu pola `getTahsinDays()`/`defaultLandingPage()` yang sudah ada untuk konsistensi gaya helper).
   - Tambah static helper `getOrCreateLiqoAccessCode()`: ambil `Setting::first()->liqo_access_code`, kalau null generate `Str::random(32)`, simpan, return.
   - Tambah static helper `regenerateLiqoAccessCode()`: generate baru, simpan, return.

## Fase 3 — Middleware Akses Publik

9. Buat `app/Http/Middleware/VerifyLiqoAccessCode.php`:
   - Ambil `{code}` dari route parameter.
   - Bandingkan dengan `Setting::first()->liqo_access_code` (gunakan `hash_equals` untuk perbandingan aman terhadap timing attack).
   - Tidak cocok → `abort(404)`.
10. Daftarkan alias middleware di `bootstrap/app.php` (project ini sudah Laravel 13 tanpa `Kernel.php`, pakai `$middleware->alias([...])` seperti alias `'admin'` yang sudah ada) — tambah `'liqo.access' => \App\Http\Middleware\VerifyLiqoAccessCode::class`.

## Fase 4 — Flow Publik (Guru Isi Form)

11. Buat `app/Http/Controllers/LiqoAttendanceController.php`:
    - `show(Request $request, string $code)` — load `LiqoGroup::where('is_active', true)->orderBy('name')->get()` untuk dropdown, render view.
    - `roster(Request $request, string $code)` — endpoint AJAX: terima `liqo_group_id` + `date`, return JSON daftar santri aktif di kelompok itu + status existing (mode edit) kalau ada submission di tanggal itu + materi/catatan existing.
    - `store(Request $request, string $code)` — validasi (`liqo_group_id` exists & active, `attendance_date` dalam rentang H-7 s/d H, `materi` required, `statuses.*` required in H/I/A), hapus baris lama untuk kombinasi kelompok+tanggal itu, insert baris baru per santri (pola sama seperti `AdminAttendanceController::store()`), panggil `recalculateStats()` per santri kalau relevan.
12. Tambah route di `routes/web.php` (di luar grup `auth`/`auth:admin`, pakai middleware `VerifyLiqoAccessCode` + `throttle:10,1` untuk POST):
    ```
    Route::middleware(['liqo.access'])->prefix('liqo')->group(function () {
        Route::get('/{code}', [LiqoAttendanceController::class, 'show'])->name('liqo.show');
        Route::get('/{code}/roster', [LiqoAttendanceController::class, 'roster'])->name('liqo.roster');
        Route::post('/{code}', [LiqoAttendanceController::class, 'store'])->middleware('throttle:10,1')->name('liqo.store');
    });
    ```
13. Buat view `resources/views/liqo/form.blade.php`:
    - Struktur sesuai wireframe di spec: pill counter, dropdown MR, date picker (`min`/`max` di-set JS sesuai H-7/H), checklist santri (segmented control H/I/A per baris), input materi, textarea catatan, tombol submit sticky.
    - Styling glassmorphism sesuai Section 7 spec: 1 warna aksen (`primary` token yang sudah ada), kartu `backdrop-blur-xl` + opacity tinggi, label teks untuk status (bukan warna-warni).
    - JS: fetch ke endpoint `roster` saat MR/tanggal berubah, update counter live saat status diklik, toggle state tombol submit (disabled/outline → aktif) saat semua santri + materi terisi.

## Fase 5 — Panel Admin "Kelola Liqo"

14. Buat `app/Http/Controllers/AdminLiqoController.php` (resource-style, ikuti pola `AdminAsatizController`):
    - `index`, `store`, `update`, `destroy` untuk `LiqoGroup`.
    - `showMembers($id)` — detail anggota kelompok, form tambah/hapus santri satu-satu.
15. Buat `app/Imports/LiqoMembersImport.php`:
    - Implement `ToCollection` (atau `OnEachRow`) dari `maatwebsite/excel`.
    - Logika per baris sesuai Section 5.2 spec: `firstOrCreate` `LiqoGroup` by nama MR, cocokkan santri by nama (case-insensitive, exact, hanya status_aktif='Aktif'), skip + catat error kalau 0 atau >1 match.
    - Kumpulkan ringkasan hasil (`success_count`, `errors[]`) untuk ditampilkan balik ke admin.
16. Tambah action `import` + `downloadTemplate` di `AdminLiqoController`.
17. Tambah route resource `admin/liqo` + route `admin/liqo/import` + `admin/liqo/template` di `routes/web.php` (dalam grup `auth:admin`).
18. Buat view `resources/views/admin/liqo/index.blade.php` (list + form tambah MR + upload spreadsheet + link download template) dan `resources/views/admin/liqo/members.blade.php` (kelola anggota per kelompok), ikuti gaya neo-brutalist admin yang sudah ada (konsisten dengan `admin/santri/index.blade.php`).
19. Tambah item menu "Kelola Liqo" di `resources/views/components/admin-layout.blade.php`.

## Fase 6 — Kode Akses di Halaman Pengaturan

20. Edit `AdminPengaturanController` (`index`/`update` yang sudah ada): tambah data `liqoAccessCode` + `liqoLink` (gabungan `url('/liqo') . '/' . $code`) ke view.
21. Edit `resources/views/admin/pengaturan/index.blade.php`: tambah baris baru menampilkan link lengkap + tombol copy + tombol "Regenerate" (POST ke action baru `AdminPengaturanController::regenerateLiqoCode`).
22. Tambah route `POST /admin/pengaturan/liqo-code/regenerate`.

## Fase 7 — Integrasi Rekap

23. `app/Http/Controllers/RekapController.php`:
    - `VALID_SESSIONS` → tambah `'Liqo'`.
    - Array `['Kajian', 'Subuh', 'Tahsin']` di method `index()` (ring chart) → tambah `'Liqo'`.
24. `app/Http/Controllers/AdminAttendanceController.php`:
    - `VALID_SESSIONS` → tambah `'Liqo'` (fallback input manual oleh admin).
25. Blade: `resources/views/rekap.blade.php`, `resources/views/rekap-detail.blade.php`, `resources/views/admin/attendance/index.blade.php` → tambah opsi/tab "Liqo" di selector session type yang sudah ada.

## Fase 8 — Testing

**Keputusan:** tidak menulis PHPUnit feature test otomatis untuk fitur ini. Saat mengerjakan Fase 8, ditemukan bug lama (pre-existing, tidak terkait Liqo): migration yang membuat tabel `topics` hilang dari repo — tabel itu hanya ada di database produksi, dibuat di luar migration. Akibatnya `php artisan migrate` dari nol (baik di SQLite test maupun MySQL kosong) selalu gagal di titik itu, jadi seluruh test suite project ini (bukan cuma punya Liqo) tidak bisa jalan dari fresh state sampai bug itu diperbaiki secara terpisah. Pemilik produk memilih untuk tidak memperbaiki bug ini sekarang (di luar scope) dan cukup mengandalkan verifikasi manual yang sudah dilakukan di setiap fase:

- Fase 4 (manual, via curl terhadap server lokal): code salah → 404; code benar → 200; submit → baris `attendance_logs` sesuai roster dengan `kajian_topic`/`notes` tersalin; submit ulang tanggal sama → overwrite, bukan dobel; tanggal di luar rentang H-7 s/d H → ditolak validasi server.
- Fase 5 (manual, via tinker terhadap database produksi yang di-import): CRUD kelompok, tambah/hapus anggota, download template, import 3 baris (2 valid + 1 nama tidak ketemu) → ringkasan akurat dan `liqo_group_id` ter-update benar.
- Fase 6 (manual, via tinker + curl): regenerate link → link lama langsung 404, link baru langsung aktif.
- Fase 7 (manual, via tinker): overview/detail/export Excel/export PDF/admin fallback semua render tanpa error untuk `session_type=Liqo`, dan `totalKBMDays`/persentase kehadiran terbukti akurat (bukan terdilusi).

Kalau suatu saat bug migration `topics` diperbaiki terpisah, test otomatis untuk flow Liqo ini bisa ditulis menyusul mengikuti skenario yang sama seperti verifikasi manual di atas.

## Catatan Eksekusi

- Kerjakan Fase 1-4 dulu sampai bisa submit end-to-end lewat form publik sebelum masuk ke Fase 5 (admin CRUD) — supaya ada data nyata untuk ditest saat bangun panel admin.
- Fase 5 & 6 bisa paralel kalau dikerjakan lebih dari satu sesi, karena tidak saling depend.
- Fase 7 baru masuk akal setelah Fase 1 (enum `Liqo` sudah ada) dan Fase 4/5 (ada data untuk divalidasi tampil di Rekap).
