<x-admin-layout title="Kelola Santri" active="santri">

@php
    $jsonPath = database_path('data/indonesian_universities.json');
    $jsonUniversities = [];
    if (file_exists($jsonPath)) {
        $jsonUniversities = json_decode(file_get_contents($jsonPath), true) ?: [];
    }

    $dbUniversities = \App\Models\Student::whereNotNull('universitas')
        ->where('universitas', '!=', '')
        ->distinct()
        ->pluck('universitas')
        ->toArray();

    $allUniversities = collect(array_merge($jsonUniversities, $dbUniversities))
        ->unique()
        ->sort()
        ->values();
@endphp

<datalist id="existing-universities">
    @foreach($allUniversities as $uni)
        <option value="{{ $uni }}"></option>
    @endforeach
</datalist>

<div x-data="{ rolloverOpen: false }">
    
    <!-- Top Action bar -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-black text-xl uppercase text-black">Data Master Santri</h3>
        <button @click="rolloverOpen = true" class="bg-purple-300 text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none active:translate-y-1 active:shadow-none transition-all text-xs uppercase flex items-center gap-2 cursor-pointer">
            <span class="material-symbols-outlined text-sm font-black">school</span> LULUSKAN ANGKATAN
        </button>
    </div>

    <!-- Rollover Modal -->
    <div x-show="rolloverOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
        <div @click.away="rolloverOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-sm shadow-[8px_8px_0_0_#000] relative text-black">
            <button @click="rolloverOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm">X</button>
            <h3 class="text-xl font-black mb-3 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-purple-700 font-black">school</span> Luluskan Angkatan
            </h3>
            <p class="text-xs font-bold text-gray-500 mb-4 leading-relaxed">Ubah status aktif seluruh santri angkatan terpilih menjadi "Lulus" secara massal.</p>
            <form action="{{ route('admin.santri.rollover') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-black uppercase text-xs mb-1.5">Pilih Angkatan</label>
                    <select name="generation" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" required>
                        <option value="" disabled selected>-- Pilih Angkatan --</option>
                        @foreach($generations as $gen)
                            <option value="{{ $gen }}">{{ $gen }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin meluluskan seluruh santri aktif pada angkatan ini?')" class="w-full bg-purple-300 text-black font-black py-3 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase">
                    Proses Kelulusan
                </button>
            </form>
        </div>
    </div>

    <!-- Form Tambah -->
    <div class="bg-white p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-6">
        <h3 class="font-black text-lg mb-4 uppercase flex items-center gap-2">
            <span class="material-symbols-outlined text-[#00E5FF]">person_add</span> Tambah Santri / Musyrif
        </h3>
        <form action="{{ route('admin.santri.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black placeholder-gray-500 text-sm" required>
            <input type="text" name="username" placeholder="Username" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black placeholder-gray-500 text-sm" required>
            <div class="grid grid-cols-2 gap-3">
                <select name="title" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black text-sm">
                    <option value="Santri">SANTRI</option>
                    <option value="Musyrif">MUSYRIF</option>
                </select>
                <select name="status_aktif" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black text-sm">
                    <option value="Aktif">AKTIF</option>
                    <option value="Lulus">LULUS</option>
                </select>
            </div>
            <input type="text" name="universitas" list="existing-universities" placeholder="Universitas (opsional)" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black placeholder-gray-500 text-sm">
            <div class="grid grid-cols-2 gap-3">
                <input type="text" name="room" placeholder="Kamar" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black placeholder-gray-500 text-sm">
                <input type="text" name="generation" placeholder="Angkatan Pondok" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black placeholder-gray-500 text-sm">
            </div>
            <input type="number" name="angkatan" placeholder="Tahun Masuk Kuliah (mis. 2023)" min="2000" max="2099" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black placeholder-gray-500 text-sm">
            <button type="submit" class="bg-black text-white px-4 py-2.5 font-black rounded-lg border-4 border-black hover:bg-[#FFDE00] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase">
                + Simpan Santri
            </button>
        </form>
        @if($errors->any())
            <div class="mt-3 text-red-600 font-bold bg-red-100 p-2 border-2 border-red-600 rounded text-sm">
                @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
            </div>
        @endif
    </div>

    <!-- Data Table -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black flex justify-between items-center">
            <span class="uppercase text-sm tracking-widest">Daftar Santri & Musyrif ({{ $santris->count() }})</span>
        </div>

        <div x-data="{ editOpen: false, data: {} }">
            <!-- Table Header -->
            <div class="hidden lg:grid grid-cols-12 gap-2 p-3 bg-gray-100 border-b-4 border-black text-xs font-black uppercase">
                <span class="col-span-2">Nama</span>
                <span class="col-span-2">Universitas</span>
                <span class="col-span-1 text-center">Kuliah</span>
                <span class="col-span-1 text-center">Title</span>
                <span class="col-span-1 text-center">Status</span>
                <span class="col-span-1 text-center">Kamar</span>
                <span class="col-span-1 text-center">Ang. Pdok</span>
                <span class="col-span-1 text-center">Streak</span>
                <span class="col-span-2 text-right">Aksi</span>
            </div>

            @foreach($santris as $s)
            <div class="p-3 border-b-2 border-gray-200 grid grid-cols-1 lg:grid-cols-12 gap-2 items-center hover:bg-yellow-50 transition-colors">
                {{-- Nama (mobile: tampil semua info) --}}
                <div class="lg:col-span-2">
                    <span class="font-black text-sm">{{ $s->name }}</span>
                    <span class="lg:hidden text-xs text-gray-500 block mt-0.5">
                        {{ $s->username }} · {{ $s->title }} · {{ $s->status_aktif === 'Lulus' ? 'Alumni' : $s->status_aktif }}
                        @if($s->universitas) · 🎓 {{ $s->universitas }}@if($s->angkatan) '{{ substr($s->angkatan, 2) }}@endif @endif
                        · Ang. Pdok: {{ $s->generation ?? '-' }}
                    </span>
                </div>
                {{-- Universitas --}}
                <div class="hidden lg:block lg:col-span-2 text-xs font-bold truncate" title="{{ $s->universitas ?? '-' }}">
                    @if($s->universitas)
                        <span class="bg-blue-100 border border-blue-400 text-blue-800 px-1.5 py-0.5 rounded text-[10px] font-black">{{ $s->universitas }}</span>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </div>
                {{-- Tahun Masuk Kuliah --}}
                <div class="hidden lg:flex lg:col-span-1 justify-center">
                    @if($s->angkatan)
                        <span class="bg-indigo-100 border border-indigo-400 text-indigo-800 px-2 py-0.5 rounded text-[10px] font-black">'{{ substr($s->angkatan, 2) }}</span>
                    @else
                        <span class="text-gray-400 text-xs">-</span>
                    @endif
                </div>
                {{-- Title --}}
                <div class="hidden lg:flex lg:col-span-1 justify-center">
                    <span class="text-[10px] px-2 py-0.5 rounded border-2 border-black font-black uppercase {{ $s->title === 'Musyrif' ? 'bg-purple-300' : 'bg-cyan-300' }}">{{ $s->title }}</span>
                </div>
                {{-- Status --}}
                <div class="hidden lg:flex lg:col-span-1 justify-center">
                    <span class="text-[10px] px-2 py-0.5 rounded border-2 border-black font-black {{ $s->status_aktif === 'Aktif' ? 'bg-green-300' : 'bg-gray-300' }}">{{ $s->status_aktif === 'Lulus' ? 'Alumni' : $s->status_aktif }}</span>
                </div>
                {{-- Kamar --}}
                <div class="hidden lg:flex lg:col-span-1 justify-center text-xs font-bold">{{ $s->room ?? '-' }}</div>
                {{-- Angkatan Pondok --}}
                <div class="hidden lg:flex lg:col-span-1 justify-center text-xs font-bold">{{ $s->generation ?? '-' }}</div>
                {{-- Streak --}}
                <div class="hidden lg:flex lg:col-span-1 justify-center text-sm font-black">{{ $s->current_streak ?? 0 }}</div>
                {{-- Aksi --}}
                <div class="lg:col-span-2 flex justify-end gap-2">
                    <button type="button"
                        @click="data = { id: {{ $s->id }}, name: '{{ addslashes($s->name) }}', username: '{{ addslashes($s->username) }}', title: '{{ $s->title }}', status_aktif: '{{ $s->status_aktif }}', room: '{{ addslashes($s->room ?? '') }}', generation: '{{ addslashes($s->generation ?? '') }}', universitas: '{{ addslashes($s->universitas ?? '') }}', angkatan: '{{ $s->angkatan ?? '' }}' }; editOpen = true"
                        class="bg-cyan-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                        Edit
                    </button>
                    <form action="{{ route('admin.santri.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus santri ini?');" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            <!-- Edit Modal -->
            <div x-show="editOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
                <div @click.away="editOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-md shadow-[8px_8px_0_0_#000] relative">
                    <button @click="editOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm hover:bg-red-500 shadow-[2px_2px_0_0_#000]">X</button>
                    <h2 class="text-2xl font-black mb-4 uppercase">Edit Santri</h2>
                    <form :action="`/admin/santri/${data.id}`" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Nama</label>
                            <input type="text" name="name" x-model="data.name" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Username</label>
                            <input type="text" name="username" x-model="data.username" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-black uppercase text-xs mb-1">Title</label>
                                <select name="title" x-model="data.title" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm">
                                    <option value="Santri">Santri</option>
                                    <option value="Musyrif">Musyrif</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-black uppercase text-xs mb-1">Status</label>
                                <select name="status_aktif" x-model="data.status_aktif" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Lulus">Lulus</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">🎓 Universitas</label>
                            <input type="text" name="universitas" x-model="data.universitas" list="existing-universities" placeholder="Nama universitas..." class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-black uppercase text-xs mb-1">📅 Thn Masuk Kuliah</label>
                                <input type="number" name="angkatan" x-model="data.angkatan" placeholder="mis. 2023" min="2000" max="2099" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm">
                            </div>
                            <div>
                                <label class="block font-black uppercase text-xs mb-1">Kamar</label>
                                <input type="text" name="room" x-model="data.room" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Angkatan Pondok</label>
                            <input type="text" name="generation" x-model="data.generation" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Password Baru (opsional)</label>
                            <input type="text" name="password" placeholder="Kosongkan jika tidak diubah" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm placeholder-gray-500">
                        </div>
                        <button type="submit" class="w-full bg-[#39FF14] text-black font-black py-3 rounded-lg border-4 border-black hover:bg-[#2ecc00] shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase mt-2">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-admin-layout>
