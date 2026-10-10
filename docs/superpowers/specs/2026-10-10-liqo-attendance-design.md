# Desain: Absensi Liqo via Link Rahasia Bersama

**Tanggal:** 2026-10-10
**Status:** Disetujui (brainstorming), menunggu implementation plan

## 1. Latar Belakang & Tujuan

Saat ini `kajian-santri` punya pelacakan kehadiran untuk sesi `Kajian`, `Subuh`, dan `Tahsin` (via `attendance_logs.session_type`), semuanya diinput lewat panel admin yang butuh login `auth:admin`. Belum ada konsep **liqo** (kelompok bimbingan kecil), **kelompok**, atau **MR** (guru/pembimbing liqo) di sistem sama sekali.

Tujuan fitur ini: guru pembimbing liqo bisa mengisi absensi kelompoknya sendiri lewat satu link khusus, tanpa perlu akun/login terpisah, langsung dari HP setelah sesi liqo selesai. Hasilnya otomatis masuk ke Rekap Santri sebagai kategori "Liqo" baru, memakai pipeline Rekap yang sudah ada.

## 2. Keputusan Desain Kunci

Ringkasan keputusan yang sudah dikonfirmasi selama brainstorming (lihat alasan di tiap bagian):

- **1 link rahasia dipakai bersama** oleh semua guru liqo (bukan link unik per guru). Guru memilih namanya sendiri dari dropdown di dalam form.
- **1 guru = 1 MR** = 1 kelompok tetap (dropdown MR secara teknis fungsional — dipakai guru untuk mengidentifikasi dirinya — tapi tidak ada verifikasi kriptografis bahwa yang mengisi benar-benar guru itu; murni berbasis kepercayaan antar guru yang memegang link rahasia).
- Resubmit untuk tanggal yang sama → form otomatis **menampilkan data lama dalam mode edit**, bukan menolak atau menambah duplikat.
- Tanggal dibatasi: **hari ini mundur sampai 7 hari ke belakang**, tidak bisa pilih tanggal depan atau lebih dari 7 hari lalu.
- Reuse `attendance_logs` yang sudah ada (tambah `session_type = 'Liqo'`) — bukan tabel liqo yang terisolasi — supaya otomatis terintegrasi ke Rekap.
- Relasi santri-ke-kelompok pakai **kolom flat** `students.liqo_group_id`, bukan tabel pivot many-to-many (karena 1 santri hanya ikut 1 kelompok liqo, konsisten dengan kolom `room`/`generation` yang sudah ada di `students`).
- Admin bisa bikin/assign kelompok manual **atau** bulk import lewat spreadsheet.
- Visual: **glassmorphism, palet minim 1 warna aksen**, bukan neo-brutalist warna-warni — supaya tetap jelas dibaca lintas usia (termasuk guru yang tidak terbiasa UI modern).

## 3. Data Model

### 3.1 Tabel baru `liqo_groups`

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| name | string | Nama MR/guru pembimbing, muncul di dropdown form |
| is_active | boolean, default true | Admin bisa nonaktifkan tanpa hapus data historis |
| created_at, updated_at | timestamp | |

### 3.2 Tabel `students` — kolom baru

- `liqo_group_id` — `unsignedBigInteger`, nullable, FK ke `liqo_groups.id`, `onDelete('set null')`. Menentukan kelompok liqo santri tersebut. Diisi lewat panel admin (manual atau import spreadsheet).

### 3.3 Tabel `settings` — kolom baru

- `liqo_access_code` — string, nullable. Kode rahasia yang jadi bagian URL publik (`/liqo/{liqo_access_code}`). Di-generate otomatis (random string, misal `Str::random(32)`) saat fitur pertama kali diaktifkan dari halaman Pengaturan, dan bisa di-regenerate kapan saja lewat tombol "Regenerate Link" kalau link bocor.

### 3.4 Tabel `attendance_logs` — migration tambahan

- Modifikasi ENUM `session_type` dari `['Kajian', 'Subuh', 'Tahsin']` menjadi `['Kajian', 'Subuh', 'Tahsin', 'Liqo']`. Laravel tidak punya helper native untuk modify enum column, jadi migration ini pakai raw SQL (`DB::statement("ALTER TABLE attendance_logs MODIFY session_type ENUM('Kajian','Subuh','Tahsin','Liqo')")`) — perlu disesuaikan ke driver DB yang dipakai (MySQL).
- Submission liqo ditulis sebagai baris per santri di kelompok itu: `student_id`, `attendance_date`, `status` (H/I/A/S), `session_type = 'Liqo'`, `kajian_topic` = materi (disalin sama ke semua baris dalam 1 submission), `notes` = catatan tambahan (disalin sama ke semua baris, boleh null).

### 3.5 Relasi model baru

- `LiqoGroup::members()` → `hasMany(Student::class, 'liqo_group_id')`
- `Student::liqoGroup()` → `belongsTo(LiqoGroup::class, 'liqo_group_id')`

## 4. Flow Publik (Tanpa Login)

### 4.1 Routing & Keamanan Akses

- `GET /liqo/{code}` — tampilkan form. Middleware custom (`App\Http\Middleware\VerifyLiqoAccessCode`) membandingkan `{code}` dengan `Setting::first()->liqo_access_code`. Tidak cocok → `abort(404)` (bukan 403, supaya tidak membocorkan bahwa route ini eksis).
- `POST /liqo/{code}` — proses submit. Middleware akses sama + `throttle:10,1` (maks 10 request/menit) sebagai jaga-jaga dari spam/bot, bukan dari penebakan token (token 32 karakter acak praktis tidak bisa ditebak).
- Route ini tetap di dalam grup middleware `web` default (bukan `api`), jadi CSRF protection & session tetap berlaku normal untuk tamu/guest.

### 4.2 Field Form

1. **Nama MR** — dropdown dari `LiqoGroup::where('is_active', true)->orderBy('name')->get()`.
2. **Hari/Tanggal** — date picker. Default hari ini. `min` = hari ini − 7 hari, `max` = hari ini (divalidasi juga di server, bukan cuma atribut HTML).
3. **Checklist kehadiran** — setelah MR dipilih (AJAX, tanpa reload halaman), tampilkan santri dari `Student::where('liqo_group_id', $groupId)->where('status_aktif', 'Aktif')->orderBy('name')->get()`. Tiap santri punya 1 pilihan status: Hadir (H) / Izin (I) / Alpha (A) / Sakit (S), default belum dipilih.
4. **Materi** — teks singkat, required.
5. **Catatan tambahan** — textarea, optional.

### 4.3 Mode Edit Otomatis

Saat MR + tanggal dipilih (baik saat pertama render maupun lewat AJAX), backend mengecek apakah sudah ada `attendance_logs` untuk `session_type='Liqo'`, `attendance_date` = tanggal terpilih, `student_id` termasuk salah satu anggota kelompok itu.

- **Ada data lama** → form terisi otomatis: status tiap santri, materi, dan catatan diambil dari baris-baris yang sudah ada (materi/catatan diasumsikan sama di semua baris kelompok itu pada tanggal itu, karena ditulis dari submission yang sama). Submit berikutnya meng-overwrite: hapus semua baris lama untuk kombinasi kelompok+tanggal itu, lalu insert baris baru — pola yang sama seperti `AdminAttendanceController::store()` yang sudah ada di codebase.
- **Tidak ada data lama** → form kosong seperti biasa, submit = insert baru.

### 4.4 Validasi Server

- `liqo_group_id` yang dikirim dari form divalidasi `exists:liqo_groups,id` dan `is_active = true`. Server tidak bisa memverifikasi bahwa pengisi adalah MR yang sebenarnya (lihat batasan keamanan di bagian 2) — ini risiko yang disadari dan diterima oleh pemilik produk.
- `attendance_date` divalidasi ada di rentang hari ini−7 s/d hari ini.
- Setiap santri di kelompok itu harus punya status (tidak boleh ada yang kosong) sebelum submit diterima.
- `materi` required, `catatan` optional.

## 5. Manajemen Admin ("Kelola Liqo")

Menu baru di panel admin (`auth:admin`), prefix `/admin/liqo`.

### 5.1 CRUD Kelompok Manual

- List semua `LiqoGroup`: nama MR, jumlah anggota, status aktif.
- Tambah / edit nama MR, toggle aktif/nonaktif (nonaktif = hilang dari dropdown form publik, data historis tetap ada).
- Halaman detail per MR: lihat daftar anggota, tambah/hapus santri satu-satu dari daftar santri aktif yang belum punya kelompok (atau pindah kelompok).

### 5.2 Import Spreadsheet

- Tombol **"Download Template"**: unduh `.xlsx` kosong dengan header `Nama Santri | Nama MR`.
- Tombol **"Import Spreadsheet"**: upload file terisi. Diproses lewat `app/Imports/LiqoMembersImport.php` (pakai package `maatwebsite/excel` yang sudah terpasang di project — saat ini baru dipakai untuk export, ini jadi penggunaan import pertama).
- Logika per baris:
  1. Kolom **Nama MR** → `LiqoGroup::firstOrCreate(['name' => trim($row['nama_mr'])])`.
  2. Kolom **Nama Santri** → cari `Student::where('status_aktif', 'Aktif')->whereRaw('LOWER(name) = ?', [strtolower(trim($row['nama_santri']))])`.
     - Ketemu tepat 1 → set `liqo_group_id` ke MR dari langkah 1 (overwrite kalau sebelumnya sudah punya kelompok lain).
     - Ketemu 0 atau lebih dari 1 (nama ganda) → baris di-skip, dicatat sebagai error. **Tidak** auto-create santri baru — Student butuh `username`/`password` valid untuk login, tidak aman di-generate otomatis dari data spreadsheet.
- Setelah proses selesai, tampilkan ringkasan: jumlah baris berhasil, jumlah gagal + daftar baris gagal dengan alasannya (nama tidak ditemukan / nama ganda), supaya admin bisa perbaiki manual.

### 5.3 Kode Akses Liqo

- Di halaman Pengaturan admin yang sudah ada, tambah 1 baris baru: tampilkan link lengkap (`{app_url}/liqo/{liqo_access_code}`) dengan tombol copy, dan tombol **"Regenerate"** yang men-generate `liqo_access_code` baru (membuat link lama langsung tidak berfungsi).

## 6. Integrasi ke Rekap Santri

- `RekapController::VALID_SESSIONS` → tambah `'Liqo'`, jadi `['Kajian', 'Tahsin', 'Liqo']`. Ini otomatis memunculkan "Liqo" sebagai pilihan session type di overview, detail (mingguan/bulanan/tahunan), export Excel, dan export PDF — tanpa logic tambahan karena seluruh `RekapController` sudah generik berdasarkan `session_type`.
- `RekapController::index()` — array hardcode `['Kajian', 'Subuh', 'Tahsin']` untuk ring chart per sesi → tambah `'Liqo'` juga.
- `AdminAttendanceController::VALID_SESSIONS` → tambah `'Liqo'`, supaya admin tetap bisa input/koreksi manual sebagai jalur cadangan (bukan jalur utama) kalau guru lupa isi atau link bermasalah.
- Blade yang punya selector session type (`rekap.blade.php`, `rekap-detail.blade.php`, `admin/attendance/index.blade.php`) → tambah opsi tab/label "Liqo".

Tidak perlu tabel atau halaman rekap baru — murni menambah satu nilai session type ke beberapa tempat yang sudah ada.

## 7. Arah Desain Visual (UI/UX)

Target: guru mengisi dari HP, buru-buru/sambil berdiri setelah sesi liqo, termasuk guru yang tidak terbiasa UI modern — jadi harus **cepat dipahami**, bukan sekadar estetik.

**Gaya**: glassmorphism yang tenang — bukan neo-brutalist warna-warni yang sudah dipakai di halaman Rekap. Alasan: neo-brutalist multi-warna (hijau/kuning/merah/biru) berisiko membingungkan pengguna yang kurang familiar dengan konvensi UI berbasis warna.

- **Background**: gradient sangat pudar nyaris putih (putih → mint pudar), blur halus, tidak mencolok.
- **Kartu**: glass panel — putih semi-transparan ~85-90% opacity + `backdrop-blur-xl`, border putih tipis 1px, shadow lembut. Opacity dijaga tetap tinggi (bukan kaca bening penuh) agar teks tetap terbaca — risiko utama glassmorphism adalah kontras rendah, terutama untuk pengguna dengan penglihatan kurang tajam.
- **Warna**: hanya **1 warna aksen** (hijau `primary` yang sudah ada di design token app, `#003527` light / `#4ade80` dark), dipakai untuk status terpilih & tombol submit. Status kehadiran (H/I/A/S) dibedakan lewat **label teks jelas** dalam segmented control, bukan lewat warna berbeda-beda — yang terpilih terisi warna aksen, yang tidak terpilih abu-abu netral.
- **Tipografi**: tetap Space Grotesk (judul) + Inter (body), konsisten dengan sistem desain app yang sudah ada. Ukuran font sedikit lebih besar dari standar untuk keterbacaan.
- **Layout mobile** (prioritas utama):

```
┌─────────────────────────┐
│ ✅ 9/15 santri dicek     │ ← pill kaca, counter live
├─────────────────────────┤
│ [Pilih Nama MR ▾]       │
│ [📅 Tanggal: Hari ini]  │
├─────────────────────────┤
│ Ahmad    [Hadir][Izin][Alpha][Sakit] │
│ Budi     [Hadir][Izin][Alpha][Sakit] │
│ ...  (scroll di dalam 1 glass panel)
├─────────────────────────┤
│ Materi: [___________]   │
│ Catatan: [___________]  │
├─────────────────────────┤
│   [ SIMPAN ABSENSI ]    │ ← sticky bottom, besar
└─────────────────────────┘
```

- **Signature**: pill counter "9/15 santri dicek" di atas, update live setiap kali guru menandai status santri (animasi pop kecil, bukan berlebihan). Begitu semua santri sudah ditandai + materi terisi, tombol "Simpan Absensi" otomatis berubah dari outline abu-abu jadi terisi warna aksen — sinyal visual "siap submit" tanpa guru harus scroll cek ulang satu-satu.
- **Micro-interaction**: tap status → scale pop kecil (0.95→1.05→1) + warna fill instan. Tidak ada animasi tambahan lain, demi kecepatan pakai.

## 8. Testing

- Feature test: submit form liqo dengan `{code}` benar → `attendance_logs` terisi sesuai roster kelompok, `kajian_topic`/`notes` tersalin ke semua baris dalam submission itu.
- Feature test: akses dengan `{code}` salah → `404`.
- Feature test: submit ulang untuk tanggal yang sama → data lama di-overwrite (jumlah baris tetap sama, bukan dobel).
- Feature test: tanggal di luar rentang hari ini−7 s/d hari ini → ditolak validasi server (meski client-side date picker sudah dibatasi).
- Feature test: import spreadsheet — campuran baris valid (nama ketemu tepat 1) dan invalid (nama tidak ketemu / ganda) → ringkasan sukses/gagal akurat, `liqo_group_id` santri yang valid ter-update benar, yang invalid tidak diubah.
- Manual check: Rekap (overview, detail, export Excel & PDF) menampilkan data "Liqo" dengan benar setelah 1-2 kali submit dummy.

## 9. Batasan & Risiko yang Disadari

- **Tidak ada verifikasi identitas guru** — siapapun yang punya link rahasia bisa mengisi atas nama MR manapun di dropdown. Ini keputusan sadar pemilik produk (lihat bagian 2), bukan oversight.
- **1 santri hanya bisa ikut 1 kelompok liqo** — kalau ke depan ada kebutuhan santri ikut lebih dari 1 kelompok, kolom flat `liqo_group_id` perlu dimigrasikan ke pivot table (di luar scope saat ini).
- **Materi/catatan diasumsikan sama untuk seluruh kelompok dalam 1 submission** — tidak ada mekanisme materi berbeda per santri dalam 1 kelompok pada tanggal yang sama.
