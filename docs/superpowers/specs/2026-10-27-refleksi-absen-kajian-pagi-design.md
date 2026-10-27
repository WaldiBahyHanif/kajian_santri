# Refleksi sebagai Metode Absen Kajian Pagi + Carousel Refleksi di Home

**Status:** Approved
**Tanggal:** 2026-10-27

## Latar Belakang

Saat ini absen kajian pagi (`session_type = 'Kajian'`) hanya bisa dilakukan lewat scan QR (`AttendanceController`) atau input manual admin (`AdminAttendanceController`). Fitur refleksi (`ReflectionController`, tabel `reflections`) sudah ada tapi berdiri sendiri: hanya jurnal teks bebas, tidak terhubung ke kitab yang dikaji maupun ke absensi.

Home (`dashboard.blade.php`) menampilkan maksimal 6 refleksi terbaru dalam grid statis, teks panjang dipotong (`line-clamp-4`) tanpa cara melihat teks lengkap.

Ditemukan juga masalah lama: tabel `topics` ada di database tapi tidak punya migration pembuatnya (`create_topics_table` hilang/tidak pernah di-commit). Migration `2026_06_20_140750_add_start_time_to_topics_table.php` mengasumsikan tabel `topics` sudah ada, sehingga fresh migrate (misalnya setup server baru) akan gagal di migration tersebut.

## Tujuan

1. Santri bisa absen kajian pagi dengan cara menulis refleksi: pilih kitab (topic) yang dikaji hari ini + tulis minimal 1 kalimat.
2. Home menampilkan refleksi maksimal 5 per halaman, auto-geser ke halaman berikutnya setiap 5 detik (loop), dengan dot indikator untuk navigasi manual.
3. Refleksi panjang yang terpotong punya tombol "Lihat Selengkapnya" untuk melihat isi penuh.
4. Absen manual oleh admin tetap berjalan seperti sekarang, tidak diubah.
5. Memperbaiki migration `topics` yang hilang agar fresh install/deploy tidak gagal.

## Keputusan Desain (sudah dikonfirmasi user)

- Submit refleksi **otomatis menandai absen** `Kajian` hari itu (status `H`) jika santri belum absen hari itu dengan cara apapun. Jika sudah absen (misal via QR), refleksi tetap tersimpan tanpa membuat log absen duplikat.
- Pilihan "topic kitab" diambil dari tabel `topics` yang dijadwalkan untuk **hari ini saja** (`day_index` sesuai hari ini). Karena `day_index` adalah `unique` di tabel `topics`, maksimal hanya ada 1 kitab terjadwal per hari — field ini ditampilkan sebagai select dengan 1 opsi terisi otomatis (hidden input), bukan dropdown bebas.
- Validasi "minimal 1 kalimat" didekati dengan aturan panjang karakter sederhana (minimal 10 karakter), sama seperti validasi yang sudah ada sekarang. Tidak mengecek tanda baca.
- Kalau tidak ada topic terjadwal untuk hari ini: form refleksi (textarea + tombol submit) **dinonaktifkan** dan menampilkan pesan info. Validasi ini juga ditegakkan ulang di server (bukan hanya di client), untuk mencegah submit dari halaman basi.
- Carousel refleksi di home: auto-geser tiap 5 detik + dot indikator yang bisa diklik untuk pindah manual (klik dot juga mereset timer auto-geser).
- Migration `create_topics_table` yang hilang akan ditambahkan sebagai bagian dari pekerjaan ini, karena fitur baru membutuhkan foreign key `reflections.topic_id -> topics.id`.

## Perubahan Data Model

### Migration baru 1: `create_topics_table` (mengisi gap lama)

Ditempatkan di `2026_06_16_000002_create_topics_table.php` (setelah `create_asatiz_attendance_table`, sebelum `add_start_time_to_topics_table` yang sudah ada). Dibungkus `if (!Schema::hasTable('topics'))` mengikuti konvensi migration lain di project ini, sehingga aman dijalankan meskipun tabel sudah ada di server saat ini.

Kolom: `id`, `day_index` (unsignedTinyInteger), `title` (string, 100), `description` (text, nullable), `asatiz_id` (nullable, foreign ke `asatiz.id`, `nullOnDelete`). Tanpa timestamps, karena `Topic` model memakai `public $timestamps = false`.

### Migration baru 2: `add_topic_id_to_reflections_table`

Tambah kolom `topic_id` (nullable, unsignedBigInteger, foreign ke `topics.id`, `nullOnDelete`) di tabel `reflections`, setelah kolom `content`. Nullable agar refleksi lama (sebelum fitur ini) tetap valid tanpa backfill.

### Model

- `App\Models\Reflection`: tambah `topic_id` ke `$fillable`; tambah relasi `topic(): belongsTo(Topic::class)`.
- `App\Models\Topic`: tidak ada perubahan (field yang dibutuhkan sudah lengkap).

## Perubahan Backend

### `ReflectionController::index()`

- Hitung `$todayDayIndex = Carbon::today()->dayOfWeekIso` (konvensi yang sama dipakai di `AdminController` dan `AdminAsatizController` — 1=Senin...7=Minggu).
- `$todayTopic = Topic::where('day_index', $todayDayIndex)->first();`
- Cek apakah user sudah punya `AttendanceLog` untuk `session_type = 'Kajian'` hari ini (status apapun) → `$alreadyAttendedToday` (boolean), untuk ditampilkan sebagai info di UI.
- Kirim `$todayTopic` dan `$alreadyAttendedToday` ke view selain `$reflections` yang sudah ada.

### `ReflectionController::store()`

- Validasi:
  - `content`: `required|string|min:10|max:2000` (sama seperti sekarang).
  - `topic_id`: `required|integer`. Setelah validasi dasar, hitung ulang `$todayTopic` di server dan **tolak** request (redirect back dengan error) kalau `$todayTopic` kosong atau `$request->topic_id != $todayTopic->id`. Ini mencegah manipulasi dari halaman yang sudah basi (dibuka kemarin, dsb).
- Buat `Reflection` dengan `topic_id` terisi.
- Cek `AttendanceLog` existing untuk user ini, `session_type = 'Kajian'`, `attendance_date = today`. Kalau tidak ada:
  - Buat `AttendanceLog` baru: `status = 'H'`, `attendance_date = today`, `attendance_time = now()`, `session_type = 'Kajian'`, `kajian_topic = $todayTopic->title`.
  - Panggil `Auth::user()->recalculateStats()` (fungsi yang sama dipakai `AttendanceController::processScan`), supaya streak & total attendance ikut update.
  - Flash message: "Refleksi berhasil disimpan & kamu otomatis tercatat Hadir Kajian Pagi hari ini! 🎉"
- Kalau log absen hari ini sudah ada (dari metode manapun): flash message: "Refleksi berhasil disimpan! (Absen Kajian Pagi hari ini sudah tercatat sebelumnya)"

### Tidak ada perubahan

- `AttendanceController` (scan QR) — tidak disentuh.
- `AdminAttendanceController` (absen manual admin) — tidak disentuh.

## Perubahan Frontend

### `resources/views/refleksi.blade.php`

- Form ditambah field "Kitab yang dikaji hari ini": kalau `$todayTopic` ada, tampilkan sebagai `<select disabled>` berisi 1 opsi (judul kitab) + `<input type="hidden" name="topic_id" value="{{ $todayTopic->id }}">`.
- Kalau `$todayTopic` kosong: tampilkan banner info "Belum ada topic kajian pagi terjadwal untuk hari ini — hubungi admin." dan nonaktifkan textarea + tombol submit (atribut `disabled`).
- Kalau `$alreadyAttendedToday` true: tampilkan badge kecil "✅ Kamu sudah absen Kajian Pagi hari ini" di atas form (refleksi tetap bisa ditulis sebagai jurnal, hanya tidak membuat absen baru).
- Label counter karakter diubah jadi "Minimal 1 kalimat (±10 karakter)".
- Riwayat refleksi: setiap entri menampilkan badge nama kitab (`$reflection->topic->title`) kalau `topic_id` tidak null.

### `resources/views/dashboard.blade.php` + `DashboardController`

- `DashboardController::index()`: ubah `Reflection::with('user')->take(6)` menjadi `take(20)` agar ada cukup data untuk beberapa halaman carousel.
- Section "Refleksi Harian Santri":
  - Setiap card diberi `data-page` (index halaman, dihitung `floor($loop->index / 5)`), dan loop dibungkus wrapper `#reflection-carousel` dengan dot indikator di bawah grid (jumlah dot = jumlah halaman, dibuat via `ceil(count($reflections) / 5)`).
  - JS: `setInterval` 5000ms memajukan halaman aktif (toggle class `hidden` per grup `data-page`), loop ke halaman 0 setelah halaman terakhir. Klik dot memindah halaman aktif secara manual + reset interval.
  - Teks refleksi (`line-clamp-4`) ditambah tombol "Lihat Selengkapnya" yang muncul kalau panjang `content` melebihi ambang batas (misal >180 karakter, dicek di Blade). Klik tombol membuka modal overlay sederhana (satu modal dipakai bersama, diisi via `data-*` attribute per card: nama, waktu, isi lengkap) — pola yang sama seperti `<x-calendar-modal />` yang sudah ada di project ini.

### Admin (opsional, low-risk)

- `admin/refleksi` (`AdminRefleksiController`/view terkait): tampilkan nama kitab per baris refleksi kalau ada, murni kosmetik, tidak mengubah logika apapun.

## Penanganan Error / Edge Case

- Topic hari ini divalidasi ulang di server setiap submit (bukan hanya mengandalkan hidden input dari client) — mencegah absen dengan topic yang salah dari tab browser yang sudah lama terbuka.
- Tidak ada locking/transaction khusus untuk mencegah race condition absen ganda (misal submit refleksi dan scan QR nyaris bersamaan) — mengikuti pola yang sudah dipakai `AttendanceController` (check-then-create), karena skala & concurrency aplikasi ini kecil.
- Refleksi tanpa topic (data lama) tetap tampil normal di home & riwayat, cukup tanpa badge kitab.

## Testing Manual (tidak ada automated test untuk fitur ini)

1. Submit refleksi saat topic hari ini ada & belum absen → `Reflection` + `AttendanceLog` (status H, session_type Kajian) tercipta, streak santri bertambah.
2. Submit refleksi saat sudah absen hari ini (lewat QR) → `Reflection` tercipta, tidak ada `AttendanceLog` duplikat, pesan sesuai.
3. Submit saat tidak ada topic terjadwal hari ini → form nonaktif di UI; request langsung ke endpoint tetap ditolak server dengan error.
4. Home dengan >5 refleksi → carousel pindah halaman otomatis tiap 5 detik, dot indikator bisa diklik, loop kembali ke halaman pertama.
5. Refleksi dengan isi panjang → tombol "Lihat Selengkapnya" muncul dan modal menampilkan teks lengkap.
6. Fresh migrate (`php artisan migrate:fresh`) berhasil tanpa error di migration `topics`.
