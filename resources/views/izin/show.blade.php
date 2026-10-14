<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-black dark:text-white uppercase tracking-tight">📝 Detail Pengajuan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] overflow-hidden">
                <!-- Header -->
                <div class="bg-black text-white p-4 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined">assignment</span>
                        <span class="font-black uppercase text-sm">Detail Pengajuan</span>
                    </div>
                    <span class="text-xs font-black uppercase border-2 border-white px-2 py-0.5 rounded {{ $leave->status === 'pending' ? 'bg-[#FFDE00] text-black border-black' : ($leave->status === 'approved' ? 'bg-[#39FF14] text-black border-black' : 'bg-red-400 text-black border-black') }}">
                        {{ $leave->status_label }}
                    </span>
                </div>

                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-black uppercase text-gray-500 mb-1">Tipe</p>
                            <p class="font-bold text-black dark:text-white text-lg">{{ $leave->type_label }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-black uppercase text-gray-500 mb-1">Tanggal Pengajuan</p>
                            <p class="font-bold text-black dark:text-white">{{ $leave->created_at->translatedFormat('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-black uppercase text-gray-500 mb-1">Tanggal Mulai</p>
                            <p class="font-bold text-black dark:text-white">{{ $leave->start_date->translatedFormat('l, d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-black uppercase text-gray-500 mb-1">Tanggal Selesai</p>
                            <p class="font-bold text-black dark:text-white">{{ $leave->end_date->translatedFormat('l, d M Y') }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs font-black uppercase text-gray-500 mb-1">Alasan</p>
                        <div class="bg-gray-50 dark:bg-zinc-700 border-2 border-black rounded-lg p-3">
                            <p class="font-bold text-black dark:text-white">{{ $leave->reason }}</p>
                        </div>
                    </div>

                    @if($leave->notes)
                    <div>
                        <p class="text-xs font-black uppercase text-gray-500 mb-1">Catatan Tambahan</p>
                        <div class="bg-gray-50 dark:bg-zinc-700 border-2 border-black rounded-lg p-3">
                            <p class="font-bold text-black dark:text-white">{{ $leave->notes }}</p>
                        </div>
                    </div>
                    @endif

                    <div>
                        <p class="text-xs font-black uppercase text-gray-500 mb-1">Kegiatan yang Dilingkupi</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($leave->covered_sessions_labels as $label)
                                <span class="text-xs font-black uppercase border-2 border-black px-3 py-1.5 rounded bg-zinc-100 dark:bg-zinc-700 text-black dark:text-white shadow-[2px_2px_0_0_#000]">
                                    {{ $label }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    @if($leave->status === 'approved' && ($leave->approver || $leave->approverStudent))
                    <div class="bg-[#39FF14] bg-opacity-20 border-2 border-black rounded-lg p-4">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#39FF14]">check_circle</span>
                            <p class="font-black text-sm text-black dark:text-white">
                                Disetujui oleh {{ $leave->approverStudent->name ?? $leave->approver->name }} pada {{ $leave->approved_at->translatedFormat('d M Y H:i') }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($leave->status === 'rejected')
                    <div class="bg-red-100 border-2 border-red-400 rounded-lg p-4">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-red-600">cancel</span>
                            <div>
                                <p class="font-black text-sm text-red-700">Ditolak</p>
                                @if($leave->rejection_reason)
                                    <p class="text-sm text-red-600 mt-1">{{ $leave->rejection_reason }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="border-t-4 border-black p-4 bg-gray-50 dark:bg-zinc-900">
                    <a href="{{ route('izin.index') }}" class="inline-flex items-center gap-1 text-sm font-bold text-[#FF007F] hover:underline">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Kembali ke daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>