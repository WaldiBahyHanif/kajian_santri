<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-black dark:text-white uppercase tracking-tight">📝 Izin Saya</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-[#39FF14] border-4 border-black p-4 mb-6 font-black text-center shadow-[4px_4px_0_0_#000] rounded-lg text-black">
                    <div class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span>
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-400 border-4 border-black p-4 mb-6 font-black text-center shadow-[4px_4px_0_0_#000] rounded-lg text-black">
                    <div class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Action Bar -->
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm font-bold text-gray-500">Riwayat pengajuan izin</p>
                <a href="{{ route('izin.create') }}" class="bg-[#FF007F] text-white border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined">add</span> AJUKAN BARU
                </a>
            </div>

            <!-- Data -->
            @if($leaves->count() > 0)
                <div class="bg-white dark:bg-zinc-800 border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-black text-white font-black text-xs uppercase">
                                <tr>
                                    <th class="text-left px-4 py-3">Tipe</th>
                                    <th class="text-left px-4 py-3">Tanggal</th>
                                    <th class="text-left px-4 py-3">Alasan</th>
                                    <th class="text-center px-4 py-3">Status</th>
                                    <th class="text-center px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y-2 divide-black">
                                @foreach($leaves as $leave)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                                        <td class="px-4 py-3">
                                            <span class="font-black uppercase text-xs border-2 border-black px-2 py-0.5 rounded {{ $leave->type === 'sakit' ? 'bg-red-100 text-red-700' : ($leave->type === 'cuti' ? 'bg-purple-100 text-purple-700' : ($leave->type === 'pengajian' ? 'bg-teal-100 text-teal-700' : 'bg-blue-100 text-blue-700')) }}">
                                                {{ $leave->type_label }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 font-bold text-black dark:text-white">
                                            {{ $leave->start_date->translatedFormat('d M Y') }}
                                            @if($leave->end_date != $leave->start_date)
                                                <br><span class="text-xs text-gray-500">s/d {{ $leave->end_date->translatedFormat('d M Y') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300 max-w-xs">
                                            <div class="font-bold text-black dark:text-white mb-1">{{ $leave->reason }}</div>
                                            <div class="text-[10px] text-gray-500 font-black uppercase mt-1">Kegiatan:</div>
                                            <div class="text-xs text-gray-600 dark:text-gray-400 font-bold">
                                                {{ implode(', ', $leave->covered_sessions_labels) }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @if($leave->status === 'pending')
                                                <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#FFDE00] text-black">
                                                    Pending
                                                </span>
                                            @elseif($leave->status === 'approved')
                                                <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#39FF14] text-black">
                                                    Disetujui
                                                </span>
                                            @else
                                                <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-red-400 text-black">
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('izin.show', $leave->id) }}" class="text-xs font-bold text-[#FF007F] hover:underline">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $leaves->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-zinc-800 border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] p-12 text-center">
                    <span class="material-symbols-outlined text-5xl text-gray-300 mb-3">assignment</span>
                    <p class="text-gray-400 font-bold italic">Belum ada pengajuan izin.</p>
                    <a href="{{ route('izin.create') }}" class="inline-block mt-4 bg-[#FF007F] text-white border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm">
                        AJUKAN SEKARANG
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>