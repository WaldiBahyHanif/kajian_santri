@props(['stage' => 1])
@php
$px = 8; // ukuran satu "pixel" dalam unit SVG
$soilDark = '#78350F';
$soilLight = '#92400E';
$trunk = '#5C2C06';
$leafDark = '#15803D';
$leafMid = '#22C55E';
$leafLight = '#4ADE80';
$leafHi = '#86EFAC';
$red = '#EF4444';
$yellow = '#FACC15';

// setiap rect: [kolom, baris, lebar(kolom), tinggi(baris), warna]
$rects = [];

// Tanah/gundukan (sama untuk semua tahap)
$rects[] = [0, 12, 12, 2, $soilDark];
$rects[] = [3, 11, 6, 1, $soilLight];

if ($stage == 1) {
    // Benih
    $rects[] = [5, 10, 2, 1, $yellow];
} elseif ($stage == 2) {
    // Tunas
    $rects[] = [5, 8, 1, 3, $leafDark];
    $rects[] = [3, 8, 2, 1, $leafLight];
    $rects[] = [6, 8, 2, 1, $leafMid];
    $rects[] = [5, 7, 1, 1, $leafHi];
} elseif ($stage == 3) {
    // Rimbun
    $rects[] = [5, 6, 2, 5, $trunk];
    $rects[] = [5, 1, 2, 1, $leafMid];
    $rects[] = [4, 2, 4, 1, $leafMid];
    $rects[] = [3, 3, 1, 1, $leafDark];
    $rects[] = [4, 3, 4, 1, $leafMid];
    $rects[] = [8, 3, 1, 1, $leafDark];
    $rects[] = [2, 4, 1, 1, $leafDark];
    $rects[] = [3, 4, 6, 1, $leafMid];
    $rects[] = [9, 4, 1, 1, $leafDark];
    $rects[] = [3, 5, 1, 1, $leafDark];
    $rects[] = [4, 5, 4, 1, $leafMid];
    $rects[] = [8, 5, 1, 1, $leafDark];
    $rects[] = [4, 6, 4, 1, $leafMid];
} else {
    // Berbuah
    $rects[] = [5, 5, 2, 6, $trunk];
    $rects[] = [5, 0, 2, 1, $leafMid];
    $rects[] = [4, 1, 4, 1, $leafMid];
    $rects[] = [3, 2, 1, 1, $leafDark];
    $rects[] = [4, 2, 4, 1, $leafMid];
    $rects[] = [8, 2, 1, 1, $leafDark];
    $rects[] = [2, 3, 1, 1, $leafDark];
    $rects[] = [3, 3, 6, 1, $leafMid];
    $rects[] = [9, 3, 1, 1, $leafDark];
    $rects[] = [1, 4, 1, 1, $leafDark];
    $rects[] = [2, 4, 8, 1, $leafMid];
    $rects[] = [10, 4, 1, 1, $leafDark];
    $rects[] = [2, 5, 1, 1, $leafDark];
    $rects[] = [3, 5, 6, 1, $leafMid];
    $rects[] = [9, 5, 1, 1, $leafDark];
    $rects[] = [4, 6, 4, 1, $leafMid];
    // buah-buahan
    $rects[] = [5, 1, 1, 1, $red];
    $rects[] = [7, 2, 1, 1, $yellow];
    $rects[] = [4, 3, 1, 1, $red];
    $rects[] = [8, 3, 1, 1, $yellow];
    $rects[] = [3, 4, 1, 1, $yellow];
    $rects[] = [9, 4, 1, 1, $red];
}
@endphp
<svg viewBox="0 0 96 112" shape-rendering="crispEdges" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    @foreach($rects as [$x, $y, $w, $h, $color])
        <rect x="{{ $x * $px }}" y="{{ $y * $px }}" width="{{ $w * $px }}" height="{{ $h * $px }}" fill="{{ $color }}" />
    @endforeach
</svg>
