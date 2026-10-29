<x-admin-layout title="Simakan & Setor Hafalan" active="simakan">

    <!-- Ringkasan Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-[#86EFAC] border-4 border-black p-4 rounded-xl shadow-[4px_4px_0_0_#000]">
            <p class="text-[11px] font-black uppercase text-black/70">Setoran Masuk Hari Ini</p>
            <p class="text-3xl font-black text-black mt-1">{{ $todayCount }} <span class="text-sm font-bold">Setoran</span></p>
        </div>
        <div class="bg-purple-200 border-4 border-black p-4 rounded-xl shadow-[4px_4px_0_0_#000]">
            <p class="text-[11px] font-black uppercase text-black/70">Ustadz Penyimak Terdaftar</p>
            <p class="text-3xl font-black text-black mt-1">{{ $penyimakList->count() }} <span class="text-sm font-bold">Penyimak</span></p>
        </div>
        <div class="bg-[#FFDE00] border-4 border-black p-4 rounded-xl shadow-[4px_4px_0_0_#000]">
            <p class="text-[11px] font-black uppercase text-black/70">Total Baris Ziyadah</p>
            <p class="text-3xl font-black text-black mt-1">
                {{ number_format($totalZiyadahBaris) }}
                <span class="text-xs font-bold">Brs (±{{ round($totalZiyadahBaris / max(1, $config['baris_per_halaman'] ?? 15), 1) }} Hal)</span>
            </p>
        </div>
        <div class="bg-cyan-200 border-4 border-black p-4 rounded-xl shadow-[4px_4px_0_0_#000]">
            <p class="text-[11px] font-black uppercase text-black/70">Total Baris Muroja'ah</p>
            <p class="text-3xl font-black text-black mt-1">
                {{ number_format($totalMurojaahBaris) }}
                <span class="text-xs font-bold">Brs (±{{ round($totalMurojaahBaris / max(1, $config['baris_per_halaman'] ?? 15), 1) }} Hal)</span>
            </p>
        </div>
    </div>

    <!-- Bagian 1: Kelola Daftar Ustadz Penyimak Setoran (Terpisah dari Ustadz Pengajar Kajian) -->
    <div class="bg-white p-6 rounded-xl border-4 border-black shadow-[4px_4px_0_0_#000] mb-6" x-data="{ editPenyimakOpen: false, editData: {} }">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-4 border-b-2 border-black pb-3">
            <div>
                <h3 class="font-black text-lg uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-purple-700">record_voice_over</span>
                    Kelola Ustadz / Musyrif Penyimak Setoran
                </h3>
                <p class="text-xs font-bold text-gray-500">
                    Daftar khusus Ustadz/Musyrif yang bertugas menyimak hafalan santri (terpisah dari daftar Ustadz pengajar kajian).
                </p>
            </div>
            <span class="text-xs font-black bg-purple-100 border-2 border-black px-3 py-1 rounded-lg self-start md:self-center">
                Total: {{ $penyimakList->count() }} Penyimak
            </span>
        </div>

        <!-- Form Tambah Ustadz Penyimak Baru -->
        <form action="{{ route('admin.simakan.penyimak.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3 mb-5 bg-purple-50 p-4 rounded-xl border-3 border-black">
            @csrf
            <div class="sm:col-span-5">
                <label class="block text-[11px] font-black uppercase mb-1">Nama Ustadz / Musyrif Penyimak <span class="text-red-600">*</span></label>
                <input type="text" name="name" required placeholder="Contoh: Ust. Ahmad Fauzi / Musyrif Zaid"
                       class="w-full border-3 border-black p-2.5 rounded-lg font-bold text-sm bg-white focus:outline-none focus:bg-yellow-50"/>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-[11px] font-black uppercase mb-1">PIN Khusus Penyimak (Opsional)</label>
                <input type="text" name="pin" placeholder="Kosongkan jika pakai PIN Global ({{ $config['global_pin'] ?? '1234' }})"
                       class="w-full border-3 border-black p-2.5 rounded-lg font-bold text-sm bg-white focus:outline-none focus:bg-yellow-50"/>
            </div>
            <div class="sm:col-span-3 flex items-end">
                <button type="submit" class="w-full bg-[#39FF14] hover:bg-green-400 text-black font-black py-2.5 px-4 rounded-lg border-3 border-black shadow-[3px_3px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all text-xs uppercase flex items-center justify-center gap-1.5 cursor-pointer">
                    <span class="material-symbols-outlined text-base">person_add</span> Tambah Penyimak
                </button>
            </div>
        </form>

        <!-- Daftar Ustadz Penyimak -->
        @if($penyimakList->isEmpty())
            <div class="text-center py-6 bg-yellow-50 border-2 border-dashed border-black rounded-xl text-xs font-bold text-gray-600">
                Belum ada Ustadz Penyimak yang ditambahkan. Silakan tambahkan nama Ustadz Penyimak melalui form di atas agar muncul di halaman Link Simakan.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($penyimakList as $p)
                    <div class="border-3 border-black rounded-xl p-3.5 bg-[#FFFDF9] shadow-[3px_3px_0_0_#000] flex items-center justify-between gap-2 {{ !$p->is_active ? 'opacity-60 bg-gray-100' : '' }}">
                        <div class="min-w-0">
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <p class="font-black text-sm text-black truncate">{{ $p->name }}</p>
                                @if(!$p->is_active)
                                    <span class="text-[9px] font-black uppercase bg-red-200 px-1.5 py-0.5 rounded border border-black">Nonaktif</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2 mt-1 text-[11px] font-bold text-gray-600">
                                <span class="bg-yellow-200 text-black px-1.5 py-0.5 rounded border border-black font-black">
                                    PIN: {{ $p->pin ?: 'Global (' . ($config['global_pin'] ?? '1234') . ')' }}
                                </span>
                                <span>• {{ $p->setorans_count }}x menyimak</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-1.5 shrink-0">
                            <button type="button"
                                    @click="editData = { id: {{ $p->id }}, name: '{{ addslashes($p->name) }}', pin: '{{ addslashes($p->pin ?? '') }}', is_active: {{ $p->is_active ? 1 : 0 }} }; editPenyimakOpen = true"
                                    class="bg-cyan-300 hover:bg-cyan-400 text-black px-2.5 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] cursor-pointer">
                                Edit
                            </button>
                            <form action="{{ route('admin.simakan.penyimak.destroy', $p->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus Ustadz Penyimak {{ addslashes($p->name) }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-300 hover:bg-red-400 text-black px-2 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] cursor-pointer">
                                    ✕
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Modal Edit Ustadz Penyimak -->
        <div x-show="editPenyimakOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
            <div @click.away="editPenyimakOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-md shadow-[8px_8px_0_0_#000] relative">
                <button type="button" @click="editPenyimakOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm cursor-pointer">✕</button>
                <h3 class="text-xl font-black mb-4 uppercase text-black">Edit Ustadz Penyimak</h3>
                <form :action="`/admin/simakan/penyimak/${editData.id}`" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block font-black uppercase text-xs mb-1 text-black">Nama Ustadz Penyimak</label>
                        <input type="text" name="name" x-model="editData.name" required class="w-full border-3 border-black p-2.5 rounded-lg font-bold text-sm text-black">
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-1 text-black">PIN Khusus Penyimak (Opsional)</label>
                        <input type="text" name="pin" x-model="editData.pin" placeholder="Kosongkan jika menggunakan PIN Global" class="w-full border-3 border-black p-2.5 rounded-lg font-bold text-sm text-black">
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-1 text-black">Status Penyimak</label>
                        <select name="is_active" x-model="editData.is_active" class="w-full border-3 border-black p-2.5 rounded-lg font-bold text-sm text-black bg-white">
                            <option value="1">Aktif (Muncul di Form Simakan)</option>
                            <option value="0">Nonaktif (Sembunyikan)</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-[#39FF14] text-black font-black py-3 rounded-lg border-3 border-black shadow-[4px_4px_0_0_#000] text-sm uppercase cursor-pointer">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
        <!-- Kartu Link Khusus Ustadz Penyimak -->
        <div class="lg:col-span-5 bg-white p-6 rounded-xl border-4 border-black shadow-[4px_4px_0_0_#000] flex flex-col justify-between" x-data="{ copied: false }">
            <div>
                <div class="flex items-center justify-between gap-2 mb-2">
                    <h3 class="font-black text-lg uppercase flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-700">vpn_key</span> Link Khusus Ustadz Penyimak
                    </h3>
                    <span class="px-2.5 py-0.5 text-[10px] font-black uppercase rounded border-2 border-black {{ !empty($config['is_active']) ? 'bg-[#39FF14] text-black' : 'bg-red-300 text-black' }}">
                        {{ !empty($config['is_active']) ? 'AKTIF' : 'DITUTUP' }}
                    </span>
                </div>
                <p class="text-xs font-bold text-gray-600 mb-4 leading-relaxed">
                    Bagikan link ini kepada <strong>Ustadz Penyimak Tahfizh</strong> yang terdaftar di atas. Dilindungi <strong>Kunci Ganda (Pilih Nama Penyimak + PIN Verifikasi)</strong>.
                </p>

                <div class="space-y-2.5 mb-4">
                    <input type="text" readonly id="simakan-link-input" value="{{ $simakanLink }}"
                           class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-xs bg-gray-50 focus:outline-none"/>

                    <div class="flex flex-wrap gap-2">
                        <button type="button"
                                @click="navigator.clipboard.writeText(document.getElementById('simakan-link-input').value); copied = true; setTimeout(() => copied = false, 2000)"
                                class="flex-1 bg-blue-200 hover:bg-blue-300 text-black px-3 py-2.5 font-black rounded-lg border-3 border-black shadow-[3px_3px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all text-xs uppercase flex items-center justify-center gap-1.5 cursor-pointer">
                            <span class="material-symbols-outlined text-sm" x-text="copied ? 'check' : 'content_copy'"></span>
                            <span x-text="copied ? 'Tersalin!' : 'Salin Link'"></span>
                        </button>

                        <a href="{{ $simakanLink }}" target="_blank"
                           class="bg-[#86EFAC] hover:bg-emerald-400 text-black px-3 py-2.5 font-black rounded-lg border-3 border-black shadow-[3px_3px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all text-xs uppercase flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-sm">open_in_new</span> Buka Pos
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t-2 border-dashed border-gray-300 pt-4 flex items-center justify-between gap-2">
                <div class="text-xs font-bold">
                    <span class="text-gray-500">PIN Global Penyimak:</span>
                    <span class="font-black bg-yellow-200 px-2 py-0.5 rounded border border-black ml-1">{{ $config['global_pin'] ?? '1234' }}</span>
                </div>

                <form action="{{ route('admin.simakan.code.regenerate') }}" method="POST"
                      onsubmit="return confirm('Buat link baru? Link lama akan langsung hangus dan Ustadz Penyimak harus diberi link baru.');">
                    @csrf
                    <button type="submit" class="bg-red-400 hover:bg-red-500 text-black px-3 py-1.5 font-black rounded-lg border-2 border-black shadow-[2px_2px_0_0_#000] text-[11px] uppercase flex items-center gap-1 cursor-pointer">
                        <span class="material-symbols-outlined text-xs">autorenew</span> Acak Ulang Link
                    </button>
                </form>
            </div>
        </div>

        <!-- Kartu Pengaturan Aturan Baris & Keamanan (Tanpa Ubah Kode) -->
        <div class="lg:col-span-7 bg-white p-6 rounded-xl border-4 border-black shadow-[4px_4px_0_0_#000]">
            <h3 class="font-black text-lg uppercase flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-[#FF007F]">tune</span> Pengaturan Aturan Simakan (Dinamis)
            </h3>
            <p class="text-xs font-bold text-gray-500 mb-4">
                Ubah batas minimal baris, PIN Global, dan aturan konversi halaman kapan saja tanpa perlu mengubah kode program.
            </p>

            <form action="{{ route('admin.simakan.config.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-black uppercase mb-1">🌱 Min Baris Ziyadah</label>
                        <input type="number" name="min_baris_ziyadah" value="{{ $config['min_baris_ziyadah'] ?? 2 }}" min="1" max="100" required
                               class="w-full border-3 border-black p-2 rounded-lg font-black text-sm focus:bg-yellow-50"/>
                    </div>
                    <div>
                        <label class="block text-[11px] font-black uppercase mb-1">🔄 Min Baris Muroja'ah</label>
                        <input type="number" name="min_baris_murojaah" value="{{ $config['min_baris_murojaah'] ?? 6 }}" min="1" max="300" required
                               class="w-full border-3 border-black p-2 rounded-lg font-black text-sm focus:bg-yellow-50"/>
                    </div>
                    <div>
                        <label class="block text-[11px] font-black uppercase mb-1">📖 Min Baris Tilawah</label>
                        <input type="number" name="min_baris_tilawah" value="{{ $config['min_baris_tilawah'] ?? 5 }}" min="1" max="300" required
                               class="w-full border-3 border-black p-2 rounded-lg font-black text-sm focus:bg-yellow-50"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-black uppercase mb-1">🔐 PIN Global Penyimak</label>
                        <input type="text" name="global_pin" value="{{ $config['global_pin'] ?? '1234' }}" required
                               class="w-full border-3 border-black p-2 rounded-lg font-black text-sm bg-yellow-50"/>
                    </div>
                    <div>
                        <label class="block text-[11px] font-black uppercase mb-1">📄 Baris / Halaman Mushaf</label>
                        <input type="number" name="baris_per_halaman" value="{{ $config['baris_per_halaman'] ?? 15 }}" min="5" max="30" required
                               class="w-full border-3 border-black p-2 rounded-lg font-black text-sm"/>
                    </div>
                    <div>
                        <label class="block text-[11px] font-black uppercase mb-1">🎯 Target Setor / Minggu</label>
                        <input type="number" name="target_mingguan" value="{{ $config['target_mingguan'] ?? 3 }}" min="1" max="21" required
                               class="w-full border-3 border-black p-2 rounded-lg font-black text-sm"/>
                    </div>
                </div>

                <!-- Pilihan Kategori Aktif & Opsi Tambahan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 border-t-2 border-gray-200">
                    <div class="space-y-1.5">
                        <p class="text-[11px] font-black uppercase text-gray-700">Kategori yang Dibuka:</p>
                        <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                            <input type="hidden" name="enable_ziyadah" value="0">
                            <input type="checkbox" name="enable_ziyadah" value="1" @checked(!empty($config['enable_ziyadah'])) class="w-4 h-4 border-2 border-black rounded">
                            <span>Setor Hafalan Baru (Ziyadah)</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                            <input type="hidden" name="enable_murojaah" value="0">
                            <input type="checkbox" name="enable_murojaah" value="1" @checked(!empty($config['enable_murojaah'])) class="w-4 h-4 border-2 border-black rounded">
                            <span>Muroja'ah (Ulang Hafalan)</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                            <input type="hidden" name="enable_tilawah" value="0">
                            <input type="checkbox" name="enable_tilawah" value="1" @checked(!empty($config['enable_tilawah'])) class="w-4 h-4 border-2 border-black rounded">
                            <span>Tilawah / Tahsin</span>
                        </label>
                    </div>

                    <div class="space-y-1.5">
                        <p class="text-[11px] font-black uppercase text-gray-700">Kebijakan Sistem:</p>
                        <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" @checked(!empty($config['is_active'])) class="w-4 h-4 border-2 border-black rounded">
                            <span>Buka Sesi Link Simakan Ustadz</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                            <input type="hidden" name="auto_attend_tahsin" value="0">
                            <input type="checkbox" name="auto_attend_tahsin" value="1" @checked(!empty($config['auto_attend_tahsin'])) class="w-4 h-4 border-2 border-black rounded">
                            <span>Otomatis Catat Hadir Tahsin Saat Lulus Setor</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                            <input type="hidden" name="hitung_mengulang" value="0">
                            <input type="checkbox" name="hitung_mengulang" value="1" @checked(!empty($config['hitung_mengulang'])) class="w-4 h-4 border-2 border-black rounded">
                            <span>Hitung Baris Meski Predikat Mengulang (I'adah)</span>
                        </label>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="bg-[#FFDE00] hover:bg-yellow-400 text-black px-5 py-2.5 font-black rounded-lg border-3 border-black shadow-[3px_3px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all text-xs uppercase cursor-pointer">
                        💾 Simpan Aturan Simakan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Riwayat & Filter Setoran Santri -->
    <div class="bg-white p-6 rounded-xl border-4 border-black shadow-[4px_4px_0_0_#000]">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-5">
            <h3 class="font-black text-lg uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-700">fact_check</span> Riwayat Setoran Hafalan Santri
            </h3>

            <form method="GET" action="{{ route('admin.simakan.index') }}" class="flex flex-wrap items-center gap-2">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama santri..."
                       class="border-2 border-black rounded-lg px-3 py-1.5 text-xs font-bold"/>

                <select name="jenis" class="border-2 border-black rounded-lg px-2.5 py-1.5 text-xs font-bold bg-white">
                    <option value="">Semua Kategori</option>
                    <option value="ziyadah" @selected($jenis === 'ziyadah')>🌱 Ziyadah</option>
                    <option value="murojaah" @selected($jenis === 'murojaah')>🔄 Muroja'ah</option>
                    <option value="tilawah" @selected($jenis === 'tilawah')>📖 Tilawah</option>
                </select>

                <select name="penyimak_id" class="border-2 border-black rounded-lg px-2.5 py-1.5 text-xs font-bold bg-white">
                    <option value="">Semua Penyimak</option>
                    @foreach($penyimakList as $p)
                        <option value="{{ $p->id }}" @selected($penyimakId == $p->id)>{{ $p->name }}</option>
                    @endforeach
                </select>

                <input type="date" name="tanggal" value="{{ $tanggal }}"
                       class="border-2 border-black rounded-lg px-2.5 py-1.5 text-xs font-bold"/>

                <button type="submit" class="bg-black text-white px-3.5 py-1.5 rounded-lg text-xs font-black uppercase cursor-pointer">
                    Filter
                </button>
                @if($search || $jenis || $penyimakId || $tanggal)
                    <a href="{{ route('admin.simakan.index') }}" class="bg-gray-200 text-black px-3 py-1.5 rounded-lg border border-black text-xs font-black">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b-3 border-black text-[11px] font-black uppercase">
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Nama Santri</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Surah & Ayat</th>
                        <th class="p-3">Jumlah Baris</th>
                        <th class="p-3">Predikat</th>
                        <th class="p-3">Ustadz Penyimak</th>
                        <th class="p-3">Catatan</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-200 text-xs font-bold">
                    @forelse($setorans as $row)
                        @php
                            $catBadge = match($row->jenis) {
                                'ziyadah' => 'bg-emerald-200 text-emerald-950',
                                'murojaah' => 'bg-amber-200 text-amber-950',
                                'tilawah' => 'bg-sky-200 text-sky-950',
                                default => 'bg-gray-200',
                            };
                        @endphp
                        <tr class="hover:bg-yellow-50/60">
                            <td class="p-3 whitespace-nowrap">{{ $row->tanggal_setor->format('d/m/Y') }}</td>
                            <td class="p-3 font-black">{{ $row->student->name ?? '-' }}</td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded border border-black text-[10px] font-black uppercase {{ $catBadge }}">
                                    {{ $row->jenis_label }}
                                </span>
                            </td>
                            <td class="p-3">
                                QS. {{ $row->surah }}
                                @if($row->ayat_awal)
                                    : {{ $row->ayat_awal }}{{ $row->ayat_akhir ? '–' . $row->ayat_akhir : '' }}
                                @endif
                            </td>
                            <td class="p-3">
                                <span class="bg-[#FFDE00] px-2 py-0.5 rounded border border-black font-black">
                                    {{ $row->jumlah_baris }} Baris
                                </span>
                            </td>
                            <td class="p-3 font-black">{{ $row->predikat }}</td>
                            <td class="p-3">{{ $row->penyimak_nama }}</td>
                            <td class="p-3 text-gray-600 max-w-[180px] truncate">{{ $row->catatan ?: '-' }}</td>
                            <td class="p-3 text-right">
                                <form action="{{ route('admin.simakan.destroy', $row->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus catatan setoran ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-200 hover:bg-red-400 text-black px-2.5 py-1 rounded border border-black text-[11px] font-black cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-8 text-center text-gray-500 font-bold">
                                Belum ada data setoran hafalan yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $setorans->links() }}
        </div>
    </div>

</x-admin-layout>
