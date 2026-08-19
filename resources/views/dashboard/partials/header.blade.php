<!-- Header Dashboard Neobrutalism -->
<div class="bg-[#E6F4EA] dark:bg-[#064e3b]/30 border-2 border-black dark:border-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] rounded-2xl p-5 md:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
    <div class="space-y-1">
        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-zinc-800 border-2 border-black dark:border-white rounded-full text-xs font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)] text-emerald-800 dark:text-emerald-300">
            <span class="material-symbols-outlined text-sm">today</span>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
        <h1 class="font-headline-md text-2xl md:text-3xl font-black text-black dark:text-white tracking-tight">
            Assalamu'alaikum, {{ $user->name }}! 👋
        </h1>
        <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
            Selamat datang di Dashboard Santri Daaru Hiraa. Mari jaga keistiqomahan hari ini!
        </p>
    </div>

    <div class="flex items-center gap-3">
        <!-- Badge Kebun Santri -->
        <div class="bg-white dark:bg-zinc-900 border-2 border-black dark:border-white shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] dark:shadow-[3px_3px_0px_0px_rgba(255,255,255,1)] rounded-xl px-4 py-2.5 flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg border-2 border-black dark:border-white bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center text-emerald-700 dark:text-emerald-300 flex-shrink-0">
                <span class="material-symbols-outlined text-xl">eco</span>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Kebun Santri</p>
                <p class="text-xs font-extrabold text-black dark:text-white capitalize">
                    @if(($setting->garden_status ?? 'subur') === 'subur_sekali')
                        🌸 Subur Sekali
                    @elseif(($setting->garden_status ?? 'subur') === 'subur')
                        🌿 Subur
                    @elseif(($setting->garden_status ?? 'subur') === 'biasa')
                        🌱 Biasa
                    @else
                        🍂 Kering
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
