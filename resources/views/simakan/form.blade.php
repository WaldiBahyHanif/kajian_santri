<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
    <title>Pos Simakan & Setor Hafalan - Daaru Hiraa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;800&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FEF9EF; color: #111827; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .neobrutal-card {
            border: 3px solid #000;
            box-shadow: 5px 5px 0px 0px #000;
        }
        .neobrutal-btn {
            border: 3px solid #000;
            box-shadow: 3px 3px 0px 0px #000;
            transition: all 0.12s ease;
        }
        .neobrutal-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000;
        }
    </style>
</head>
<body class="min-h-screen pb-16">
    <!-- Top Header -->
    <header class="bg-[#003527] text-white border-b-4 border-black px-4 py-4 shadow-[0_4px_0_0_#000]">
        <div class="max-w-2xl mx-auto flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-[#FFDE00] text-black border-3 border-black flex items-center justify-center font-black shadow-[2px_2px_0_0_#000]">
                    <span class="material-symbols-outlined text-2xl">menu_book</span>
                </div>
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest bg-emerald-800 text-[#86EFAC] px-2 py-0.5 rounded border border-black">Link Khusus Penyimak</span>
                    <h1 class="font-display text-lg sm:text-xl font-black tracking-tight leading-tight mt-0.5">Pos Simakan & Setor Hafalan</h1>
                </div>
            </div>
            <div class="text-right shrink-0">
                <span class="text-[11px] font-bold text-emerald-200 block">Daaru Hiraa</span>
                <span class="text-xs font-black text-[#FFDE00]">{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d M Y') }}</span>
            </div>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-4 pt-6 space-y-6">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-[#86EFAC] border-3 border-black p-4 rounded-xl shadow-[4px_4px_0_0_#000] font-black text-sm flex items-start gap-2.5">
                <span class="material-symbols-outlined text-xl shrink-0">verified</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-200 border-3 border-black p-4 rounded-xl shadow-[4px_4px_0_0_#000] text-red-950">
                <p class="font-black text-xs uppercase mb-1 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base">warning</span> Periksa Kembali Input Anda:
                </p>
                <ul class="list-disc list-inside text-xs font-bold space-y-0.5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(empty($config['is_active']))
            <div class="bg-amber-200 border-3 border-black p-6 rounded-xl neobrutal-card text-center space-y-2">
                <span class="material-symbols-outlined text-4xl text-amber-900">lock_clock</span>
                <h2 class="font-display text-lg font-black uppercase">Sesi Simakan Sedang Ditutup</h2>
                <p class="text-xs font-bold text-amber-900">Saat ini penerimaan input setoran sedang dinonaktifkan oleh Admin Pondok. Silakan hubungi pengurus jika ingin membuka sesi.</p>
            </div>
        @else
            <!-- Form Input Simakan Ustadz -->
            <form action="{{ route('simakan.store', ['code' => $code]) }}" method="POST" id="simakan-form" class="bg-white rounded-2xl p-5 sm:p-6 neobrutal-card space-y-5">
                @csrf

                <!-- Bagian 1: Identitas & Kunci Ganda Ustadz Penyimak -->
                <div class="bg-amber-50 border-3 border-black rounded-xl p-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black uppercase tracking-wider flex items-center gap-1.5 text-amber-950">
                            <span class="material-symbols-outlined text-base">shield_person</span> 1. Verifikasi Ustadz Penyimak
                        </span>
                        @if($verifiedPenyimakId)
                            <span class="text-[10px] font-black bg-[#86EFAC] text-black px-2 py-0.5 rounded border border-black">✓ Sesi Penyimak Aktif</span>
                        @endif
                    </div>

                    @if($penyimakList->isEmpty())
                        <div class="bg-yellow-200 border-2 border-black rounded-lg p-3 text-xs font-black text-black">
                            ⚠️ Belum ada data Ustadz Penyimak yang terdaftar. Silakan tambahkan nama Ustadz Penyimak terlebih dahulu di halaman Admin &rarr; Simakan & Setoran.
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                        <div class="sm:col-span-7">
                            <label class="block text-[11px] font-black uppercase mb-1">Nama Ustadz Penyimak <span class="text-red-600">*</span></label>
                            <select name="penyimak_id" required class="w-full border-3 border-black rounded-lg p-2.5 text-sm font-bold bg-white focus:outline-none focus:bg-yellow-50">
                                <option value="">-- Pilih Ustadz Penyimak --</option>
                                @foreach($penyimakList as $p)
                                    <option value="{{ $p->id }}" @selected(old('penyimak_id', $verifiedPenyimakId) == $p->id)>
                                        {{ $p->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-5">
                            <label class="block text-[11px] font-black uppercase mb-1">PIN Penyimak <span class="text-red-600">*</span></label>
                            <input type="password" name="pin" value="{{ old('pin', $verifiedPin) }}" required placeholder="Masukkan PIN..."
                                   class="w-full border-3 border-black rounded-lg p-2.5 text-sm font-black tracking-widest bg-white focus:outline-none focus:bg-yellow-50"/>
                        </div>
                    </div>

                    <div class="pt-1">
                        <label class="block text-[11px] font-black uppercase mb-1">Tanggal Simakan</label>
                        <input type="date" name="tanggal_setor" value="{{ old('tanggal_setor', $selectedDate) }}" max="{{ $today }}" required
                               class="w-full sm:w-auto border-2 border-black rounded-lg px-3 py-1.5 text-xs font-bold bg-white"/>
                    </div>
                </div>

                <!-- Bagian 2: Pilih Santri -->
                <div>
                    <label class="block text-xs font-black uppercase mb-1.5 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-[#003527]">person_check</span> 2. Pilih Santri yang Menyetor <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="student-filter-input" placeholder="🔍 Ketik nama santri untuk memfilter cepat..."
                           class="w-full border-2 border-black rounded-t-lg px-3 py-2 text-xs font-bold bg-gray-50 focus:outline-none focus:bg-yellow-50 border-b-0"/>
                    <select name="student_id" id="student-select" required size="4"
                            class="w-full border-3 border-black rounded-b-lg p-2 text-sm font-bold bg-white focus:outline-none">
                        @foreach($students as $st)
                            <option value="{{ $st->id }}" data-name="{{ strtolower($st->name) }}" @selected(old('student_id') == $st->id) class="py-1.5 px-2 rounded cursor-pointer hover:bg-emerald-100">
                                {{ $st->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Bagian 3: Pilih Kategori Simakan -->
                @php
                    $defaultJenis = old('jenis', !empty($config['enable_ziyadah']) ? 'ziyadah' : (!empty($config['enable_murojaah']) ? 'murojaah' : 'tilawah'));
                    $minZiyadah = (int) ($config['min_baris_ziyadah'] ?? 2);
                    $minMurojaah = (int) ($config['min_baris_murojaah'] ?? 6);
                    $minTilawah = (int) ($config['min_baris_tilawah'] ?? 5);
                    $barisPerHal = (int) ($config['baris_per_halaman'] ?? 15);
                @endphp
                <div>
                    <label class="block text-xs font-black uppercase mb-2 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-[#003527]">category</span> 3. Kategori Setoran <span class="text-red-600">*</span>
                    </label>
                    <input type="hidden" name="jenis" id="jenis-input" value="{{ $defaultJenis }}">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                        @if(!empty($config['enable_ziyadah']))
                            <button type="button" data-jenis="ziyadah" data-min="{{ $minZiyadah }}" onclick="selectJenis('ziyadah', {{ $minZiyadah }})"
                                    class="jenis-tab neobrutal-btn p-3 rounded-xl text-left flex flex-col justify-between cursor-pointer">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg">🌱</span>
                                    <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded border border-black bg-white text-black">Min {{ $minZiyadah }} Baris</span>
                                </div>
                                <div class="mt-2">
                                    <p class="font-display font-black text-sm leading-tight">Setor Hafalan Baru</p>
                                    <p class="text-[10px] font-bold opacity-80">Ziyadah (Tambah Hafalan)</p>
                                </div>
                            </button>
                        @endif

                        @if(!empty($config['enable_murojaah']))
                            <button type="button" data-jenis="murojaah" data-min="{{ $minMurojaah }}" onclick="selectJenis('murojaah', {{ $minMurojaah }})"
                                    class="jenis-tab neobrutal-btn p-3 rounded-xl text-left flex flex-col justify-between cursor-pointer">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg">🔄</span>
                                    <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded border border-black bg-white text-black">Min {{ $minMurojaah }} Baris</span>
                                </div>
                                <div class="mt-2">
                                    <p class="font-display font-black text-sm leading-tight">Muroja'ah</p>
                                    <p class="text-[10px] font-bold opacity-80">Ulang & Jaga Hafalan Lama</p>
                                </div>
                            </button>
                        @endif

                        @if(!empty($config['enable_tilawah']))
                            <button type="button" data-jenis="tilawah" data-min="{{ $minTilawah }}" onclick="selectJenis('tilawah', {{ $minTilawah }})"
                                    class="jenis-tab neobrutal-btn p-3 rounded-xl text-left flex flex-col justify-between cursor-pointer">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg">📖</span>
                                    <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded border border-black bg-white text-black">Min {{ $minTilawah }} Baris</span>
                                </div>
                                <div class="mt-2">
                                    <p class="font-display font-black text-sm leading-tight">Tilawah / Tahsin</p>
                                    <p class="text-[10px] font-bold opacity-80">Bacaan Bin-Nazhar</p>
                                </div>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Bagian 4: Detail Surah, Ayat & Jumlah Baris -->
                <div class="bg-emerald-50/70 border-3 border-black rounded-xl p-4 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                        <div class="sm:col-span-6">
                            <label class="block text-[11px] font-black uppercase mb-1">Surah Al-Qur'an <span class="text-red-600">*</span></label>
                            <select name="surah" required class="w-full border-3 border-black rounded-lg p-2.5 text-sm font-bold bg-white focus:outline-none focus:bg-yellow-50">
                                <option value="">-- Pilih Surah --</option>
                                @foreach($surahList as $num => $sName)
                                    <option value="{{ $sName }}" @selected(old('surah') === $sName)>
                                        {{ $num }}. {{ $sName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-[11px] font-black uppercase mb-1">Ayat Awal</label>
                            <input type="number" name="ayat_awal" value="{{ old('ayat_awal') }}" min="1" max="286" placeholder="Contoh: 1"
                                   class="w-full border-3 border-black rounded-lg p-2.5 text-sm font-bold bg-white focus:outline-none focus:bg-yellow-50"/>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-[11px] font-black uppercase mb-1">Ayat Akhir</label>
                            <input type="number" name="ayat_akhir" value="{{ old('ayat_akhir') }}" min="1" max="286" placeholder="Contoh: 10"
                                   class="w-full border-3 border-black rounded-lg p-2.5 text-sm font-bold bg-white focus:outline-none focus:bg-yellow-50"/>
                        </div>
                    </div>

                    <!-- Input Baris dengan Validasi Otomatis -->
                    <div class="border-t-2 border-black/20 pt-3">
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-black uppercase flex items-center gap-1.5">
                                📏 Jumlah Baris yang Disetor <span class="text-red-600">*</span>
                            </label>
                            <span id="min-baris-badge" class="text-[11px] font-black bg-[#FFDE00] text-black px-2.5 py-0.5 rounded border-2 border-black">
                                Wajib Minimal {{ $minZiyadah }} Baris
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center gap-2">
                            <div class="flex items-center border-3 border-black rounded-xl overflow-hidden bg-white shadow-[2px_2px_0_0_#000]">
                                <button type="button" onclick="adjustBaris(-1)" class="w-11 h-11 bg-gray-100 hover:bg-gray-200 font-black text-lg border-r-2 border-black cursor-pointer">−</button>
                                <input type="number" name="jumlah_baris" id="jumlah-baris-input" value="{{ old('jumlah_baris', $minZiyadah) }}" min="1" max="600" required
                                       oninput="validateBaris()"
                                       class="w-20 text-center font-display font-black text-lg py-1.5 focus:outline-none"/>
                                <button type="button" onclick="adjustBaris(1)" class="w-11 h-11 bg-gray-100 hover:bg-gray-200 font-black text-lg border-l-2 border-black cursor-pointer">+</button>
                            </div>

                            <!-- Tombol Cepat Jumlah Baris -->
                            <div class="flex flex-wrap gap-1.5">
                                <button type="button" onclick="setBaris({{ $minZiyadah }})" class="px-2.5 py-1.5 text-xs font-black bg-white hover:bg-yellow-100 border-2 border-black rounded-lg shadow-[2px_2px_0_0_#000] cursor-pointer">
                                    {{ $minZiyadah }} Brs (Min Baru)
                                </button>
                                <button type="button" onclick="setBaris({{ $minMurojaah }})" class="px-2.5 py-1.5 text-xs font-black bg-white hover:bg-yellow-100 border-2 border-black rounded-lg shadow-[2px_2px_0_0_#000] cursor-pointer">
                                    {{ $minMurojaah }} Brs (Min Muroja'ah)
                                </button>
                                <button type="button" onclick="setBaris({{ (int) ceil($barisPerHal / 2) }})" class="px-2.5 py-1.5 text-xs font-black bg-white hover:bg-yellow-100 border-2 border-black rounded-lg shadow-[2px_2px_0_0_#000] cursor-pointer">
                                    ½ Hal ({{ (int) ceil($barisPerHal / 2) }} Brs)
                                </button>
                                <button type="button" onclick="setBaris({{ $barisPerHal }})" class="px-2.5 py-1.5 text-xs font-black bg-white hover:bg-yellow-100 border-2 border-black rounded-lg shadow-[2px_2px_0_0_#000] cursor-pointer">
                                    1 Hal ({{ $barisPerHal }} Brs)
                                </button>
                            </div>
                        </div>

                        <!-- Peringatan Real-time jika baris kurang dari batas minimal -->
                        <div id="baris-warning" class="hidden mt-2 bg-red-100 border-2 border-red-800 text-red-900 px-3 py-2 rounded-lg text-xs font-black flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base">error</span>
                            <span id="baris-warning-text">Jumlah baris belum memenuhi syarat minimal!</span>
                        </div>
                        <p id="baris-konversi" class="text-[11px] font-bold text-emerald-900 mt-1.5"></p>
                    </div>
                </div>

                <!-- Bagian 5: Predikat & Catatan Teguran -->
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                    <div class="sm:col-span-6">
                        <label class="block text-xs font-black uppercase mb-1.5">4. Predikat Kelancaran <span class="text-red-600">*</span></label>
                        <select name="predikat" required class="w-full border-3 border-black rounded-xl p-3 text-sm font-black bg-white focus:outline-none focus:bg-yellow-50">
                            @foreach($predikatList as $key => $label)
                                <option value="{{ $key }}" @selected(old('predikat', 'Mumtaz') === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-6">
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-black uppercase">5. Catatan / Teguran</label>
                            <div class="flex gap-1">
                                <button type="button" onclick="appendNote('Perbaiki Tajwid/Makhraj')" class="text-[10px] font-black bg-amber-200 px-2 py-0.5 rounded border border-black cursor-pointer hover:bg-amber-300">+Tajwid</button>
                                <button type="button" onclick="appendNote('Ayat Kurang Lancar')" class="text-[10px] font-black bg-orange-200 px-2 py-0.5 rounded border border-black cursor-pointer hover:bg-orange-300">+Kelancaran</button>
                            </div>
                        </div>
                        <input type="text" name="catatan" id="catatan-input" value="{{ old('catatan') }}" placeholder="Opsional: catatan ayat/tajwid..."
                               class="w-full border-3 border-black rounded-xl p-2.5 text-sm font-bold bg-white focus:outline-none focus:bg-yellow-50"/>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-simakan-btn"
                        class="w-full bg-[#39FF14] hover:bg-[#2be00b] text-black font-display font-black text-base uppercase py-3.5 px-6 rounded-xl neobrutal-btn flex items-center justify-center gap-2 cursor-pointer">
                    <span class="material-symbols-outlined text-xl">task_alt</span>
                    <span>Sahkan & Simpan Setoran Santri</span>
                </button>
            </form>
        @endif

        <!-- Daftar Setoran yang Masuk Hari Ini -->
        <section class="bg-white rounded-2xl p-5 sm:p-6 neobrutal-card space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b-2 border-black pb-3">
                <div>
                    <h2 class="font-display text-base font-black uppercase flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-700">history_edu</span>
                        Daftar Setoran Masuk ({{ $todaySetorans->count() }})
                    </h2>
                    <p class="text-xs font-bold text-gray-500">Rekap santri yang sudah disimak pada tanggal {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}</p>
                </div>
                <form method="GET" action="{{ route('simakan.show', ['code' => $code]) }}" class="flex items-center gap-1.5">
                    <input type="date" name="date" value="{{ $selectedDate }}" max="{{ $today }}" onchange="this.form.submit()"
                           class="border-2 border-black rounded-lg px-2.5 py-1 text-xs font-bold bg-yellow-50"/>
                </form>
            </div>

            @if($todaySetorans->isEmpty())
                <div class="text-center py-8 text-gray-500 font-bold text-xs">
                    Belum ada setoran hafalan yang tercatat pada tanggal ini.
                </div>
            @else
                <div class="space-y-2.5">
                    @foreach($todaySetorans as $item)
                        @php
                            $badgeBg = match($item->jenis) {
                                'ziyadah' => 'bg-emerald-200 text-emerald-950',
                                'murojaah' => 'bg-amber-200 text-amber-950',
                                'tilawah' => 'bg-sky-200 text-sky-950',
                                default => 'bg-gray-200 text-black',
                            };
                        @endphp
                        <div class="border-2 border-black rounded-xl p-3 bg-[#FFFDF9] flex items-center justify-between gap-3 shadow-[2px_2px_0_0_#000]">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="font-display font-black text-sm">{{ $item->student->name ?? 'Santri' }}</span>
                                    <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded border border-black {{ $badgeBg }}">
                                        {{ $item->jenis_label }}
                                    </span>
                                    <span class="text-[10px] font-black bg-[#FFDE00] px-2 py-0.5 rounded border border-black">
                                        {{ $item->jumlah_baris }} Baris
                                    </span>
                                </div>
                                <p class="text-xs font-bold text-gray-700 mt-1">
                                    QS. {{ $item->surah }}
                                    @if($item->ayat_awal)
                                        : {{ $item->ayat_awal }}{{ $item->ayat_akhir ? '–' . $item->ayat_akhir : '' }}
                                    @endif
                                    · <span class="text-emerald-800 font-black">{{ $item->predikat }}</span>
                                    · <span class="text-gray-500">Disimak Ust. {{ $item->penyimak_nama }}</span>
                                </p>
                                @if($item->catatan)
                                    <p class="text-[11px] font-semibold text-amber-900 mt-0.5 italic">"{{ $item->catatan }}"</p>
                                @endif
                            </div>

                            @if($verifiedPin)
                                <form action="{{ route('simakan.destroy', ['code' => $code, 'id' => $item->id]) }}" method="POST"
                                      onsubmit="return confirm('Hapus catatan setoran {{ $item->student->name ?? '' }} ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="pin" value="{{ $verifiedPin }}">
                                    <button type="submit" title="Hapus" class="w-8 h-8 rounded-lg bg-red-100 hover:bg-red-300 border-2 border-black flex items-center justify-center text-red-900 cursor-pointer shrink-0">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </main>

    <script>
        var currentMinBaris = {{ $minZiyadah }};
        var barisPerHalaman = {{ max(1, $barisPerHal) }};
        var currentJenis = '{{ $defaultJenis }}';

        function selectJenis(jenis, minBaris) {
            currentJenis = jenis;
            currentMinBaris = parseInt(minBaris, 10) || 1;
            var jenisInput = document.getElementById('jenis-input');
            if (jenisInput) jenisInput.value = jenis;

            document.querySelectorAll('.jenis-tab').forEach(function (btn) {
                if (btn.getAttribute('data-jenis') === jenis) {
                    btn.classList.add('bg-[#86EFAC]', 'ring-2', 'ring-black');
                    btn.classList.remove('bg-white');
                } else {
                    btn.classList.remove('bg-[#86EFAC]', 'ring-2', 'ring-black');
                    btn.classList.add('bg-white');
                }
            });

            var badge = document.getElementById('min-baris-badge');
            var labelJenis = jenis === 'ziyadah' ? 'Hafalan Baru' : (jenis === 'murojaah' ? "Muroja'ah" : 'Tilawah');
            if (badge) {
                badge.textContent = 'Wajib Minimal ' + currentMinBaris + ' Baris (' + labelJenis + ')';
            }

            var barisInput = document.getElementById('jumlah-baris-input');
            if (barisInput && parseInt(barisInput.value || '0', 10) < currentMinBaris) {
                barisInput.value = currentMinBaris;
            }
            validateBaris();
        }

        function setBaris(val) {
            var input = document.getElementById('jumlah-baris-input');
            if (input) {
                input.value = val;
                validateBaris();
            }
        }

        function adjustBaris(delta) {
            var input = document.getElementById('jumlah-baris-input');
            if (!input) return;
            var next = (parseInt(input.value || '0', 10) + delta);
            if (next < 1) next = 1;
            input.value = next;
            validateBaris();
        }

        function validateBaris() {
            var input = document.getElementById('jumlah-baris-input');
            var warningBox = document.getElementById('baris-warning');
            var warningText = document.getElementById('baris-warning-text');
            var submitBtn = document.getElementById('submit-simakan-btn');
            var konversiEl = document.getElementById('baris-konversi');
            if (!input) return;

            var val = parseInt(input.value || '0', 10);
            var hal = (val / barisPerHalaman).toFixed(1);
            if (konversiEl) {
                konversiEl.textContent = 'Setara ± ' + hal + ' halaman Mushaf Pojok (' + barisPerHalaman + ' baris/halaman).';
            }

            if (val < currentMinBaris) {
                if (warningBox) warningBox.classList.remove('hidden');
                if (warningText) {
                    var namaKategori = currentJenis === 'ziyadah' ? 'Setor Hafalan Baru (Ziyadah)' : (currentJenis === 'murojaah' ? "Muroja'ah" : 'Tilawah');
                    warningText.textContent = namaKategori + ' wajib minimal ' + currentMinBaris + ' baris! (Input saat ini: ' + (val || 0) + ' baris)';
                }
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            } else {
                if (warningBox) warningBox.classList.add('hidden');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
        }

        function appendNote(text) {
            var input = document.getElementById('catatan-input');
            if (!input) return;
            if (input.value.trim() === '') {
                input.value = text;
            } else if (!input.value.includes(text)) {
                input.value = input.value.trim() + ', ' + text;
            }
        }

        // Filter cepat nama santri
        var filterInput = document.getElementById('student-filter-input');
        var studentSelect = document.getElementById('student-select');
        if (filterInput && studentSelect) {
            filterInput.addEventListener('input', function () {
                var q = this.value.toLowerCase().trim();
                Array.from(studentSelect.options).forEach(function (opt) {
                    var name = opt.getAttribute('data-name') || '';
                    opt.style.display = name.includes(q) ? '' : 'none';
                });
            });
        }

        // Inisialisasi tab awal
        document.addEventListener('DOMContentLoaded', function () {
            var activeBtn = document.querySelector('.jenis-tab[data-jenis="' + currentJenis + '"]');
            var initMin = activeBtn ? parseInt(activeBtn.getAttribute('data-min'), 10) : currentMinBaris;
            selectJenis(currentJenis, initMin);
        });
    </script>
</body>
</html>

