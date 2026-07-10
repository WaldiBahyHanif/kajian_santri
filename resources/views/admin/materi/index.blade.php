<x-admin-layout title="Materi Kajian" active="materi">

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
            <span class="material-symbols-outlined text-[#39FF14]">add_to_photos</span> Tambah Materi
        </h3>
        <form action="{{ route('admin.materi.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @csrf
            <input type="text" name="title" placeholder="Judul Materi" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
            <input type="url" name="link_url" placeholder="Link URL (Google Drive, dll)" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
            <button type="submit" class="bg-black text-white px-4 font-black rounded-lg border-4 border-black hover:bg-[#39FF14] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase">
                Simpan
            </button>
        </form>
    </div>

    <!-- Data List -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest">
            Daftar Materi ({{ $materials->count() }})
        </div>

        <div x-data="{ editOpen: false, data: {} }">
            @forelse($materials as $m)
            <div class="p-4 border-b-2 border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 hover:bg-yellow-50 transition-colors">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <span class="material-symbols-outlined text-[#39FF14] text-2xl shrink-0">description</span>
                    <div class="min-w-0">
                        <h3 class="font-black text-sm truncate">{{ $m->title }}</h3>
                        <a href="{{ $m->link_url }}" target="_blank" class="text-xs text-blue-600 hover:underline truncate block">{{ Str::limit($m->link_url, 60) }}</a>
                    </div>
                </div>
                <div class="flex gap-2 shrink-0">
                    <button type="button"
                        @click="data = { id: {{ $m->id }}, title: '{{ addslashes($m->title) }}', link_url: '{{ addslashes($m->link_url) }}' }; editOpen = true"
                        class="bg-cyan-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                        Edit
                    </button>
                    <form action="{{ route('admin.materi.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?');" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400 font-bold">Belum ada materi kajian.</div>
            @endforelse

            <!-- Edit Modal -->
            <div x-show="editOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
                <div @click.away="editOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-md shadow-[8px_8px_0_0_#000] relative">
                    <button @click="editOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm">X</button>
                    <h2 class="text-2xl font-black mb-4 uppercase">Edit Materi</h2>
                    <form :action="`/admin/materi/${data.id}`" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Judul</label>
                            <input type="text" name="title" x-model="data.title" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" required>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Link URL</label>
                            <input type="url" name="link_url" x-model="data.link_url" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" required>
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
