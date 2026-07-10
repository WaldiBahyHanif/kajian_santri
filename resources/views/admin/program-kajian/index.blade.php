<x-admin-layout title="Kelola Program Kajian" active="program-kajian">

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
            <span class="material-symbols-outlined text-[#39FF14]">add_circle</span> Tambah Program Kajian
        </h3>
        <form action="{{ route('admin.program-kajian.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
            @csrf
            <div class="flex flex-col gap-1">
                <label class="block font-black uppercase text-xs text-black">Nama Program <span class="text-red-500">*</span></label>
                <input type="text" name="name" placeholder="Contoh: Kajian Kitab, Kajian Akhlak" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
            </div>
            <div class="flex flex-col gap-1 md:col-span-2">
                <label class="block font-black uppercase text-xs text-black">Deskripsi (Opsional)</label>
                <div class="flex gap-3">
                    <input type="text" name="description" placeholder="Informasi singkat tentang program kajian ini..." class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm flex-1">
                    <button type="submit" class="bg-black text-white px-6 font-black rounded-lg border-4 border-black hover:bg-[#39FF14] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase shrink-0">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Data List -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest">
            Daftar Program Kajian ({{ $programs->count() }})
        </div>

        <div x-data="{ editOpen: false, data: {} }">
            @forelse($programs as $p)
            <div class="p-4 border-b-2 border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 hover:bg-yellow-50 transition-colors">
                <div class="flex items-start gap-3 flex-1">
                    <div class="w-10 h-10 bg-[#39FF14] text-black rounded-lg border-2 border-black flex items-center justify-center font-black text-lg shrink-0">
                        P
                    </div>
                    <div>
                        <h3 class="font-black text-sm uppercase">{{ $p->name }}</h3>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $p->description ?? 'Tidak ada deskripsi.' }}</p>
                        <span class="inline-block text-[10px] px-2 py-0.5 bg-yellow-100 border-2 border-black rounded font-black mt-1">
                            {{ $p->kajians_count }} Kajian Terjadwal
                        </span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="button"
                        @click="data = { id: {{ $p->id }}, name: '{{ addslashes($p->name) }}', description: `{{ addslashes($p->description ?? '') }}` }; editOpen = true"
                        class="bg-cyan-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                        Edit
                    </button>
                    <form action="{{ route('admin.program-kajian.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus program kajian ini?');" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400 font-bold">Belum ada program kajian.</div>
            @endforelse

            <!-- Edit Modal -->
            <div x-show="editOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
                <div @click.away="editOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-md shadow-[8px_8px_0_0_#000] relative">
                    <button @click="editOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm">X</button>
                    <h2 class="text-2xl font-black mb-4 uppercase">Edit Program Kajian</h2>
                    <form :action="`/admin/program-kajian/${data.id}`" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Nama Program</label>
                            <input type="text" name="name" x-model="data.name" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" required>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Deskripsi</label>
                            <textarea name="description" x-model="data.description" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" rows="3"></textarea>
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
