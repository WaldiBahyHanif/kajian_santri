<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-black dark:text-white uppercase tracking-tight">📝 Konfirmasi Izin Santri</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-4">
                Masuk sebagai musyrif: <span class="text-black dark:text-white">{{ auth()->user()->name }}</span>
            </p>

            @if(session('success'))
                <div class="bg-[#39FF14] border-4 border-black p-4 mb-5 font-black text-center shadow-[4px_4px_0_0_#000] rounded-lg text-black">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-zinc-800 border-4 border-black p-5 rounded-lg shadow-[6px_6px_0_0_#000] mb-5">
                <div class="mb-3">
                    <span class="text-xs font-black uppercase text-gray-500 dark:text-gray-400 block">Santri</span>
                    <span class="font-bold text-black dark:text-white">{{ $leave->student->name }}</span>
                </div>
                <div class="mb-3">
                    <span class="text-xs font-black uppercase text-gray-500 dark:text-gray-400 block">Tipe Pengajuan</span>
                    <span class="font-bold text-black dark:text-white">{{ $leave->type_label }}</span>
                </div>
                <div class="mb-3">
                    <span class="text-xs font-black uppercase text-gray-500 dark:text-gray-400 block">Tanggal</span>
                    <span class="font-bold text-black dark:text-white">
                        {{ $leave->start_date->translatedFormat('d M Y') }}
                        @if($leave->end_date != $leave->start_date)
                            s.d. {{ $leave->end_date->translatedFormat('d M Y') }}
                        @endif
                    </span>
                </div>
                <div class="mb-3">
                    <span class="text-xs font-black uppercase text-gray-500 dark:text-gray-400 block">Kegiatan</span>
                    <span class="font-bold text-black dark:text-white">{{ implode(', ', $leave->covered_sessions_labels) }}</span>
                </div>
                <div>
                    <span class="text-xs font-black uppercase text-gray-500 dark:text-gray-400 block">Alasan</span>
                    <span class="font-bold text-black dark:text-white">{{ $leave->reason }}</span>
                </div>
            </div>

            @if($leave->status === 'pending')
                <div class="flex flex-col gap-3">
                    <form method="POST" action="{{ route('izin.respond.approve', ['leave' => $leave->id, 'token' => request()->route('token')]) }}">
                        @csrf
                        <button type="submit" class="w-full bg-[#39FF14] text-black border-4 border-black py-3 font-black text-sm rounded-lg shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                            ✅ IZINKAN
                        </button>
                    </form>

                    <button type="button" onclick="document.getElementById('reject-form').classList.toggle('hidden')" class="w-full bg-red-400 text-black border-4 border-black py-3 font-black text-sm rounded-lg shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                        ❌ TOLAK
                    </button>

                    <form id="reject-form" method="POST" action="{{ route('izin.respond.reject', ['leave' => $leave->id, 'token' => request()->route('token')]) }}" class="hidden">
                        @csrf
                        <textarea name="rejection_reason" rows="2" placeholder="Alasan menolak (opsional)" class="w-full border-4 border-black rounded-lg px-3 py-2 text-sm font-bold mb-2 bg-white dark:bg-zinc-700 dark:text-white"></textarea>
                        <button type="submit" class="w-full bg-black text-white border-4 border-black py-2 font-black text-sm rounded-lg">
                            KIRIM PENOLAKAN
                        </button>
                    </form>
                </div>
            @elseif($leave->status === 'approved')
                <div class="bg-[#39FF14] border-4 border-black p-4 rounded-lg text-center font-black text-black">
                    ✅ Sudah Diizinkan
                    @if($leave->approverStudent)
                        <p class="font-normal text-sm mt-1">oleh {{ $leave->approverStudent->name }}</p>
                    @endif
                </div>
            @else
                <div class="bg-red-400 border-4 border-black p-4 rounded-lg text-center font-black text-black">
                    ❌ Sudah Ditolak
                    @if($leave->approverStudent)
                        <p class="font-normal text-sm mt-1">oleh {{ $leave->approverStudent->name }}</p>
                    @endif
                    @if($leave->rejection_reason)
                        <p class="font-normal text-sm mt-1">Alasan: {{ $leave->rejection_reason }}</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
