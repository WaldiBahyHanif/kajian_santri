<x-admin-layout title="Pengaturan" active="pengaturan">

    <div class="max-w-2xl">
        <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000]">
            <h3 class="font-black text-xl mb-6 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-[#FF007F]">settings</span> Pengaturan Sistem
            </h3>
            <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="space-y-5">
                @csrf @method('PUT')

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Teks Pengumuman Pop-up</label>
                    <textarea name="announcement_text" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" rows="5" placeholder="Ketik pengumuman yang akan muncul sebagai pop-up di aplikasi santri...">{{ $setting->announcement_text }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin menampilkan pengumuman pop-up.</p>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Status Pop-up</label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 cursor-pointer bg-[#39FF14] border-4 border-black px-4 py-2 rounded-lg font-black text-sm">
                            <input type="hidden" name="is_popup_active" value="0">
                            <input type="checkbox" name="is_popup_active" value="1" {{ $setting->is_popup_active ? 'checked' : '' }} class="w-5 h-5 border-2 border-black rounded">
                            <span class="uppercase">{{ $setting->is_popup_active ? 'Pop-up AKTIF' : 'Pop-up NONAKTIF' }}</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Jika aktif, pengumuman akan muncul sebagai pop-up di halaman santri.</p>
                </div>

                @php
                    $tahsinDays = \App\Models\Setting::getTahsinDays();
                    $day1 = $tahsinDays[0] ?? 2;
                    $day2 = $tahsinDays[1] ?? 5;
                    $allDays = [
                        1 => 'Senin',
                        2 => 'Selasa',
                        3 => 'Rabu',
                        4 => 'Kamis',
                        5 => 'Jumat',
                        6 => 'Sabtu',
                        7 => 'Ahad',
                    ];
                @endphp

                <div class="border-t-4 border-black pt-4 bg-purple-50 p-4 rounded-xl border-4 border-black">
                    <label class="block font-black uppercase text-xs mb-1 text-purple-950 flex items-center gap-1.5">
                        <span class="text-base">🕌</span> Jadwal Rutin Tahsin & Tahfidz (2x Seminggu)
                    </label>
                    <p class="text-xs text-purple-900 font-bold mb-3">
                        Pilih 2 hari rutin yang berbeda. Sistem akan menggunakan 2 hari ini untuk menampilkan kolom rekap bulanan secara rapi tanpa kolom kosong yang sia-sia.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-black uppercase text-[11px] mb-1 text-gray-700">Hari Rutin 1</label>
                            <select name="tahsin_day_1" class="w-full border-4 border-black p-2.5 rounded-lg font-bold bg-white text-sm focus:outline-none focus:bg-yellow-50">
                                @foreach($allDays as $iso => $name)
                                    <option value="{{ $iso }}" {{ $day1 == $iso ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-[11px] mb-1 text-gray-700">Hari Rutin 2 (Beda Hari)</label>
                            <select name="tahsin_day_2" class="w-full border-4 border-black p-2.5 rounded-lg font-bold bg-white text-sm focus:outline-none focus:bg-yellow-50">
                                @foreach($allDays as $iso => $name)
                                    <option value="{{ $iso }}" {{ $day2 == $iso ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="border-t-4 border-black pt-4">
                    <label class="block font-black uppercase text-xs mb-2 text-primary">⚙️ Mode Status Kebun Kebaikan</label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 cursor-pointer border-4 border-black px-4 py-2 rounded-lg font-black text-xs hover:bg-zinc-50 {{ ($setting->garden_mode ?? 'auto') === 'auto' ? 'bg-[#39FF14] text-black' : 'bg-white' }}" id="mode_auto_label">
                            <input type="radio" name="garden_mode" value="auto" {{ ($setting->garden_mode ?? 'auto') === 'auto' ? 'checked' : '' }} onchange="toggleGardenStatusSelection(this.value)" class="w-4 h-4 border-2 border-black">
                            <span>🤖 OTOMATIS (Dihitung Sistem)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer border-4 border-black px-4 py-2 rounded-lg font-black text-xs hover:bg-zinc-50 {{ ($setting->garden_mode ?? 'auto') === 'manual' ? 'bg-cyan-300 text-black' : 'bg-white' }}" id="mode_manual_label">
                            <input type="radio" name="garden_mode" value="manual" {{ ($setting->garden_mode ?? 'auto') === 'manual' ? 'checked' : '' }} onchange="toggleGardenStatusSelection(this.value)" class="w-4 h-4 border-2 border-black">
                            <span>✍️ MANUAL (Diatur Admin)</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Gunakan mode otomatis agar kesuburan kebun dihitung mandiri dari data absensi kajian & refleksi santri.</p>
                </div>

                <div class="border-t-4 border-black pt-4" id="garden_status_container" style="{{ ($setting->garden_mode ?? 'auto') === 'auto' ? 'opacity: 0.5; pointer-events: none;' : '' }}">
                    <label class="block font-black uppercase text-xs mb-2 text-primary">🌱 Status Kebun Kebaikan Harian (Khusus Mode Manual)</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center gap-2 cursor-pointer border-4 border-black p-3 rounded-lg font-black text-xs hover:bg-zinc-50 {{ $setting->garden_status === 'subur_sekali' ? 'bg-green-300 text-black' : 'bg-white' }}">
                            <input type="radio" name="garden_status" value="subur_sekali" {{ $setting->garden_status === 'subur_sekali' ? 'checked' : '' }} class="w-4 h-4 border-2 border-black">
                            <span>🌳 Sangat Subur</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer border-4 border-black p-3 rounded-lg font-black text-xs hover:bg-zinc-50 {{ $setting->garden_status === 'subur' ? 'bg-emerald-300 text-black' : 'bg-white' }}">
                            <input type="radio" name="garden_status" value="subur" {{ $setting->garden_status === 'subur' ? 'checked' : '' }} class="w-4 h-4 border-2 border-black">
                            <span>🌿 Subur (Normal)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer border-4 border-black p-3 rounded-lg font-black text-xs hover:bg-zinc-50 {{ $setting->garden_status === 'biasa' ? 'bg-yellow-300 text-black' : 'bg-white' }}">
                            <input type="radio" name="garden_status" value="biasa" {{ $setting->garden_status === 'biasa' ? 'checked' : '' }} class="w-4 h-4 border-2 border-black">
                            <span>🍃 Kurang Subur</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer border-4 border-black p-3 rounded-lg font-black text-xs hover:bg-zinc-50 {{ $setting->garden_status === 'kering' ? 'bg-red-300 text-black' : 'bg-white' }}">
                            <input type="radio" name="garden_status" value="kering" {{ $setting->garden_status === 'kering' ? 'checked' : '' }} class="w-4 h-4 border-2 border-black">
                            <span>🍂 Layu / Kering</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Mengubah kondisi visualisasi kebun secara langsung (Hanya bekerja jika mode manual diaktifkan).</p>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Pesan Motivasi Kebersamaan Kebun</label>
                    <textarea name="garden_message" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" rows="3" placeholder="Contoh: Hari ini kebun kita tumbuh 85% subur! MasyaAllah. Tingkatkan lagi zikir kalian...">{{ $setting->garden_message }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Tulis kalimat penyemangat untuk memicu motivasi ibadah santri secara kolektif.</p>
                </div>

                <div class="border-t-4 border-black pt-4 bg-green-50 p-4 rounded-xl border-4 border-black">
                    <label class="block font-black uppercase text-xs mb-1 text-green-950 flex items-center gap-1.5">
                        <span class="text-base">📱</span> Nomor WhatsApp Musyrif (Konfirmasi Izin)
                    </label>
                    <p class="text-xs text-green-900 font-bold mb-3">
                        Nomor musyrif yang dihubungi otomatis saat santri mengajukan izin. Kalau ada pergantian musyrif, cukup ganti nomornya di sini — tidak perlu ubah kode.
                    </p>
                    <div class="space-y-3">
                        <div>
                            <label class="block font-black uppercase text-[11px] mb-1 text-gray-700">Musyrif Izin Pengajian &amp; Sakit</label>
                            <input type="text" name="wa_musyrif_pengajian" value="{{ old('wa_musyrif_pengajian', $setting->wa_musyrif_pengajian) }}" placeholder="misal: 6281234567890" class="w-full border-4 border-black p-2.5 rounded-lg font-bold bg-white text-sm focus:outline-none focus:bg-yellow-50">
                            @error('wa_musyrif_pengajian') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block font-black uppercase text-[11px] mb-1 text-gray-700">Musyrif Izin Tidak di Asrama (1 Malam)</label>
                            <input type="text" name="wa_musyrif_asrama_1_malam" value="{{ old('wa_musyrif_asrama_1_malam', $setting->wa_musyrif_asrama_1_malam) }}" placeholder="misal: 6281234567891" class="w-full border-4 border-black p-2.5 rounded-lg font-bold bg-white text-sm focus:outline-none focus:bg-yellow-50">
                            @error('wa_musyrif_asrama_1_malam') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block font-black uppercase text-[11px] mb-1 text-gray-700">Musyrif Izin Tidak di Asrama (&gt;1 Malam) &amp; Cuti</label>
                            <input type="text" name="wa_musyrif_asrama_lebih_1_malam" value="{{ old('wa_musyrif_asrama_lebih_1_malam', $setting->wa_musyrif_asrama_lebih_1_malam) }}" placeholder="misal: 6281234567892" class="w-full border-4 border-black p-2.5 rounded-lg font-bold bg-white text-sm focus:outline-none focus:bg-yellow-50">
                            @error('wa_musyrif_asrama_lebih_1_malam') <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Format: kode negara + nomor tanpa angka 0 di depan dan tanpa spasi/tanda apa pun. Contoh nomor 0812-3456-7890 ditulis <span class="font-mono">6281234567890</span>.</p>
                </div>

                <div class="pt-4 border-t-4 border-black">
                    <button type="submit" class="bg-[#FFDE00] text-black px-8 py-3 font-black rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all text-sm uppercase">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>

        <!-- Liqo Access Link Card -->
        <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mt-6" x-data="{ copied: false }">
            <h3 class="font-black text-xl mb-2 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-green-700">link</span> Link Absensi Liqo
            </h3>
            <p class="text-xs font-bold text-gray-500 mb-4 leading-relaxed">
                Bagikan link ini hanya ke guru/pembimbing liqo (misal lewat grup WA guru). Siapapun yang punya link ini bisa isi absensi kelompoknya tanpa perlu login.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 mb-3">
                <input type="text" readonly id="liqo-link-input" value="{{ $liqoLink }}"
                       class="flex-1 border-4 border-black p-2.5 rounded-lg font-bold text-sm bg-gray-50 focus:outline-none">
                <button type="button"
                        @click="navigator.clipboard.writeText(document.getElementById('liqo-link-input').value); copied = true; setTimeout(() => copied = false, 2000)"
                        class="shrink-0 bg-blue-200 text-black px-4 py-2.5 font-black rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-xs uppercase flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-sm" x-text="copied ? 'check' : 'content_copy'"></span>
                    <span x-text="copied ? 'Tersalin!' : 'Salin Link'"></span>
                </button>
            </div>
            <form action="{{ route('admin.pengaturan.liqo-code.regenerate') }}" method="POST"
                  onsubmit="return confirm('Yakin mau buat link baru? Link lama akan langsung tidak berfungsi dan guru harus diberi link baru.');">
                @csrf
                <button type="submit" class="bg-red-400 text-black px-4 py-2 font-black rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-xs uppercase flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">autorenew</span> Regenerate Link
                </button>
            </form>
        </div>

        <!-- Archiving Card -->
        <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mt-6">
            <h3 class="font-black text-xl mb-4 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-purple-700">archive</span> Pengarsipan & Pembersihan Data Lama
            </h3>
            <p class="text-xs font-bold text-gray-500 mb-6 leading-relaxed">
                Gunakan fitur ini untuk menjaga agar database tidak kepenuhan. Ekspor data lama ke file CSV terkompresi ZIP, lalu bersihkan database dari data tersebut secara aman.
            </p>

            <form id="archiveForm" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block font-black uppercase text-xs mb-2">Tanggal Batas Pemotongan (Cutoff Date)</label>
                    <input type="date" name="cutoff_date" value="{{ now()->subYear()->toDateString() }}" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" required>
                    <p class="text-xs text-gray-500 mt-1">Data yang dibuat <strong>sebelum</strong> tanggal ini akan diproses.</p>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Pilih Data Yang Akan Diproses</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2.5 font-bold cursor-pointer text-sm">
                            <input type="checkbox" name="tables[]" value="attendance_logs" checked class="w-4 h-4 border-2 border-black rounded">
                            <span>Data Absensi Santri (`attendance_logs`)</span>
                        </label>
                        <label class="flex items-center gap-2.5 font-bold cursor-pointer text-sm">
                            <input type="checkbox" name="tables[]" value="reflections" checked class="w-4 h-4 border-2 border-black rounded">
                            <span>Data Refleksi Harian (`reflections`)</span>
                        </label>
                        <label class="flex items-center gap-2.5 font-bold cursor-pointer text-sm">
                            <input type="checkbox" name="tables[]" value="daily_moods" checked class="w-4 h-4 border-2 border-black rounded">
                            <span>Data Mood Harian (`daily_moods`)</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 border-t-4 border-black flex flex-wrap gap-4">
                    <button type="submit" onclick="submitTo('{{ route('admin.pengaturan.archive-export') }}')" class="bg-cyan-300 text-black px-6 py-3 font-black rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-xs uppercase flex items-center gap-2 cursor-pointer">
                        <span class="material-symbols-outlined text-sm font-black">download</span> Download Arsip CSV (ZIP)
                    </button>
                    
                    <button type="submit" onclick="submitToConfirm(event, '{{ route('admin.pengaturan.archive-purge') }}')" class="bg-red-400 text-black px-6 py-3 font-black rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-xs uppercase flex items-center gap-2 cursor-pointer">
                        <span class="material-symbols-outlined text-sm font-black">delete_forever</span> Bersihkan Database
                    </button>
                </div>
            </form>
        </div>

        <script>
            function submitTo(route) {
                var form = document.getElementById('archiveForm');
                form.action = route;
            }

            function submitToConfirm(e, route) {
                if (confirm('PERINGATAN! Data lama akan dihapus permanen dari database. Pastikan Anda telah mengunduh arsipnya terlebih dahulu. Lanjutkan?')) {
                    var form = document.getElementById('archiveForm');
                    form.action = route;
                } else {
                    e.preventDefault();
                    return false;
                }
            }
        </script>

        <!-- Admin Accounts Card -->
        <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mt-6">
            <h3 class="font-black text-xl mb-4 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-[#FF007F]">group</span> Kelola Akun Admin
            </h3>
            <p class="text-xs font-bold text-gray-500 mb-6 leading-relaxed">
                Tambahkan atau hapus akun administrator yang memiliki akses ke panel admin ini.
            </p>

            <!-- List of Admins -->
            <div class="space-y-3 mb-6">
                @foreach($admins as $adm)
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg border-2 border-black">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-gray-500 font-bold">person</span>
                        <span class="font-bold text-sm">{{ $adm->username }}</span>
                        @if(auth()->guard('admin')->id() === $adm->id)
                            <span class="bg-[#39FF14] text-black text-[10px] font-black px-2 py-0.5 rounded border border-black uppercase">Anda</span>
                        @endif
                    </div>
                    
                    @if(auth()->guard('admin')->id() !== $adm->id)
                        <form action="{{ route('admin.pengaturan.admin.destroy', $adm->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin {{ $adm->username }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 flex items-center cursor-pointer">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </form>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Add Admin Form -->
            <form action="{{ route('admin.pengaturan.admin.store') }}" method="POST" class="space-y-4 border-t-4 border-black pt-4">
                @csrf
                <h4 class="font-black text-sm uppercase">Tambah Admin Baru</h4>
                
                <div>
                    <label class="block font-black uppercase text-[10px] mb-1">Username</label>
                    <input type="text" name="username" class="w-full border-4 border-black p-2.5 rounded-lg focus:outline-none focus:bg-yellow-50 text-sm font-bold @error('username') border-red-500 @enderror" required placeholder="Masukkan username baru..." value="{{ old('username') }}">
                    @error('username')
                        <p class="text-xs text-red-500 mt-1 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-black uppercase text-[10px] mb-1">Password</label>
                    <input type="password" name="password" class="w-full border-4 border-black p-2.5 rounded-lg focus:outline-none focus:bg-yellow-50 text-sm font-bold @error('password') border-red-500 @enderror" required placeholder="Masukkan password baru...">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-[#39FF14] text-black px-6 py-2.5 font-black rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-xs uppercase flex items-center gap-2 cursor-pointer">
                    <span class="material-symbols-outlined text-xs font-black">person_add</span> Tambah Admin
                </button>
            </form>
        </div>

        <!-- Info Box -->
        <div class="bg-black text-white p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#FFDE00] mt-6">
            <h4 class="font-black text-sm uppercase mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-[#FFDE00]">info</span> Informasi Sistem
            </h4>
            <ul class="text-xs font-bold space-y-1 text-gray-300">
                <li>Versi Aplikasi: 1.0.0</li>
                <li>Database: {{ config('database.connections.mysql.database') }}</li>
                <li>Cache Driver: {{ config('cache.default') }}</li>
                <li>Session Driver: {{ config('session.driver') }}</li>
                <li>PHP Version: {{ PHP_VERSION }}</li>
                <li>Laravel Version: {{ app()->version() }}</li>
            </ul>
        </div>
    </div>

    <script>
        function toggleGardenStatusSelection(mode) {
            const container = document.getElementById('garden_status_container');
            const autoLabel = document.getElementById('mode_auto_label');
            const manualLabel = document.getElementById('mode_manual_label');
            
            if (mode === 'auto') {
                container.style.opacity = '0.5';
                container.style.pointerEvents = 'none';
                
                autoLabel.classList.remove('bg-white');
                autoLabel.classList.add('bg-[#39FF14]');
                manualLabel.classList.remove('bg-cyan-300');
                manualLabel.classList.add('bg-white');
            } else {
                container.style.opacity = '1';
                container.style.pointerEvents = 'auto';
                
                autoLabel.classList.remove('bg-[#39FF14]');
                autoLabel.classList.add('bg-white');
                manualLabel.classList.remove('bg-white');
                manualLabel.classList.add('bg-cyan-300');
            }
        }
    </script>

</x-admin-layout>
