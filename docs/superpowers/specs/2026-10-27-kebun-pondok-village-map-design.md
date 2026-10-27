# Kebun Pondok — Village Map 2D di Home (bisa Zoom & Geser)

**Status:** Approved
**Tanggal:** 2026-10-27
**Menggantikan:** [2026-10-27-kebun-pondok-pixel-art-design.md](./2026-10-27-kebun-pondok-pixel-art-design.md)

## Latar Belakang

Spec sebelumnya membuat halaman terpisah `/kebun-pondok` (grid kartu per-santri). Setelah dicoba, user minta diubah: bukan halaman/menu terpisah, melainkan satu scene map 2D langsung di Home (dashboard), ukurannya kecil/tidak besar, tapi bisa di-zoom dan digeser (scroll/pinch + drag), benar-benar bergaya Harvest Moon: Back to Nature.

## Keputusan Desain (dikonfirmasi user)

- Halaman `/kebun-pondok`, link sidebar, `KebunController`, dan view-nya **dihapus total** — tidak ada dead code tersisa.
- Section "Kebun Kebaikan" lama di dashboard (satu pohon besar komunal, SVG kartun neobrutalis) **diganti total**, bukan ditambah di sampingnya — hanya satu konsep kebun yang tersisa di Home.
- Tetap per-santri: satu map berisi banyak petak pohon kecil (bukan cuma satu pohon komunal), ditata seperti desa kecil.
- Interaksi zoom: scroll wheel/pinch dua jari untuk zoom in-out, klik/sentuh-geser untuk pan, mirip Google Maps. Tombol +/−/reset juga disediakan sebagai alternatif tanpa mouse/pinch.
- Admin `garden_status` tetap dipakai, tapi sekarang hanya untuk warna "langit" di belakang map (atmosfer bersama); setiap pohon individual tetap dari data masing-masing santri (persentase kehadiran Kajian 30 hari terakhir, threshold sama seperti sebelumnya).
- Papan "Pesan Pengasuh & Admin" tetap dipertahankan di bawah map.

## Implementasi

### Data (`DashboardController::index()`)

Logika perhitungan tahap pohon per-santri (yang sebelumnya di `KebunController`) dipindah ke `DashboardController`, menghasilkan `$villageStudents` (koleksi Student + `garden_stage`), dikirim ke view `dashboard`.

### Tampilan (`dashboard.blade.php`)

- Section "🌱 Kebun Pondok Daaru Hiraa" menggantikan section "Kebun Kebaikan" lama di posisi yang sama.
- `#village-viewport`: kotak tetap (tinggi 260px, lebar penuh), `overflow: hidden`, warna latar dari `$skyColorHex` (mengikuti `garden_status`).
- `#village-world`: dunia virtual berukuran tetap (grid 7 kolom × N baris, tiap plot 92px), berisi satu `<div>` per santri aktif — masing-masing memuat `<x-pixel-tree>` (dipakai ulang dari iterasi sebelumnya) + label nama kecil (font pixel "Press Start 2P").
- Zoom & pan ditangani vanilla JS (`transform: translate() scale()` pada `#village-world`): wheel event untuk zoom di posisi kursor, Pointer Events untuk drag-pan satu jari dan pinch-zoom dua jari, plus tombol `+`/`−`/reset (`fitView()` menghitung ulang skala agar seluruh map pas di viewport).
- Tidak ada tooltip/klik terpisah untuk nama — nama sudah selalu tampil kecil di bawah tiap pohon (konsisten dengan keputusan "tanpa angka persentase" sebelumnya).

### Dihapus

- `app/Http/Controllers/KebunController.php`
- `resources/views/kebun-pondok.blade.php`
- Route `kebun.index` di `routes/web.php`
- Item sidebar "Kebun Pondok"
- CSS/keyframe yang sudah tidak terpakai dari scene lama (`animate-sway`, `animate-cloud-1/2`, `leaf-fall`) — `animate-spin-slow` dan `animate-drift-slow` tetap dipertahankan karena masih dipakai elemen lain di dashboard.

### Tetap dipakai

- `resources/views/components/pixel-tree.blade.php` (komponen SVG pixel-block 4 tahap pertumbuhan).

## Testing Manual

1. Home menampilkan satu map kecil berisi pohon-pohon kecil milik tiap santri aktif, bukan lagi satu pohon besar.
2. Scroll mouse di atas map memperbesar/memperkecil, berpusat di posisi kursor.
3. Klik-tahan-geser (atau sentuh-geser di HP) memindahkan tampilan map.
4. Dua jari pinch di HP memperbesar/memperkecil.
5. Tombol +/−/reset berfungsi sebagai alternatif tanpa gesture.
6. Warna langit di belakang map berubah sesuai `garden_status` yang diatur admin.
7. Papan pesan admin tetap tampil di bawah map.
8. Tidak ada link/menu "Kebun Pondok" tersisa di sidebar, dan mengakses `/kebun-pondok` langsung menghasilkan 404.
