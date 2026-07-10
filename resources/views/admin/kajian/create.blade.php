<x-admin-layout title="Jadwalkan Kajian" active="kajian">

    <!-- Header Action bar -->
    <div class="mb-6">
        <a href="{{ route('admin.kajian.index') }}" class="inline-flex items-center gap-2 bg-white text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span> KEMBALI
        </a>
    </div>

    <!-- Form Box -->
    <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[6px_6px_0_0_#000] max-w-2xl mx-auto">
        <h3 class="font-black text-xl mb-6 uppercase flex items-center gap-2 text-black">
            <span class="material-symbols-outlined text-[#39FF14]">calendar_today</span> Jadwal Kajian Baru
        </h3>

        <form action="{{ route('admin.kajian.store') }}" method="POST" class="space-y-5" 
            x-data="{ dateVal: '', repeatType: 'none', getDayName() { if(!this.dateVal) return ''; const days = ['Ahad', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; const d = new Date(this.dateVal); return days[d.getDay()]; } }">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block font-black uppercase text-xs mb-1.5 text-black">Judul Kajian <span class="text-red-500">*</span></label>
                <input type="text" name="title" placeholder="Masukan judul kajian..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
            </div>

            <!-- Ustadz -->
            <div>
                <label class="block font-black uppercase text-xs mb-1.5 text-black">Ustadz / Asatiz <span class="text-red-500">*</span></label>
                <select name="asatiz_id" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                    <option value="" disabled selected>Pilih Ustadz...</option>
                    @foreach($asatiz as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Program Kajian -->
            <div>
                <label class="block font-black uppercase text-xs mb-1.5 text-black">Program Kajian <span class="text-red-500">*</span></label>
                <select name="kajian_program_id" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                    <option value="" disabled selected>Pilih Program Kajian...</option>
                    @foreach($programs as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Grid: Tanggal, Waktu, Kuota -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Tanggal -->
                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Tanggal Mulai <span class="text-red-500">*</span></label>
                    <input type="date" name="date" x-model="dateVal" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                </div>

                <!-- Waktu -->
                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Waktu (Jam) <span class="text-red-500">*</span></label>
                    <input type="time" name="time" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                </div>

                <!-- Kuota -->
                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Kuota RSVP</label>
                    <input type="number" name="quota" placeholder="Kosongkan jika bebas..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm">
                </div>
            </div>

            <!-- Pengulangan (Recurring Options) -->
            <div class="bg-gray-50 dark:bg-zinc-800 border-4 border-black p-4 rounded-lg space-y-4 shadow-[2px_2px_0_0_#000]">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Tipe Pengulangan -->
                    <div>
                        <label class="block font-black uppercase text-xs mb-1.5 text-black">Frekuensi Kajian</label>
                        <select name="repeat_type" x-model="repeatType" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm">
                            <option value="none">Hanya Sekali (Sesuai Tanggal)</option>
                            <option value="weekly">Rutin (Setiap Minggu)</option>
                        </select>
                        <p x-show="repeatType === 'weekly' && dateVal" x-cloak class="text-xs text-blue-600 dark:text-blue-400 font-black mt-2 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">info</span>
                            Kajian otomatis diulang setiap hari <span class="underline" x-text="getDayName()"></span>.
                        </p>
                    </div>

                    <!-- Ulangi Hingga -->
                    <div x-show="repeatType === 'weekly'" x-cloak>
                        <label class="block font-black uppercase text-xs mb-1.5 text-black">Ulangi Hingga Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" name="repeat_until" :required="repeatType === 'weekly'" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm">
                        <p class="text-[10px] text-gray-500 font-bold mt-1">Maksimal pengulangan adalah 24 minggu (6 bulan).</p>
                    </div>
                </div>
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block font-black uppercase text-xs mb-1.5 text-black">Lokasi <span class="text-red-500">*</span></label>
                <input type="text" name="location" placeholder="Masjid Utama, Aula Santri, Zoom, dll..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block font-black uppercase text-xs mb-1.5 text-black">Deskripsi Kajian</label>
                <textarea name="description" rows="3" placeholder="Informasi tambahan mengenai kajian ini..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="w-full bg-[#39FF14] text-black font-black py-4 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none active:translate-y-1 transition-all text-sm uppercase">
                    SIMPAN DAN JADWALKAN KAJIAN
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>
