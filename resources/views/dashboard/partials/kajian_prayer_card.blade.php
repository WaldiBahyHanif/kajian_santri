<!-- Widget Jadwal Kajian & Waktu Sholat Maguwoharjo, Sleman (Soft Cartoon Neobrutalism Berwarna) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Sub-card A: Waktu Sholat Maguwoharjo, Sleman (Sky Blue Container) -->
    <div style="background-color: #bae6fd;" class="dark:bg-sky-950/80 border-3 border-black dark:border-white shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] dark:shadow-[5px_5px_0px_0px_rgba(255,255,255,1)] rounded-3xl p-6 space-y-4">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div style="background-color: #fef08a;" class="w-12 h-12 rounded-2xl border-3 border-black text-black flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] shrink-0">
                    <span class="material-symbols-outlined text-2xl text-black">mosque</span>
                </div>
                <div>
                    <h3 class="text-xl font-black text-black dark:text-white tracking-tight">Waktu Sholat Hari Ini</h3>
                    <p class="text-xs font-bold text-sky-950 dark:text-sky-200">📍 {{ $prayerTimes->location ?? 'Maguwoharjo, Sleman, DIY' }}</p>
                </div>
            </div>

            <span style="background-color: #a7f3d0;" class="px-3 py-1.5 text-emerald-950 border-2 border-black rounded-xl text-xs font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                WIB
            </span>
        </div>

        <!-- Grid 6 Waktu Sholat Kartun Berwarna Soft -->
        <div class="grid grid-cols-3 gap-2.5 pt-1">
            <!-- Subuh -->
            <div style="background-color: #e0f2fe;" class="dark:bg-zinc-900 border-2 border-black dark:border-white rounded-2xl p-2.5 text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-[10px] font-black text-sky-950 dark:text-sky-300 uppercase">Subuh</p>
                <p class="text-base font-black text-black dark:text-white font-mono mt-0.5">{{ $prayerTimes->Fajr ?? '04:35' }}</p>
            </div>

            <!-- Terbit / Syuruq -->
            <div style="background-color: #fef08a;" class="dark:bg-zinc-900 border-2 border-black dark:border-white rounded-2xl p-2.5 text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-[10px] font-black text-amber-950 dark:text-amber-300 uppercase">Syuruq</p>
                <p class="text-base font-black text-amber-900 dark:text-amber-200 font-mono mt-0.5">{{ $prayerTimes->Sunrise ?? '05:48' }}</p>
            </div>

            <!-- Dzuhur -->
            <div style="background-color: #fbcfe8;" class="dark:bg-zinc-900 border-2 border-black dark:border-white rounded-2xl p-2.5 text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-[10px] font-black text-rose-950 dark:text-rose-300 uppercase">Dzuhur</p>
                <p class="text-base font-black text-black dark:text-white font-mono mt-0.5">{{ $prayerTimes->Dhuhr ?? '11:52' }}</p>
            </div>

            <!-- Ashar -->
            <div style="background-color: #ffedd5;" class="dark:bg-zinc-900 border-2 border-black dark:border-white rounded-2xl p-2.5 text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-[10px] font-black text-orange-950 dark:text-orange-300 uppercase">Ashar</p>
                <p class="text-base font-black text-black dark:text-white font-mono mt-0.5">{{ $prayerTimes->Asr ?? '15:12' }}</p>
            </div>

            <!-- Maghrib -->
            <div style="background-color: #f3e8ff;" class="dark:bg-zinc-900 border-2 border-black dark:border-white rounded-2xl p-2.5 text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-[10px] font-black text-purple-950 dark:text-purple-300 uppercase">Maghrib</p>
                <p class="text-base font-black text-black dark:text-white font-mono mt-0.5">{{ $prayerTimes->Maghrib ?? '17:50' }}</p>
            </div>

            <!-- Isya -->
            <div style="background-color: #dcfce7;" class="dark:bg-zinc-900 border-2 border-black dark:border-white rounded-2xl p-2.5 text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <p class="text-[10px] font-black text-emerald-950 dark:text-emerald-300 uppercase">Isya</p>
                <p class="text-base font-black text-black dark:text-white font-mono mt-0.5">{{ $prayerTimes->Isha ?? '19:00' }}</p>
            </div>
        </div>

        <p class="text-[11px] text-sky-950 dark:text-sky-200 font-bold italic text-center">
            *Jadwal sholat otomatis disesuaikan untuk wilayah Daaru Hiraa Maguwoharjo, Sleman.
        </p>
    </div>

    <!-- Sub-card B: Jadwal Kajian Terdekat & Countdown (Lilac Container) -->
    <div style="background-color: #e9d5ff;" class="dark:bg-purple-950/80 border-3 border-black dark:border-white shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] dark:shadow-[5px_5px_0px_0px_rgba(255,255,255,1)] rounded-3xl p-6 space-y-4">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div style="background-color: #fbcfe8;" class="w-12 h-12 rounded-2xl border-3 border-black text-black flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] shrink-0">
                    <span class="material-symbols-outlined text-2xl text-black">menu_book</span>
                </div>
                <div>
                    <h3 class="text-xl font-black text-black dark:text-white tracking-tight">Kajian Terdekat</h3>
                    <p class="text-xs font-bold text-purple-950 dark:text-purple-200">Agenda majelis ilmu pondok</p>
                </div>
            </div>

            <a href="{{ route('kajian') }}" style="background-color: #fef08a;" class="px-3.5 py-1.5 hover:bg-yellow-300 text-black border-2 border-black rounded-xl text-xs font-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[-2px] active:scale-95 transition-all cursor-pointer">
                Lihat Semua
            </a>
        </div>

        <!-- Kajian List Kartun Berwarna Soft -->
        <div class="space-y-3">
            @forelse($nextKajians->take(2) as $kajian)
                <div style="background-color: #ffffff;" class="dark:bg-zinc-900 border-3 border-black dark:border-white rounded-2xl p-4 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex items-start justify-between gap-3">
                    <div class="space-y-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span style="background-color: #a7f3d0;" class="px-2.5 py-0.5 text-black border-2 border-black rounded-lg text-[10px] font-black uppercase">
                                {{ $kajian->is_routine ? 'Rutin' : 'Tematik' }}
                            </span>
                            <span class="text-xs font-bold text-zinc-600 dark:text-zinc-400">
                                {{ \Carbon\Carbon::parse($kajian->date)->translatedFormat('D, d M') }} • {{ substr($kajian->time, 0, 5) }} WIB
                            </span>
                        </div>
                        <h4 class="font-black text-base text-black dark:text-white truncate" title="{{ $kajian->title }}">
                            {{ $kajian->title }}
                        </h4>
                        <p class="text-xs font-bold text-purple-900 dark:text-purple-300">
                            🎙️ {{ data_get($kajian->asatiz, 'name', 'Ustadz Pondok') }}
                        </p>
                    </div>

                    <div class="shrink-0 text-right">
                        <span style="background-color: #bae6fd;" class="px-3 py-1 text-black border-2 border-black rounded-xl text-xs font-black inline-block shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            📍 {{ $kajian->location ?? 'Aula Utama' }}
                        </span>
                    </div>
                </div>
            @empty
                <div style="background-color: #ffffff;" class="dark:bg-zinc-900 border-3 border-black dark:border-white rounded-2xl p-4 text-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                    <p class="text-xs font-black text-zinc-500 dark:text-zinc-400">Belum ada agenda kajian terdekat hari ini. 📚</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
