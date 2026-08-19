<!-- Santri Istiqomah Leaderboard (Playful Neobrutalism) -->
<div class="bg-[#FDA4AF] dark:bg-rose-950/80 border-3 border-black dark:border-white shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] dark:shadow-[5px_5px_0px_0px_rgba(255,255,255,1)] rounded-3xl p-6 space-y-4">
    <div class="flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl border-3 border-black bg-[#FDE047] text-black flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] font-black text-2xl">
                🔥
            </div>
            <div>
                <h3 class="text-xl font-black text-black dark:text-white tracking-tight">Santri Ter-Istiqomah</h3>
                <p class="text-xs font-bold text-rose-950 dark:text-rose-200">Peringkat streak presensi terbanyak</p>
            </div>
        </div>
    </div>

    <!-- Top 3 Streaks List Kartun -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
        @forelse($topStreaks->take(3) as $index => $santri)
            @php
                $bgColors = ['bg-[#FDE047]', 'bg-[#86EFAC]', 'bg-[#D8B4FE]'];
                $cardBg = $bgColors[$index % 3];
            @endphp
            <div class="{{ $cardBg }} dark:bg-zinc-900 border-3 border-black dark:border-white rounded-2xl p-4 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl border-2 border-black bg-white text-black flex items-center justify-center font-black text-base shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    #{{ $index + 1 }}
                </div>
                
                <div class="min-w-0 flex-1">
                    <p class="font-black text-sm text-black dark:text-white truncate" title="{{ $santri->name }}">
                        {{ $santri->name }}
                    </p>
                    <p class="text-xs font-black text-rose-950 dark:text-rose-200">
                        🔥 {{ $santri->current_streak }} Hari Beruntun
                    </p>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white dark:bg-zinc-900 border-3 border-black dark:border-white rounded-2xl p-4 text-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-xs font-black text-zinc-500">Belum ada data streak santri. ⚡</p>
            </div>
        @endforelse
    </div>
</div>
