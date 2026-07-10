<x-admin-layout title="Edit Kajian" active="kajian">

    <!-- Header Action bar -->
    <div class="mb-6">
        <a href="{{ route('admin.kajian.index') }}" class="inline-flex items-center gap-2 bg-white text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span> KEMBALI
        </a>
    </div>

    <!-- Form Box -->
    <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[6px_6px_0_0_#000] max-w-2xl mx-auto">
        <h3 class="font-black text-xl mb-6 uppercase flex items-center gap-2 text-black border-b-4 border-black pb-3">
            <span class="material-symbols-outlined text-cyan-400">edit</span> Edit Kajian & Dokumentasi
        </h3>

        <form action="{{ route('admin.kajian.update', $kajian->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- SECTION 1: Informasi Dasar -->
            <div class="space-y-4">
                <h4 class="font-black text-sm uppercase bg-black text-white px-3 py-1 rounded inline-block">1. Informasi Utama</h4>
                
                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Judul Kajian <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $kajian->title) }}" placeholder="Masukan judul kajian..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Ustadz / Asatiz <span class="text-red-500">*</span></label>
                    <select name="asatiz_id" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                        @foreach($asatiz as $a)
                            <option value="{{ $a->id }}" {{ old('asatiz_id', $kajian->asatiz_id) == $a->id ? 'selected' : '' }}>{{ $a->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Program Kajian <span class="text-red-500">*</span></label>
                    <select name="kajian_program_id" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}" {{ old('kajian_program_id', $kajian->kajian_program_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-black uppercase text-xs mb-1.5 text-black">Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" name="date" value="{{ old('date', $kajian->date->toDateString()) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                    </div>

                    <div>
                        <label class="block font-black uppercase text-xs mb-1.5 text-black">Waktu (Jam) <span class="text-red-500">*</span></label>
                        <input type="time" name="time" value="{{ old('time', substr($kajian->time, 0, 5)) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                    </div>

                    <div>
                        <label class="block font-black uppercase text-xs mb-1.5 text-black">Kuota RSVP</label>
                        <input type="number" name="quota" value="{{ old('quota', $kajian->quota) }}" placeholder="Bebas..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Lokasi <span class="text-red-500">*</span></label>
                    <input type="text" name="location" value="{{ old('location', $kajian->location) }}" placeholder="Masjid Utama, Aula, dll..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm" required>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Deskripsi Kajian</label>
                    <textarea name="description" rows="3" class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm">{{ old('description', $kajian->description) }}</textarea>
                </div>
            </div>

            <!-- SECTION 2: Dokumentasi & Ringkasan -->
            <div class="space-y-4 pt-4 border-t-4 border-black">
                <h4 class="font-black text-sm uppercase bg-black text-white px-3 py-1 rounded inline-block">2. Dokumentasi & Ringkasan (Opsional)</h4>
                <p class="text-xs text-gray-500 font-bold italic">Lengkapi bagian ini setelah kajian selesai dilaksanakan untuk dibaca oleh santri.</p>

                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Link Rekaman YouTube</label>
                    <input type="url" name="youtube_link" value="{{ old('youtube_link', $kajian->youtube_link) }}" placeholder="https://youtube.com/..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm">
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Link Rekaman Spotify</label>
                    <input type="url" name="spotify_link" value="{{ old('spotify_link', $kajian->spotify_link) }}" placeholder="https://open.spotify.com/..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm">
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Link File Materi (Slides/PDF/Drive)</label>
                    <input type="url" name="material_link" value="{{ old('material_link', $kajian->material_link) }}" placeholder="https://drive.google.com/..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm">
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-1.5 text-black">Ringkasan / Catatan Kajian</label>
                    <textarea name="summary" rows="5" placeholder="Tuliskan intisari materi kajian agar dapat dipelajari kembali..." class="w-full border-4 border-black p-3 rounded-lg font-bold text-black focus:outline-none focus:bg-yellow-50 text-sm">{{ old('summary', $kajian->summary) }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="w-full bg-[#FFDE00] text-black font-black py-4 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none active:translate-y-1 transition-all text-sm uppercase">
                    SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>
