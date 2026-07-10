<x-admin-layout title="Kelola Landing Page" active="landing-page">

    <div x-data="{ tab: 'hero' }" class="max-w-4xl space-y-6">
        
        <!-- Header Info -->
        <div class="bg-black text-white p-6 border-4 border-black shadow-[4px_4px_0_0_#FFDE00] rounded-lg">
            <h3 class="font-black text-xl mb-2 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-[#FFDE00]">edit_document</span> Kelola Landing Page
            </h3>
            <p class="text-xs font-bold text-gray-300">
                Gunakan tab di bawah untuk mengubah berbagai komponen landing page utama. Setelah selesai mengedit, pastikan Anda menekan tombol <strong>Simpan Perubahan</strong> di bagian bawah halaman.
            </p>
        </div>

        <!-- Tabs Navigation -->
        <div class="flex flex-wrap gap-2 border-b-4 border-black pb-2">
            <button type="button" @click="tab = 'hero'" :class="tab === 'hero' ? 'bg-[#FFDE00] text-black border-4 border-black shadow-[4px_4px_0_0_#000] -translate-y-1' : 'bg-white text-black border-2 border-black hover:bg-gray-50'" class="px-4 py-2 font-black text-xs sm:text-sm uppercase transition-all duration-150">
                🚀 Hero Section
            </button>
            <button type="button" @click="tab = 'kajian'" :class="tab === 'kajian' ? 'bg-[#FFDE00] text-black border-4 border-black shadow-[4px_4px_0_0_#000] -translate-y-1' : 'bg-white text-black border-2 border-black hover:bg-gray-50'" class="px-4 py-2 font-black text-xs sm:text-sm uppercase transition-all duration-150">
                📅 Jadwal Kajian
            </button>
            <button type="button" @click="tab = 'pondok'" :class="tab === 'pondok' ? 'bg-[#FFDE00] text-black border-4 border-black shadow-[4px_4px_0_0_#000] -translate-y-1' : 'bg-white text-black border-2 border-black hover:bg-gray-50'" class="px-4 py-2 font-black text-xs sm:text-sm uppercase transition-all duration-150">
                🏫 Tentang Pondok
            </button>
            <button type="button" @click="tab = 'lokasi'" :class="tab === 'lokasi' ? 'bg-[#FFDE00] text-black border-4 border-black shadow-[4px_4px_0_0_#000] -translate-y-1' : 'bg-white text-black border-2 border-black hover:bg-gray-50'" class="px-4 py-2 font-black text-xs sm:text-sm uppercase transition-all duration-150">
                📍 Lokasi & Maps
            </button>
            <button type="button" @click="tab = 'kontak'" :class="tab === 'kontak' ? 'bg-[#FFDE00] text-black border-4 border-black shadow-[4px_4px_0_0_#000] -translate-y-1' : 'bg-white text-black border-2 border-black hover:bg-gray-50'" class="px-4 py-2 font-black text-xs sm:text-sm uppercase transition-all duration-150">
                📞 Hubungi Kami
            </button>
            <button type="button" @click="tab = 'footer'" :class="tab === 'footer' ? 'bg-[#FFDE00] text-black border-4 border-black shadow-[4px_4px_0_0_#000] -translate-y-1' : 'bg-white text-black border-2 border-black hover:bg-gray-50'" class="px-4 py-2 font-black text-xs sm:text-sm uppercase transition-all duration-150">
                📝 Footer
            </button>
        </div>

        <form action="{{ route('admin.landing-page.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- ERROR VALIDATION -->
            @if ($errors->any())
                <div class="bg-red-400 border-4 border-black p-4 font-black shadow-[4px_4px_0_0_#000] rounded-lg text-black">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-xl">error</span>
                        Terjadi kesalahan validasi:
                    </div>
                    <ul class="list-disc pl-5 text-xs space-y-1 font-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- TAB 1: HERO SECTION -->
            <div x-show="tab === 'hero'" class="bg-white p-6 border-4 border-black shadow-[4px_4px_0_0_#000] rounded-lg space-y-5">
                <h3 class="font-black text-lg border-b-4 border-black pb-2 uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#FF007F]">rocket_launch</span> Bagian Hero (Sambutan)
                </h3>
                
                <div>
                    <label class="block font-black uppercase text-xs mb-2">Label Atas (Badge)</label>
                    <input type="text" name="hero[badge]" value="{{ old('hero.badge', $landingPage['hero']['badge']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Judul Baris 1</label>
                        <input type="text" name="hero[title_1]" value="{{ old('hero.title_1', $landingPage['hero']['title_1']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" required>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Judul Baris 2 (Highlight)</label>
                        <input type="text" name="hero[title_2]" value="{{ old('hero.title_2', $landingPage['hero']['title_2']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" required>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Judul Baris 3</label>
                        <input type="text" name="hero[title_3]" value="{{ old('hero.title_3', $landingPage['hero']['title_3']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" required>
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Deskripsi Hero</label>
                    <textarea name="hero[desc]" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" rows="4" required>{{ old('hero.desc', $landingPage['hero']['desc']) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Teks Tombol Utama</label>
                        <input type="text" name="hero[btn_primary_text]" value="{{ old('hero.btn_primary_text', $landingPage['hero']['btn_primary_text']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" required>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Link Tombol Utama</label>
                        <input type="text" name="hero[btn_primary_link]" value="{{ old('hero.btn_primary_link', $landingPage['hero']['btn_primary_link']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Teks Tombol Kedua</label>
                        <input type="text" name="hero[btn_secondary_text]" value="{{ old('hero.btn_secondary_text', $landingPage['hero']['btn_secondary_text']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" required>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Link Tombol Kedua</label>
                        <input type="text" name="hero[btn_secondary_link]" value="{{ old('hero.btn_secondary_link', $landingPage['hero']['btn_secondary_link']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm" required>
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Foto / Gambar Hero</label>
                    <div class="flex items-center gap-4 border-4 border-dashed border-black p-4 rounded-lg bg-gray-50">
                        <div class="w-24 h-24 border-2 border-black bg-white flex items-center justify-center overflow-hidden shrink-0">
                            @if(!empty($landingPage['hero']['image']))
                                <img src="{{ asset($landingPage['hero']['image']) }}" alt="Hero Image" class="w-full h-full object-contain">
                            @else
                                <img src="{{ asset('images/logo-daar-hira.png') }}" alt="Default Logo" class="w-full h-full object-contain p-2">
                            @endif
                        </div>
                        <div class="space-y-1 flex-1">
                            <input type="file" name="hero_image" class="block w-full text-xs font-bold file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-2 file:border-black file:text-xs file:font-black file:bg-[#FFDE00] file:text-black hover:file:bg-yellow-400">
                            <p class="text-[10px] text-gray-500">Mendukung format JPG, PNG, WEBP. Maksimal ukuran 2 MB. Kosongkan jika tidak ingin mengubah gambar.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: JADWAL KAJIAN -->
            <div x-show="tab === 'kajian'" class="bg-white p-6 border-4 border-black shadow-[4px_4px_0_0_#000] rounded-lg space-y-6" x-data="{ items: {{ json_encode(old('kajian.items', $landingPage['kajian']['items'] ?? [])) }} }">
                <h3 class="font-black text-lg border-b-4 border-black pb-2 uppercase flex items-center justify-between gap-2">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#39FF14]">menu_book</span> Jadwal Kajian Rutin
                    </span>
                    <button type="button" @click="items.push({title: '', schedule: '', desc: '', icon: 'auto_stories', bg_class: 'bg-error-container'})" class="bg-[#39FF14] text-black border-2 border-black px-3 py-1.5 rounded-lg text-xs font-black uppercase shadow-[2px_2px_0_0_#000] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all">
                        + Tambah Kajian
                    </button>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Badge Seksi Kajian</label>
                        <input type="text" name="kajian[badge]" value="{{ old('kajian.badge', $landingPage['kajian']['badge']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" required>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-black uppercase text-xs mb-2">Judul Bagian 1</label>
                            <input type="text" name="kajian[title_1]" value="{{ old('kajian.title_1', $landingPage['kajian']['title_1']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" required>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-2">Judul Bagian 2</label>
                            <input type="text" name="kajian[title_2]" value="{{ old('kajian.title_2', $landingPage['kajian']['title_2']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" required>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Deskripsi Bagian Kajian</label>
                    <textarea name="kajian[desc]" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" rows="2" required>{{ old('kajian.desc', $landingPage['kajian']['desc']) }}</textarea>
                </div>

                <!-- Dynamic Items Grid -->
                <div class="space-y-4">
                    <p class="font-black text-xs uppercase tracking-wider text-gray-500">Daftar Item Kajian</p>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <template x-for="(item, index) in items" :key="index">
                            <div class="p-4 border-4 border-black bg-gray-50 relative space-y-4 shadow-[4px_4px_0_0_#000] rounded-lg">
                                <!-- Delete Button -->
                                <button type="button" @click="items.splice(index, 1)" class="absolute top-2 right-2 bg-red-400 text-black border-2 border-black w-8 h-8 flex items-center justify-center font-black rounded hover:bg-red-500 text-xs shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                                    ✕
                                </button>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-black text-[10px] uppercase mb-1">Judul Kajian</label>
                                        <input type="text" :name="'kajian[items][' + index + '][title]'" x-model="item.title" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required placeholder="Tafsir Jalalain">
                                    </div>
                                    <div>
                                        <label class="block font-black text-[10px] uppercase mb-1">Jadwal & Waktu</label>
                                        <input type="text" :name="'kajian[items][' + index + '][schedule]'" x-model="item.schedule" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required placeholder="📅 Setiap Senin · Ba'da Maghrib">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-black text-[10px] uppercase mb-1">Icon (Material Symbols)</label>
                                        <input type="text" :name="'kajian[items][' + index + '][icon]'" x-model="item.icon" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required placeholder="auto_stories">
                                    </div>
                                    <div>
                                        <label class="block font-black text-[10px] uppercase mb-1">Warna Background Kartu</label>
                                        <select :name="'kajian[items][' + index + '][bg_class]'" x-model="item.bg_class" class="w-full border-2 border-black p-2 font-bold text-xs rounded bg-white">
                                            <option value="bg-error-container">Merah Lembut (bg-error-container)</option>
                                            <option value="bg-secondary-container">Hijau Toska (bg-secondary-container)</option>
                                            <option value="bg-primary-fixed">Hijau Tua (bg-primary-fixed)</option>
                                            <option value="bg-tertiary-fixed">Kuning Emas (bg-tertiary-fixed)</option>
                                            <option value="bg-primary-fixed-dim">Mint/Hijau Pudar (bg-primary-fixed-dim)</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-black text-[10px] uppercase mb-1">Deskripsi Singkat</label>
                                    <textarea :name="'kajian[items][' + index + '][desc]'" x-model="item.desc" class="w-full border-2 border-black p-2 font-bold text-xs rounded" rows="2" required placeholder="Masukkan sinopsis atau rincian ustadz pengampu..."></textarea>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="items.length === 0" class="p-6 border-4 border-dashed border-black text-center text-gray-500 font-bold bg-gray-50 rounded-lg">
                        Tidak ada item kajian. Klik "+ Tambah Kajian" untuk menambahkannya.
                    </div>
                </div>
            </div>

            <!-- TAB 3: TENTANG PONDOK -->
            <div x-show="tab === 'pondok'" class="bg-white p-6 border-4 border-black shadow-[4px_4px_0_0_#000] rounded-lg space-y-6" x-data="{ facilities: {{ json_encode(old('pondok.facilities', $landingPage['pondok']['facilities'] ?? [])) }} }">
                <h3 class="font-black text-lg border-b-4 border-black pb-2 uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#FFDE00]">school</span> Bagian Tentang Pondok
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Badge Seksi</label>
                        <input type="text" name="pondok[badge]" value="{{ old('pondok.badge', $landingPage['pondok']['badge']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" required>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Judul Utama Seksi</label>
                        <input type="text" name="pondok[title]" value="{{ old('pondok.title', $landingPage['pondok']['title']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" required>
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Deskripsi Tentang Pondok</label>
                    <textarea name="pondok[desc]" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" rows="4" required>{{ old('pondok.desc', $landingPage['pondok']['desc']) }}</textarea>
                </div>

                <!-- Statistik Grid -->
                <div class="p-4 border-4 border-black rounded-lg bg-gray-50 space-y-4">
                    <p class="font-black text-xs uppercase tracking-wider text-gray-500">Statistik Utama</p>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="border-2 border-black bg-white p-2 rounded">
                            <label class="block font-black text-[9px] uppercase mb-1">Nilai Stat 1</label>
                            <input type="text" name="pondok[stat_1_val]" value="{{ old('pondok.stat_1_val', $landingPage['pondok']['stat_1_val']) }}" class="w-full border border-black p-1.5 font-bold text-xs" required>
                            <label class="block font-black text-[9px] uppercase mt-1">Label Stat 1</label>
                            <input type="text" name="pondok[stat_1_lbl]" value="{{ old('pondok.stat_1_lbl', $landingPage['pondok']['stat_1_lbl']) }}" class="w-full border border-black p-1.5 font-bold text-[10px]" required>
                        </div>
                        <div class="border-2 border-black bg-white p-2 rounded">
                            <label class="block font-black text-[9px] uppercase mb-1">Nilai Stat 2</label>
                            <input type="text" name="pondok[stat_2_val]" value="{{ old('pondok.stat_2_val', $landingPage['pondok']['stat_2_val']) }}" class="w-full border border-black p-1.5 font-bold text-xs" required>
                            <label class="block font-black text-[9px] uppercase mt-1">Label Stat 2</label>
                            <input type="text" name="pondok[stat_2_lbl]" value="{{ old('pondok.stat_2_lbl', $landingPage['pondok']['stat_2_lbl']) }}" class="w-full border border-black p-1.5 font-bold text-[10px]" required>
                        </div>
                        <div class="border-2 border-black bg-white p-2 rounded">
                            <label class="block font-black text-[9px] uppercase mb-1">Nilai Stat 3</label>
                            <input type="text" name="pondok[stat_3_val]" value="{{ old('pondok.stat_3_val', $landingPage['pondok']['stat_3_val']) }}" class="w-full border border-black p-1.5 font-bold text-xs" required>
                            <label class="block font-black text-[9px] uppercase mt-1">Label Stat 3</label>
                            <input type="text" name="pondok[stat_3_lbl]" value="{{ old('pondok.stat_3_lbl', $landingPage['pondok']['stat_3_lbl']) }}" class="w-full border border-black p-1.5 font-bold text-[10px]" required>
                        </div>
                    </div>
                </div>

                <!-- Visi & Misi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 border-4 border-black rounded-lg bg-gray-50 space-y-3">
                        <p class="font-black text-xs uppercase text-gray-500">Kolom Visi</p>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Judul Visi</label>
                            <input type="text" name="pondok[visi_title]" value="{{ old('pondok.visi_title', $landingPage['pondok']['visi_title']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Deskripsi Visi</label>
                            <textarea name="pondok[visi_desc]" class="w-full border-2 border-black p-2 font-bold text-xs rounded" rows="3" required>{{ old('pondok.visi_desc', $landingPage['pondok']['visi_desc']) }}</textarea>
                        </div>
                    </div>
                    <div class="p-4 border-4 border-black rounded-lg bg-gray-50 space-y-3">
                        <p class="font-black text-xs uppercase text-gray-500">Kolom Misi</p>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Judul Misi</label>
                            <input type="text" name="pondok[misi_title]" value="{{ old('pondok.misi_title', $landingPage['pondok']['misi_title']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Deskripsi Misi</label>
                            <textarea name="pondok[misi_desc]" class="w-full border-2 border-black p-2 font-bold text-xs rounded" rows="3" required>{{ old('pondok.misi_desc', $landingPage['pondok']['misi_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Facilities -->
                <div class="p-4 border-4 border-black rounded-lg bg-gray-50 space-y-4">
                    <div class="flex justify-between items-center border-b-2 border-black pb-2">
                        <p class="font-black text-xs uppercase text-gray-500">Fasilitas Pondok</p>
                        <button type="button" @click="facilities.push({icon: 'mosque', label: ''})" class="bg-[#39FF14] text-black border-2 border-black px-2.5 py-1 rounded text-[10px] font-black uppercase shadow-[1px_1px_0_0_#000] hover:translate-x-[0.5px] hover:translate-y-[0.5px] hover:shadow-none transition-all">
                            + Tambah Fasilitas
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <template x-for="(facility, index) in facilities" :key="index">
                            <div class="flex items-center gap-2 border-2 border-black p-2 bg-white rounded relative">
                                <button type="button" @click="facilities.splice(index, 1)" class="absolute -top-1.5 -right-1.5 bg-red-400 border border-black w-5 h-5 flex items-center justify-center rounded-full text-black hover:bg-red-500 text-[9px] font-black shadow">
                                    ✕
                                </button>
                                <div class="w-1/3">
                                    <input type="text" :name="'pondok[facilities][' + index + '][icon]'" x-model="facility.icon" class="w-full border border-black p-1 text-center font-bold text-xs rounded" required placeholder="icon">
                                </div>
                                <div class="w-2/3">
                                    <input type="text" :name="'pondok[facilities][' + index + '][label]'" x-model="facility.label" class="w-full border border-black p-1 font-bold text-xs rounded" required placeholder="Masjid">
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="facilities.length === 0" class="p-4 border-2 border-dashed border-black text-center text-xs text-gray-500 font-bold bg-white rounded">
                        Tidak ada fasilitas tercatat. Klik "+ Tambah Fasilitas" untuk menambahkannya.
                    </div>
                </div>
            </div>

            <!-- TAB 4: LOKASI & MAPS -->
            <div x-show="tab === 'lokasi'" class="bg-white p-6 border-4 border-black shadow-[4px_4px_0_0_#000] rounded-lg space-y-5">
                <h3 class="font-black text-lg border-b-4 border-black pb-2 uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#FF007F]">location_on</span> Bagian Lokasi & Maps
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Badge Lokasi</label>
                        <input type="text" name="lokasi[badge]" value="{{ old('lokasi.badge', $landingPage['lokasi']['badge']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" required>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Judul Seksi Lokasi</label>
                        <input type="text" name="lokasi[title]" value="{{ old('lokasi.title', $landingPage['lokasi']['title']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" required>
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Deskripsi Lokasi</label>
                    <textarea name="lokasi[desc]" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" rows="2" required>{{ old('lokasi.desc', $landingPage['lokasi']['desc']) }}</textarea>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Google Maps Embed URL</label>
                    <input type="text" name="lokasi[maps_url]" value="{{ old('lokasi.maps_url', $landingPage['lokasi']['maps_url']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-xs" required>
                    <p class="text-[10px] text-gray-500 mt-1">Masukkan URL iframe `src` dari Google Maps Embed (contoh: https://maps.google.com/maps?...&output=embed).</p>
                </div>

                <div class="p-4 border-4 border-black rounded-lg bg-gray-50 space-y-4">
                    <p class="font-black text-xs uppercase tracking-wider text-gray-500">Informasi Alamat</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Judul Alamat</label>
                            <input type="text" name="lokasi[alamat_title]" value="{{ old('lokasi.alamat_title', $landingPage['lokasi']['alamat_title']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">URL Google Maps Eksternal (Link Tombol)</label>
                            <input type="text" name="lokasi[alamat_link]" value="{{ old('lokasi.alamat_link', $landingPage['lokasi']['alamat_link']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                    </div>
                    <div>
                        <label class="block font-black text-[10px] uppercase mb-1">Teks Lengkap Alamat</label>
                        <textarea name="lokasi[alamat_text]" class="w-full border-2 border-black p-2 font-bold text-xs rounded" rows="2" required>{{ old('lokasi.alamat_text', $landingPage['lokasi']['alamat_text']) }}</textarea>
                    </div>
                </div>

                <div class="p-4 border-4 border-black rounded-lg bg-gray-50 space-y-3">
                    <p class="font-black text-xs uppercase tracking-wider text-gray-500">Jam Besuk</p>
                    <div>
                        <label class="block font-black text-[10px] uppercase mb-1">Judul Jam Besuk</label>
                        <input type="text" name="lokasi[jam_besuk_title]" value="{{ old('lokasi.jam_besuk_title', $landingPage['lokasi']['jam_besuk_title']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                    </div>
                    <div>
                        <label class="block font-black text-[10px] uppercase mb-1">Keterangan Jam Besuk</label>
                        <textarea name="lokasi[jam_besuk_text]" class="w-full border-2 border-black p-2 font-bold text-xs rounded" rows="3" required>{{ old('lokasi.jam_besuk_text', $landingPage['lokasi']['jam_besuk_text']) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- TAB 5: HUBUNGI KAMI -->
            <div x-show="tab === 'kontak'" class="bg-white p-6 border-4 border-black shadow-[4px_4px_0_0_#000] rounded-lg space-y-6">
                <h3 class="font-black text-lg border-b-4 border-black pb-2 uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#39FF14]">call</span> Bagian Hubungi Kami (WhatsApp & Email)
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Judul Hubungi Kami</label>
                        <input type="text" name="kontak[title]" value="{{ old('kontak.title', $landingPage['kontak']['title']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" required>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Deskripsi Singkat</label>
                        <input type="text" name="kontak[desc]" value="{{ old('kontak.desc', $landingPage['kontak']['desc']) }}" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- WhatsApp Card Settings -->
                    <div class="p-4 border-4 border-black rounded-lg bg-gray-50 space-y-3">
                        <p class="font-black text-xs uppercase text-gray-500">Kontak 1: WhatsApp</p>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Judul Kartu</label>
                            <input type="text" name="kontak[wa_title]" value="{{ old('kontak.wa_title', $landingPage['kontak']['wa_title']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Deskripsi Kartu</label>
                            <textarea name="kontak[wa_desc]" class="w-full border-2 border-black p-2 font-bold text-xs rounded" rows="2" required>{{ old('kontak.wa_desc', $landingPage['kontak']['wa_desc']) }}</textarea>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Teks Tombol</label>
                            <input type="text" name="kontak[wa_btn]" value="{{ old('kontak.wa_btn', $landingPage['kontak']['wa_btn']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Link Tombol (WA API Link)</label>
                            <input type="text" name="kontak[wa_link]" value="{{ old('kontak.wa_link', $landingPage['kontak']['wa_link']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required placeholder="https://wa.me/6281234567890">
                        </div>
                    </div>

                    <!-- Email Card Settings -->
                    <div class="p-4 border-4 border-black rounded-lg bg-gray-50 space-y-3">
                        <p class="font-black text-xs uppercase text-gray-500">Kontak 2: Email</p>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Judul Kartu</label>
                            <input type="text" name="kontak[email_title]" value="{{ old('kontak.email_title', $landingPage['kontak']['email_title']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Deskripsi Kartu</label>
                            <textarea name="kontak[email_desc]" class="w-full border-2 border-black p-2 font-bold text-xs rounded" rows="2" required>{{ old('kontak.email_desc', $landingPage['kontak']['email_desc']) }}</textarea>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Teks Tombol</label>
                            <input type="text" name="kontak[email_btn]" value="{{ old('kontak.email_btn', $landingPage['kontak']['email_btn']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Link Tombol (mailto: Link)</label>
                            <input type="text" name="kontak[email_link]" value="{{ old('kontak.email_link', $landingPage['kontak']['email_link']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required placeholder="mailto:info@kajiansantri.id">
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 6: FOOTER -->
            <div x-show="tab === 'footer'" class="bg-white p-6 border-4 border-black shadow-[4px_4px_0_0_#000] rounded-lg space-y-5">
                <h3 class="font-black text-lg border-b-4 border-black pb-2 uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#FFDE00]">text_fields</span> Bagian Footer (Catatan Kaki)
                </h3>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Deskripsi Footer</label>
                    <textarea name="footer[desc]" class="w-full border-4 border-black p-3 rounded-lg font-bold text-sm" rows="3" required>{{ old('footer.desc', $landingPage['footer']['desc']) }}</textarea>
                </div>

                <div class="p-4 border-4 border-black rounded-lg bg-gray-50 space-y-3">
                    <p class="font-black text-xs uppercase tracking-wider text-gray-500">Tautan Ikon Sosial/Kontak Footer</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Link WhatsApp</label>
                            <input type="text" name="footer[wa]" value="{{ old('footer.wa', $landingPage['footer']['wa']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Link Email</label>
                            <input type="text" name="footer[email]" value="{{ old('footer.email', $landingPage['footer']['email']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                        <div>
                            <label class="block font-black text-[10px] uppercase mb-1">Link Google Maps</label>
                            <input type="text" name="footer[maps]" value="{{ old('footer.maps', $landingPage['footer']['maps']) }}" class="w-full border-2 border-black p-2 font-bold text-xs rounded" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-[#FFDE00] text-black px-10 py-4 font-black rounded-lg border-4 border-black shadow-[6px_6px_0_0_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all text-sm uppercase cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>
