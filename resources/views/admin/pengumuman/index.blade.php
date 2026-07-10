<x-admin-layout title="Pengumuman" active="pengumuman">

    <!-- Form Tambah -->
    <div class="bg-white p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-6">
        <h3 class="font-black text-lg mb-4 uppercase flex items-center gap-2">
            <span class="material-symbols-outlined text-[#FFDE00]">campaign</span> Buat Pengumuman
        </h3>
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="space-y-3">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <textarea name="message" placeholder="Isi pengumuman..." class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm md:col-span-2" rows="3" required></textarea>
                <select name="target_student_id" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm">
                    <option value="">-- Untuk Semua Santri --</option>
                    @foreach($students as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 border-2 border-black rounded">
                        <span class="font-black text-sm uppercase">Aktif</span>
                    </label>
                    <button type="submit" class="bg-black text-white px-6 font-black rounded-lg border-4 border-black hover:bg-[#FFDE00] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase ml-auto">
                        Kirim
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Data List -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest">
            Daftar Pengumuman ({{ $announcements->count() }})
        </div>

        <div x-data="{ editOpen: false, data: {} }">
            @forelse($announcements as $a)
            <div class="p-4 border-b-2 border-gray-200 hover:bg-yellow-50 transition-colors">
                <div class="flex justify-between items-start gap-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[10px] px-2 py-0.5 rounded border-2 border-black font-black {{ $a->is_active ? 'bg-[#39FF14]' : 'bg-gray-300' }}">
                                {{ $a->is_active ? 'AKTIF' : 'NONAKTIF' }}
                            </span>
                            <span class="text-[10px] text-gray-400">{{ $a->created_at?->diffForHumans() }}</span>
                            <span class="text-[10px] px-2 py-0.5 bg-blue-100 border-2 border-black rounded font-black">
                                {{ $a->student?->name ?? 'Semua Santri' }}
                            </span>
                        </div>
                        <p class="text-sm font-bold">{{ $a->message }}</p>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <button type="button"
                            @click="data = { id: {{ $a->id }}, message: `{{ addslashes($a->message) }}`, target_student_id: '{{ $a->target_student_id ?? '' }}', is_active: {{ $a->is_active ? 'true' : 'false' }} }; editOpen = true"
                            class="bg-cyan-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                            Edit
                        </button>
                        <form action="{{ route('admin.pengumuman.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?');" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400 font-bold">Belum ada pengumuman.</div>
            @endforelse

            <!-- Edit Modal -->
            <div x-show="editOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
                <div @click.away="editOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-md shadow-[8px_8px_0_0_#000] relative">
                    <button @click="editOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm">X</button>
                    <h2 class="text-2xl font-black mb-4 uppercase">Edit Pengumuman</h2>
                    <form :action="`/admin/pengumuman/${data.id}`" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Isi Pengumuman</label>
                            <textarea name="message" x-model="data.message" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" rows="4" required></textarea>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Target Santri</label>
                            <select name="target_student_id" x-model="data.target_student_id" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm">
                                <option value="">-- Semua Santri --</option>
                                @foreach($students as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="hidden" name="is_active" value="0">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" :checked="data.is_active" class="w-5 h-5 border-2 border-black rounded">
                                <span class="font-black text-sm uppercase">Aktif</span>
                            </label>
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
