@props(['stage' => 1, 'variant' => 0])
@php
$px = 4; // 24x24 grid -> 96x96 viewBox, crisp 16-bit Harvest Moon pixel art

// Palet Tanah Cangkulan (Harvest Moon Tilled Soil)
$soilBorder  = '#3B1D0A';
$soilDark    = '#592D13';
$soilMid     = '#753E1B';
$soilLight   = '#8F4E24';
$soilWet     = '#47230E';

// Palet Batang Kayu
$trunkDark   = '#3E1E04';
$trunkMid    = '#5C2E09';
$trunkLight  = '#7C4215';

// Palet Dedaunan 16-bit
$leafOutline = '#0F391E';
$leafShadow  = '#14532D';
$leafDark    = '#166534';
$leafMid     = '#16A34A';
$leafLight   = '#22C55E';
$leafHi      = '#4ADE80';
$leafSpec    = '#BBF7D0';

// Palet Buah berdasarkan varian (0: Apel Merah, 1: Jeruk Oranye, 2: Anggur/Berry, 3: Mangga/Persik Emas)
$fruitPalettes = [
    0 => ['main' => '#DC2626', 'dark' => '#991B1B', 'hi' => '#FCA5A5'], // Apel
    1 => ['main' => '#EA580C', 'dark' => '#9A3412', 'hi' => '#FDBA74'], // Jeruk
    2 => ['main' => '#9333EA', 'dark' => '#581C87', 'hi' => '#E9D5FF'], // Anggur
    3 => ['main' => '#EAB308', 'dark' => '#A16207', 'hi' => '#FEF08A'], // Emas/Persik
];
$fp = $fruitPalettes[((int) $variant) % 4];

$rects = [];

// --- PETAK TANAH CANGKULAN 3x3 (y: 12..22, x: 2..21) ---
// Outline luar petak tanah
$rects[] = [3, 12, 18, 1, $soilBorder];
$rects[] = [2, 13, 20, 9, $soilBorder];
$rects[] = [3, 22, 18, 1, $soilBorder];

// Isi tanah dasar
$rects[] = [3, 13, 18, 9, $soilMid];

// Alur bajak (furrows) 3x3 khas Harvest Moon
for ($row = 0; $row < 3; $row++) {
    $ry = 13 + ($row * 3);
    $rects[] = [3, $ry, 18, 1, $soilLight];
    $rects[] = [3, $ry + 2, 18, 1, $soilDark];
}
// Garis pemisah kolom 3x3
$rects[] = [9, 13, 1, 9, $soilDark];
$rects[] = [14, 13, 1, 9, $soilDark];

if ($stage == 1) {
    // STAGE 1: Petak Tanah Basah + Benih Tersebar di 9 Titik (3x3)
    $seedPositions = [
        [5, 14], [11, 14], [17, 14],
        [5, 17], [11, 17], [17, 17],
        [5, 20], [11, 20], [17, 20],
    ];
    foreach ($seedPositions as [$sx, $sy]) {
        $rects[] = [$sx - 1, $sy, 3, 2, $soilWet];
        $rects[] = [$sx, $sy, 1, 1, '#FACC15'];
        $rects[] = [$sx + 1, $sy + 1, 1, 1, '#EAB308'];
    }
} elseif ($stage == 2) {
    // STAGE 2: 9 Tunas Tanaman Muda Berjejer 3x3 di Petak Sawah
    $sproutPositions = [
        [5, 13], [11, 13], [17, 13],
        [5, 16], [11, 16], [17, 16],
        [5, 19], [11, 19], [17, 19],
    ];
    foreach ($sproutPositions as [$sx, $sy]) {
        // Tanah basah di bawah tunas
        $rects[] = [$sx - 1, $sy + 1, 4, 2, $soilWet];
        // Batang tunas
        $rects[] = [$sx, $sy, 1, 2, $leafDark];
        // Daun kiri & kanan
        $rects[] = [$sx - 1, $sy - 1, 2, 1, $leafMid];
        $rects[] = [$sx + 1, $sy - 1, 2, 1, $leafLight];
        $rects[] = [$sx - 1, $sy - 1, 1, 1, $leafHi];
    }
} elseif ($stage == 3) {
    // STAGE 3: Pohon Rimbun Berbunga (Siap Berbuah)
    // Bayangan pohon di tanah
    $rects[] = [6, 16, 12, 4, $soilWet];
    $rects[] = [7, 15, 10, 6, $soilWet];

    // Akar & Batang Pohon
    $rects[] = [9, 18, 6, 1, $trunkDark];
    $rects[] = [10, 11, 4, 8, $trunkDark];
    $rects[] = [11, 11, 2, 7, $trunkMid];
    $rects[] = [11, 12, 1, 5, $trunkLight];

    // Mahkota Daun Rimbun Berlapis (Pixel Art Canopy)
    $rects[] = [7, 2, 10, 1, $leafOutline];
    $rects[] = [5, 3, 14, 1, $leafOutline];
    $rects[] = [4, 4, 16, 2, $leafOutline];
    $rects[] = [3, 6, 18, 4, $leafOutline];
    $rects[] = [4, 10, 16, 2, $leafOutline];
    $rects[] = [6, 12, 12, 1, $leafOutline];

    // Isi daun gelap (bawah)
    $rects[] = [5, 9, 14, 3, $leafShadow];
    $rects[] = [4, 7, 16, 3, $leafDark];

    // Isi daun tengah
    $rects[] = [5, 4, 14, 5, $leafMid];
    $rects[] = [7, 3, 10, 2, $leafMid];

    // Highlight pucuk daun terkena cahaya matahari
    $rects[] = [7, 3, 8, 2, $leafLight];
    $rects[] = [6, 5, 11, 3, $leafLight];
    $rects[] = [8, 3, 5, 1, $leafHi];
    $rects[] = [6, 5, 4, 2, $leafHi];
    $rects[] = [13, 5, 3, 2, $leafHi];
    $rects[] = [9, 4, 2, 1, $leafSpec];

    // Bunga-bunga putih/pink mekar
    $blossoms = [[6, 7], [15, 6], [10, 8], [8, 5], [14, 9]];
    foreach ($blossoms as [$bx, $by]) {
        $rects[] = [$bx, $by, 2, 2, '#FDF2F8'];
        $rects[] = [$bx, $by, 1, 1, '#F472B6'];
    }
} else {
    // STAGE 4: Pohon Buah Lebat (Panen Raya Harvest Moon) + Keranjang Buah
    // Bayangan pohon di tanah
    $rects[] = [5, 16, 14, 4, $soilWet];
    $rects[] = [6, 15, 12, 6, $soilWet];

    // Akar & Batang Pohon Kokoh
    $rects[] = [8, 19, 8, 1, $trunkDark];
    $rects[] = [9, 11, 6, 8, $trunkDark];
    $rects[] = [10, 11, 4, 8, $trunkMid];
    $rects[] = [10, 12, 2, 6, $trunkLight];

    // Mahkota Daun Raksasa
    $rects[] = [6, 1, 12, 1, $leafOutline];
    $rects[] = [4, 2, 16, 2, $leafOutline];
    $rects[] = [3, 4, 18, 2, $leafOutline];
    $rects[] = [2, 6, 20, 5, $leafOutline];
    $rects[] = [4, 11, 16, 2, $leafOutline];

    // Gradasi dedaunan
    $rects[] = [4, 9, 16, 3, $leafShadow];
    $rects[] = [3, 6, 18, 4, $leafDark];
    $rects[] = [4, 3, 16, 5, $leafMid];
    $rects[] = [6, 2, 12, 2, $leafMid];

    // Highlight dedaunan atas
    $rects[] = [6, 2, 10, 2, $leafLight];
    $rects[] = [5, 4, 13, 3, $leafLight];
    $rects[] = [7, 2, 6, 1, $leafHi];
    $rects[] = [5, 4, 5, 2, $leafHi];
    $rects[] = [13, 4, 4, 2, $leafHi];
    $rects[] = [8, 3, 3, 1, $leafSpec];

    // Buah-buahan Piksel (6 Buah Ranum Berkilau)
    $fruits = [
        [5, 5], [10, 3], [16, 5],
        [4, 8], [11, 7], [17, 8],
    ];
    foreach ($fruits as [$fx, $fy]) {
        $rects[] = [$fx, $fy, 2, 2, $fp['main']];
        $rects[] = [$fx + 1, $fy + 1, 1, 1, $fp['dark']];
        $rects[] = [$fx, $fy, 1, 1, $fp['hi']];
    }

    // Keranjang Kayu Panen di Kaki Pohon (x: 15..20, y: 17..21)
    $rects[] = [15, 17, 5, 4, '#451A03'];
    $rects[] = [16, 18, 3, 2, '#B45309'];
    $rects[] = [16, 17, 3, 1, $fp['main']];
    $rects[] = [17, 17, 1, 1, $fp['hi']];
}
@endphp
<svg viewBox="0 0 96 96" shape-rendering="crispEdges" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    @foreach($rects as [$x, $y, $w, $h, $color])
        <rect x="{{ $x * $px }}" y="{{ $y * $px }}" width="{{ $w * $px }}" height="{{ $h * $px }}" fill="{{ $color }}" />
    @endforeach
</svg>
