<x-admin-layout title="Mitsur Pairs" active="mitsur">

    <!-- Form Tambah Pasangan -->
    <div class="bg-white p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-6">
        <h3 class="font-black text-lg mb-4 uppercase flex items-center gap-2">
            <span class="material-symbols-outlined text-[#FF007F]">group_add</span> Buat Pasangan Mitsur
        </h3>
        <form action="{{ route('admin.mitsur.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @csrf
            <select name="student_id_1" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
                <option value="">-- Santri 1 --</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>
            <select name="student_id_2" class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
                <option value="">-- Santri 2 --</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-black text-white px-4 font-black rounded-lg border-4 border-black hover:bg-[#FF007F] shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase">
                Pasangkan
            </button>
        </form>
    </div>

    <!-- Data List -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest">
            Daftar Pasangan Mitsur ({{ $pairs->count() }})
        </div>

        @forelse($pairs as $p)
        <div class="p-4 border-b-2 border-gray-200 flex flex-col md:flex-row justify-between items-center gap-3 hover:bg-yellow-50 transition-colors">
            <div class="flex items-center gap-4">
                <div class="text-center">
                    <div class="w-10 h-10 bg-[#00E5FF] rounded-full border-2 border-black flex items-center justify-center font-black text-xs">
                        {{ strtoupper(substr($p->student1?->name ?? '?', 0, 1)) }}
                    </div>
                    <p class="text-[10px] font-bold mt-1 max-w-[80px] truncate">{{ $p->student1?->name ?? 'Dihapus' }}</p>
                </div>
                <div class="flex flex-col items-center">
                    <span class="material-symbols-outlined text-[#FF007F] text-2xl">handshake</span>
                    <span class="text-[10px] font-black bg-[#FFDE00] border-2 border-black px-2 py-0.5 rounded">Streak: {{ $p->current_pair_streak ?? 0 }}</span>
                </div>
                <div class="text-center">
                    <div class="w-10 h-10 bg-[#39FF14] rounded-full border-2 border-black flex items-center justify-center font-black text-xs">
                        {{ strtoupper(substr($p->student2?->name ?? '?', 0, 1)) }}
                    </div>
                    <p class="text-[10px] font-bold mt-1 max-w-[80px] truncate">{{ $p->student2?->name ?? 'Dihapus' }}</p>
                </div>
            </div>
            <form action="{{ route('admin.mitsur.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus pasangan mitsur ini?');">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                    Hapus
                </button>
            </form>
        </div>
        @empty
        <div class="p-8 text-center text-gray-400 font-bold">Belum ada pasangan mitsur.</div>
        @endforelse
    </div>

</x-admin-layout>
