<x-admin-layout title="Refleksi Santri" active="refleksi">

    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest flex justify-between items-center">
            <span>Daftar Refleksi ({{ $reflections->count() }})</span>
        </div>

        @forelse($reflections as $r)
        <div class="p-4 border-b-2 border-gray-200 hover:bg-yellow-50 transition-colors">
            <div class="flex justify-between items-start gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-[#00E5FF] rounded-full border-2 border-black flex items-center justify-center font-black text-xs">
                            {{ strtoupper(substr($r->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-black text-sm">{{ $r->name }}</h3>
                            <p class="text-[10px] text-gray-400">{{ $r->created_at?->diffForHumans() }}</p>
                        </div>
                        @if($r->topic)
                            <span class="ml-1 bg-yellow-200 border-2 border-black rounded-md px-2 py-0.5 text-[10px] font-black uppercase">{{ $r->topic->title }}</span>
                        @endif
                    </div>
                    <div class="bg-gray-50 border-2 border-black rounded-lg p-3 ml-10">
                        <p class="text-sm">{{ $r->content }}</p>
                    </div>
                </div>
                <form action="{{ route('admin.refleksi.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Hapus refleksi ini?');" class="shrink-0">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-400 font-bold">Belum ada refleksi dari santri.</div>
        @endforelse
    </div>

</x-admin-layout>
