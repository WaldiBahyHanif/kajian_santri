<x-admin-layout title="Saran & Masukan" active="saran">

    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest">
            Daftar Saran & Masukan ({{ $suggestions->count() }})
        </div>

        @forelse($suggestions as $s)
        <div class="p-4 border-b-2 border-gray-200 hover:bg-yellow-50 transition-colors flex justify-between items-start gap-4">
            <div class="flex-1">
                <div class="bg-yellow-50 border-2 border-black rounded-lg p-3">
                    <p class="text-sm font-bold">{{ $s->message }}</p>
                </div>
                <div class="flex items-center gap-2 mt-1 ml-1 text-[10px] text-gray-500 font-bold uppercase">
                    <span>{{ $s->created_at?->translatedFormat('d M Y H:i') ?? '-' }}</span>
                    <span>•</span>
                    <span class="bg-violet-100 text-violet-800 px-1.5 py-0.5 rounded border border-violet-300">
                        ✍️ {{ $s->student->name ?? 'Sistem / Anonim' }} 
                        @if($s->student && $s->student->room)
                            ({{ $s->student->room }})
                        @endif
                    </span>
                </div>
            </div>
            <form action="{{ route('admin.saran.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus saran ini?');" class="shrink-0">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                    Hapus
                </button>
            </form>
        </div>
        @empty
        <div class="p-8 text-center text-gray-400 font-bold">Belum ada saran & masukan.</div>
        @endforelse
    </div>

</x-admin-layout>
