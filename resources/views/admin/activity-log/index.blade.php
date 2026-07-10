<x-admin-layout title="Log Aktivitas Admin" active="activity-log">

    <!-- Data Table -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest flex justify-between items-center">
            <span>Riwayat Aktivitas Admin ({{ $logs->total() }})</span>
        </div>

        <!-- Table Header -->
        <div class="hidden md:grid grid-cols-12 gap-2 p-3 bg-gray-100 border-b-4 border-black text-xs font-black uppercase">
            <span class="col-span-2">Waktu</span>
            <span class="col-span-2">Admin</span>
            <span class="col-span-2">Tindakan</span>
            <span class="col-span-4">Detail Keterangan</span>
            <span class="col-span-2 text-right">IP Address</span>
        </div>

        <div class="divide-y-2 divide-gray-200">
            @forelse($logs as $log)
            <div class="p-3 grid grid-cols-1 md:grid-cols-12 gap-2 items-center hover:bg-yellow-50 transition-colors text-sm">
                <!-- Waktu -->
                <div class="col-span-2 font-bold text-gray-600">
                    {{ $log->created_at->translatedFormat('d M Y, H:i:s') }}
                </div>
                
                <!-- Admin -->
                <div class="col-span-2 font-black text-black">
                    <span class="bg-yellow-100 border border-black px-2 py-0.5 rounded text-xs">
                        {{ $log->admin?->username ?? 'System' }}
                    </span>
                </div>
                
                <!-- Tindakan -->
                <div class="col-span-2 font-black uppercase text-xs">
                    <span class="px-2 py-0.5 border-2 border-black rounded 
                        {{ str_contains($log->action, 'delete') || str_contains($log->action, 'purge') ? 'bg-red-300 text-black' : '' }}
                        {{ str_contains($log->action, 'create') || str_contains($log->action, 'store') ? 'bg-green-300 text-black' : '' }}
                        {{ str_contains($log->action, 'update') || str_contains($log->action, 'edit') ? 'bg-cyan-300 text-black' : '' }}
                        {{ str_contains($log->action, 'rollover') ? 'bg-purple-300 text-black' : '' }}
                        {{ !str_contains($log->action, 'delete') && !str_contains($log->action, 'purge') && !str_contains($log->action, 'create') && !str_contains($log->action, 'store') && !str_contains($log->action, 'update') && !str_contains($log->action, 'edit') && !str_contains($log->action, 'rollover') ? 'bg-blue-300 text-black' : '' }}
                    ">
                        {{ str_replace('_', ' ', $log->action) }}
                    </span>
                </div>
                
                <!-- Detail Keterangan -->
                <div class="col-span-4 font-bold text-gray-800">
                    {{ $log->description }}
                </div>
                
                <!-- IP Address -->
                <div class="col-span-2 text-right font-mono text-xs text-gray-500">
                    {{ $log->ip_address }}
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400 font-bold italic">Belum ada riwayat aktivitas admin.</div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $logs->links() }}
    </div>

</x-admin-layout>
