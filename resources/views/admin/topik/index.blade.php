<x-admin-layout title="Kajian Tetap (Rutin)" active="kajian">

    <!-- Tab Navigation -->
    <div class="flex flex-wrap gap-3 mb-6 border-b-4 border-black pb-3">
        <a href="{{ route('admin.topik.index') }}" class="px-5 py-2.5 font-black uppercase text-sm border-4 border-black rounded-lg transition-all {{ Request::routeIs('admin.topik.*') ? 'bg-[#FFDE00] text-black shadow-[2px_2px_0_0_#000]' : 'bg-white text-black hover:bg-gray-100' }}">
            📅 Kajian Tetap (Rutin)
        </a>
        <a href="{{ route('admin.kajian.index') }}" class="px-5 py-2.5 font-black uppercase text-sm border-4 border-black rounded-lg transition-all {{ Request::routeIs('admin.kajian.*') ? 'bg-[#FFDE00] text-black shadow-[2px_2px_0_0_#000]' : 'bg-white text-black hover:bg-gray-100' }}">
            📣 Kajian Event (Sekali)
        </a>
        <a href="{{ route('admin.program-kajian.index') }}" class="px-5 py-2.5 font-black uppercase text-sm border-4 border-black rounded-lg transition-all {{ Request::routeIs('admin.program-kajian.*') ? 'bg-[#FFDE00] text-black shadow-[2px_2px_0_0_#000]' : 'bg-white text-black hover:bg-gray-100' }}">
            ⚙️ Program Kajian
        </a>
        <a href="{{ route('admin.materi.index') }}" class="px-5 py-2.5 font-black uppercase text-sm border-4 border-black rounded-lg transition-all {{ Request::routeIs('admin.materi.*') ? 'bg-[#FFDE00] text-black shadow-[2px_2px_0_0_#000]' : 'bg-white text-black hover:bg-gray-100' }}">
            📚 Materi Kajian
        </a>
    </div>

    <!-- Form Tambah -->
    <div class="bg-white p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-6">
        <h3 class="font-black text-lg mb-4 uppercase flex items-center gap-2">
            <span class="material-symbols-outlined text-[#FF007F]">add_circle</span> Tambah Kajian Tetap (Rutin)
        </h3>
        <form action="{{ route('admin.topik.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-3 items-end">
            @csrf
            <div class="flex flex-col gap-1">
                <label class="block font-black uppercase text-xs text-black">Hari <span class="text-red-500">*</span></label>
                <select name="day_index" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
                    <option value="">-- Pilih Hari --</option>
                    <option value="1">Senin</option>
                    <option value="2">Selasa</option>
                    <option value="3">Rabu</option>
                    <option value="4">Kamis</option>
                    <option value="5">Jumat</option>
                    <option value="6">Sabtu</option>
                    <option value="7">Minggu</option>
                </select>
            </div>
            <div class="flex flex-col gap-1">
                <label class="block font-black uppercase text-xs text-black">Jam Mulai</label>
                <input type="time" name="start_time" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm">
            </div>
            <input type="text" name="title" placeholder="Judul Kajian Tetap" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
            <textarea name="description" placeholder="Deskripsi (opsional)" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" rows="1"></textarea>
            <select name="asatiz_id" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm">
                <option value="">-- Pilih Ustadz --</option>
                @foreach($asatiz as $a)
                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-black text-white px-4 font-black rounded-lg border-4 border-black hover:bg-[#FFDE00] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase py-2.5">
                Simpan
            </button>
        </form>
    </div>

    <!-- Data List -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest">
            Daftar Kajian Tetap / Rutin ({{ $topics->count() }})
        </div>

        @php
            $dayNames = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
            $todayDayIndex = \Carbon\Carbon::today()->dayOfWeekIso;
        @endphp

        <div x-data="{ editOpen: false, data: {} }">
            @forelse($topics->sortBy('day_index') as $t)
            <div class="p-4 border-b-2 border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 hover:bg-yellow-50 transition-colors">
                <div class="flex items-start gap-3 flex-1">
                    <div class="w-10 h-10 {{ $t->day_index == $todayDayIndex ? 'bg-[#FF007F]' : 'bg-gray-700' }} text-white rounded-lg border-2 border-black flex items-center justify-center font-black text-xs shrink-0 text-center leading-tight">
                        {{ substr($dayNames[$t->day_index] ?? '?', 0, 3) }}
                    </div>
                    <div>
                        <h3 class="font-black text-sm">{{ $t->title }}</h3>
                        <p class="text-xs text-gray-500 mt-0.5">{{ Str::limit($t->description, 80) }}</p>
                        <div class="flex flex-wrap gap-1.5 mt-1">
                            <span class="inline-block text-[10px] px-2 py-0.5 bg-blue-100 border-2 border-black rounded font-black">
                                {{ $dayNames[$t->day_index] ?? 'Hari ' . $t->day_index }}
                                @if($t->start_time)
                                    — {{ substr($t->start_time, 0, 5) }} WIB
                                @endif
                            </span>
                            <span class="inline-block text-[10px] px-2 py-0.5 bg-yellow-100 border-2 border-black rounded font-black">
                                {{ $t->asatiz?->name ?? 'Belum ada ustadz' }}
                            </span>
                            @if($t->day_index == $todayDayIndex)
                                <span class="inline-block text-[10px] px-2 py-0.5 bg-[#FF007F] text-white border-2 border-black rounded font-black">
                                    🔴 Hari Ini
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="button"
                        @click="data = { id: {{ $t->id }}, day_index: {{ $t->day_index }}, title: '{{ addslashes($t->title) }}', description: `{{ addslashes($t->description ?? '') }}`, asatiz_id: '{{ $t->asatiz_id ?? '' }}', start_time: '{{ $t->start_time ? substr($t->start_time, 0, 5) : '' }}' }; editOpen = true"
                        class="bg-cyan-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                        Edit
                    </button>
                    <form action="{{ route('admin.topik.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus kajian tetap ini?');" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400 font-bold">Belum ada kajian tetap/rutin. Klik "Tambah Kajian Tetap" di atas untuk menambahkan.</div>
            @endforelse

            <!-- Edit Modal -->
            <div x-show="editOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
                <div @click.away="editOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-lg shadow-[8px_8px_0_0_#000] relative">
                    <button @click="editOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm">X</button>
                    <h2 class="text-2xl font-black mb-4 uppercase">Edit Kajian Tetap</h2>
                    <form :action="`/admin/topik/${data.id}`" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-black uppercase text-xs mb-1">Hari Rutin</label>
                                <select name="day_index" x-model="data.day_index" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" required>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jumat</option>
                                    <option value="6">Sabtu</option>
                                    <option value="7">Minggu</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-black uppercase text-xs mb-1">Jam Mulai</label>
                                <input type="time" name="start_time" x-model="data.start_time" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Judul Kajian Tetap</label>
                            <input type="text" name="title" x-model="data.title" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" required>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Deskripsi</label>
                            <textarea name="description" x-model="data.description" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" rows="3"></textarea>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Ustadz Pengampu</label>
                            <select name="asatiz_id" x-model="data.asatiz_id" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm">
                                <option value="">-- Pilih Ustadz --</option>
                                @foreach($asatiz as $a)
                                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-[#39FF14] text-black font-black py-3 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
