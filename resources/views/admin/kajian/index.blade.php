<x-admin-layout title="Kelola Kajian" active="kajian">

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

    <!-- Top Action bar -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-black text-xl uppercase text-black">Kajian Event (Sekali)</h3>
        <a href="{{ route('admin.kajian.create') }}" class="bg-[#39FF14] text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm flex items-center gap-2">
            <span class="material-symbols-outlined">add</span> TAMBAH KAJIAN
        </a>
    </div>

    <!-- Data List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($kajian as $k)
            @php
                $isPassed = $k->hasPassed();
                $quotaLeft = is_null($k->quota) ? 'Unlimited' : ($k->quota - $k->registrations_count);
            @endphp
            <div class="bg-white p-5 border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] flex flex-col justify-between hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[8px_8px_0_0_#000] transition-all">
                <div>
                    <!-- Status Badge -->
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex gap-2">
                            <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded {{ $isPassed ? 'bg-gray-200 text-gray-500' : 'bg-[#00E5FF] text-black' }}">
                                {{ $isPassed ? 'Selesai' : 'Mendatang' }}
                            </span>
                            @if($k->program)
                                <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-purple-100 text-purple-700">
                                    {{ $k->program->name }}
                                </span>
                            @endif
                        </div>
                        <span class="text-xs font-bold text-gray-500">
                            Kuota: {{ $k->registrations_count }} / {{ $k->quota ?? '∞' }} (Sisa: {{ $quotaLeft }})
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-black uppercase text-black line-clamp-1 mb-2">{{ $k->title }}</h3>

                    <!-- Lecturer / Ustadz -->
                    <div class="flex items-center gap-2 mb-3 bg-yellow-50 border-2 border-black p-2 rounded">
                        <span class="material-symbols-outlined text-sm">person</span>
                        <span class="text-xs font-black uppercase text-black">Ustadz: {{ $k->asatiz?->name }}</span>
                    </div>

                    <!-- Details -->
                    <div class="space-y-1.5 text-sm text-gray-700 font-bold mb-4">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">calendar_today</span>
                            <span>{{ $k->date->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">schedule</span>
                            <span>{{ substr($k->time, 0, 5) }} WIB</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">location_on</span>
                            <span>{{ $k->location }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="border-t-2 border-black pt-4 mt-2 flex justify-between items-center">
                    <a href="{{ route('admin.kajian.show', $k->id) }}" class="bg-[#FFDE00] text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] hover:translate-y-0.5 hover:shadow-none transition-all flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">group</span> Pendaftar
                    </a>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.kajian.edit', $k->id) }}" class="bg-cyan-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] hover:translate-y-0.5 hover:shadow-none transition-all">
                            Edit
                        </a>
                        <form action="{{ route('admin.kajian.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal kajian ini beserta semua data pendaftaran?');" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] hover:translate-y-0.5 hover:shadow-none transition-all">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-white border-4 border-black p-8 rounded-lg text-center text-gray-400 font-bold shadow-[4px_4px_0_0_#000]">
                Belum ada kajian yang dijadwalkan. Klik tombol di kanan atas untuk menjadwalkan kajian baru.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $kajian->links() }}
    </div>

</x-admin-layout>
