<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nomor WhatsApp Musyrif Perizinan
    |--------------------------------------------------------------------------
    |
    | Setiap kategori pengajuan izin otomatis diarahkan ke nomor WhatsApp
    | musyrif yang berbeda. Ganti nilai di .env (bukan di file ini) begitu
    | nomor aslinya sudah fix. Format nomor: 62xxxxxxxxxxx (tanpa + atau 0).
    |
    | Kategori 1: Izin Pengajian
    | Kategori 2: Izin Tidak di Asrama (1 malam)
    | Kategori 3: Izin Tidak di Asrama (lebih dari 1 malam) & Cuti
    |
    */

    'musyrif_wa' => [
        1 => env('WA_MUSYRIF_PENGAJIAN', '6280000000001'),
        2 => env('WA_MUSYRIF_ASRAMA_1_MALAM', '6280000000002'),
        3 => env('WA_MUSYRIF_ASRAMA_LEBIH_1_MALAM', '6280000000003'),
    ],

];
