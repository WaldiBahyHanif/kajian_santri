# Kebun Pondok — Pohon Pixel Art Per-Santri (ala Harvest Moon)

**Status:** Approved
**Tanggal:** 2026-10-27

## Latar Belakang

"Kebun Kebaikan" yang ada saat ini (section di `dashboard.blade.php`, sekitar baris 342-569) adalah **satu scene kebun bersama** untuk seluruh pondok: satu pohon, satu status (`subur_sekali`/`subur`/`biasa`/`kering`) dikontrol admin lewat `Setting::garden_status`/`garden_mode`, digambar dengan SVG vektor kartun neobrutalis (bukan pixel art). Ditemukan juga dua partial lama yang sudah tidak dipakai di manapun (`resources/views/dashboard/partials/header_kebun.blade.php` dan `header.blade.php`) — dead code, di luar scope pekerjaan ini.

User ingin tiap santri punya pohon masing-masing, dengan gaya visual 2D pixel art seperti game Harvest Moon.

## Tujuan

1. Halaman baru yang menampilkan kebun berisi petak-petak pohon milik setiap santri aktif, bergaya pixel art retro.
2. Tahap pertumbuhan pohon tiap santri dihitung dari persentase kehadiran Kajian pribadi 30 hari terakhir.
3. Tidak mengubah scene kebun bersama yang sudah ada di dashboard.

## Keputusan Desain (sudah dikonfirmasi user)

- **Lokasi**: halaman baru terpisah `/kebun-pondok`, bukan mengganti scene di dashboard.
- **Pemicu pertumbuhan**: persentase kehadiran Kajian pribadi (`status = H`, `session_type = Kajian`) dalam **30 hari terakhir** (hari ini mundur 29 hari), dibagi 30. Threshold tahap sama seperti `$gardenStage` yang sudah ada di `DashboardController::index()`:
  - ≥ 85% → Tahap 4: 🍎 Berbuah
  - ≥ 60% → Tahap 3: 🌿 Rimbun
  - ≥ 30% → Tahap 2: 🌱 Tunas
  - < 30% → Tahap 1: 🌰 Benih
- **Visibilitas data**: tiap plot hanya menampilkan nama + sprite pohon sesuai tahap. **Tidak ada angka persentase atau streak** yang ditampilkan ke publik, untuk menghindari kesan mempermalukan santri yang kehadirannya rendah.
- **Visual**: sprite pixel art hasil AI image generation (gaya 16-bit retro ala Harvest Moon/Stardew Valley), ditampilkan dengan `image-rendering: pixelated` agar tetap tegas saat di-scale, bukan SVG vektor halus seperti kebun bersama yang sudah ada.
- **Audiens**: semua santri yang login (bukan admin-only) — fitur motivasi komunal, bukan alat monitoring.

## Data & Perhitungan

### Query per santri

Untuk setiap `Student` dengan `status_aktif = 'Aktif'` dan `title != 'Admin'`:

```php
$count = AttendanceLog::where('student_id', $student->id)
    ->where('session_type', 'Kajian')
    ->where('status', 'H')
    ->where('attendance_date', '>=', Carbon::today()->subDays(29)->toDateString())
    ->where('attendance_date', '<=', Carbon::today()->toDateString())
    ->count();

$percentage = ($count / 30) * 100;
```

Threshold di atas diterapkan ke `$percentage` untuk dapat `$stage` (1-4). Tidak disesuaikan dengan tanggal gabung santri (santri baru akan mulai dari tahap benih dan naik seiring waktu, sesuai keputusan "30 hari terakhir" apa adanya — tidak over-engineer dengan penyesuaian masa aktif).

Untuk menghindari N+1 query pada 35 santri, perhitungan dilakukan dengan satu query agregat (`groupBy('student_id')`) lalu di-map ke tiap santri di memori, bukan query per-santri di dalam loop.

### Controller baru

`App\Http\Controllers\KebunController::index()`:
- Ambil semua santri aktif non-admin, urutkan alfabetis nama.
- Hitung `$stage` tiap santri dengan query agregat di atas.
- Kirim `$students` (koleksi berisi nama, avatar, stage) ke view `kebun-pondok`.

### Route

```php
Route::get('/kebun-pondok', [KebunController::class, 'index'])->name('kebun.index');
```

Ditempatkan di grup middleware yang sama dengan `/dashboard` dan `/refleksi` (auth santri).

## Tampilan

### View `resources/views/kebun-pondok.blade.php`

- Layout sama dengan halaman santri lain (header, sidebar `<x-sidebar active="kebun" />`, `<main>` dengan max-width container).
- Kotak pencarian nama (client-side JS filter, karena hanya ±35 data, tidak perlu pagination server).
- Grid responsif: 2 kolom di mobile, 4-5 kolom di desktop. Tiap kartu plot:
  - Petak alas rumput/tanah (`grass-tile.png`, `image-rendering: pixelated`, `background-repeat` atau ukuran pas satu kartu).
  - Sprite pohon sesuai `$stage` santri, di-center di atas petak, `image-rendering: pixelated`.
  - Nama santri di bawah petak, font pixel ("Press Start 2P" dari Google Fonts, dimuat khusus untuk label ini) agar terasa retro; bagian lain halaman (search box, heading) tetap pakai font app yang sekarang supaya tetap mudah dibaca.
- Sidebar: tambah menu baru "Kebun Pondok" (ikon `park`/`forest`) mengarah ke route ini.

### Aset gambar baru (AI-generated, disimpan di `public/images/kebun/`)

Satu pohon yang sama digambar dalam 4 tahap pertumbuhan konsisten gaya & palet warnanya, background transparan:

- `stage-1-benih.png` — benih/tanah dengan tunas kecil mulai muncul.
- `stage-2-tunas.png` — tanaman muda dengan beberapa daun.
- `stage-3-rimbun.png` — pohon kecil berdaun lebat.
- `stage-4-berbuah.png` — pohon berbuah/berbunga, paling subur.

Plus satu tile alas:

- `grass-tile.png` — petak rumput/tanah pixel yang bisa diulang sebagai alas tiap plot.

Semua di-generate dengan kanvas kecil (native pixel-art resolution) lalu ditampilkan lebih besar di CSS dengan `image-rendering: pixelated` agar pixelnya tetap tegas (tidak blur).

## Tidak Berubah

- Dashboard kebun bersama (`dashboard.blade.php` baris 342-569) dan setting admin (`garden_status`, `garden_mode`, `garden_message`) — tidak disentuh.
- `header_kebun.blade.php` dan `header.blade.php` (dead code) — tidak disentuh, di luar scope.
- Tidak ada perubahan skema database baru (semua data yang dibutuhkan sudah ada di `attendance_logs` dan `students`).

## Testing Manual

1. Akses `/kebun-pondok` sebagai santri yang kehadiran Kajian 30 hari terakhirnya tinggi → pohonnya tampil tahap 4 (berbuah).
2. Santri yang jarang absen → tahap 1 (benih).
3. Search box memfilter grid sesuai nama yang diketik.
4. Tidak ada angka persentase/streak yang terlihat di halaman ini.
5. Halaman tetap rapi di layar mobile (grid 2 kolom) dan desktop (4-5 kolom).
6. Dashboard (`/dashboard`) tidak berubah tampilannya sama sekali setelah perubahan ini.
