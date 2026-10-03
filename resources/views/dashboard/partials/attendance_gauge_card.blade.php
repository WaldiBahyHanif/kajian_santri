<!-- Widget Persentase Kehadiran Kajian Hari Ini (Soft Cartoon Neobrutalism) -->
<div style="background-color: #fef08a;" class="border-3 border-black dark:border-white shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] dark:shadow-[5px_5px_0px_0px_rgba(255,255,255,1)] rounded-3xl p-6 md:p-7 space-y-6">
    
    <!-- Top Header Widget -->
    <div class="flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div style="background-color: #a7f3d0;" class="w-12 h-12 rounded-2xl border-3 border-black text-black flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] shrink-0">
                <span class="material-symbols-outlined text-2xl text-black">how_to_reg</span>
            </div>
            <div>
                <h2 class="text-xl font-black text-black dark:text-white tracking-tight">Presensi Kajian Hari Ini</h2>
                <p class="text-xs font-bold text-amber-950 dark:text-amber-200">Metrik kehadiran santri vs total santri aktif</p>
            </div>
        </div>

        <span style="background-color: #fbcfe8;" class="px-3.5 py-1.5 text-rose-950 border-2 border-black rounded-xl text-xs font-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] uppercase">
            {{ \Carbon\Carbon::now()->format('d M Y') }}
        </span>
    </div>

    <!-- Layout Tengah: Gauge Ring SVG & Info Metrik -->
    <div style="background-color: #ffffff;" class="dark:bg-zinc-900 border-3 border-black dark:border-white rounded-2xl p-5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col sm:flex-row items-center justify-around gap-6">
        
        <!-- SVG Circular Gauge Ring Kartun -->
        <div class="relative w-36 h-36 shrink-0 flex items-center justify-center">
            @php
                $pct = min(100, max(0, $attendanceStats->percentage ?? 0));
                $radius = 42;
                $circumference = 2 * M_PI * $radius; // ~263.89
                $strokeDashoffset = $circumference - ($pct / 100) * $circumference;
            @endphp
            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                <!-- Background Ring Grey -->
                <circle 
                    cx="50" cy="50" r="{{ $radius }}" 
                    fill="none" 
                    stroke="#E5E7EB" 
                    stroke-width="11"
                />
                <!-- Progress Ring Soft Green -->
                <circle 
                    cx="50" cy="50" r="{{ $radius }}" 
                    fill="none" 
                    stroke="#10B981" 
                    stroke-width="11"
                    stroke-linecap="round"
                    stroke-dasharray="{{ $circumference }}"
                    stroke-dashoffset="{{ $strokeDashoffset }}"
                    class="transition-all duration-1000 ease-out"
                />
                <!-- Inner & Outer Borders -->
                <circle 
                    cx="50" cy="50" r="{{ $radius + 5.5 }}" 
                    fill="none" 
                    stroke="#000" 
                    stroke-width="2.5"
                />
                <circle 
                    cx="50" cy="50" r="{{ $radius - 5.5 }}" 
                    fill="none" 
                    stroke="#000" 
                    stroke-width="2.5"
                />
            </svg>
            
            <!-- Teks Persentase di Tengah Ring -->
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center pointer-events-none">
                <span class="text-3xl font-black font-mono text-black dark:text-white leading-none">
                    {{ $pct }}%
                </span>
                <span class="text-[10px] font-black uppercase text-zinc-500 mt-1 tracking-wider">Hadir</span>
            </div>
        </div>

        <!-- Detail Rincian & Status Keaktifan -->
        <div class="space-y-3 text-center sm:text-left flex-1">
            <div class="space-y-1">
                <p class="text-xs font-black uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Kehadiran</p>
                <h3 class="text-2xl font-black text-black dark:text-white">
                    {{ $attendanceStats->hadir }} <span class="text-sm font-bold text-zinc-500">/ {{ $attendanceStats->total_santri }} Santri</span>
                </h3>
            </div>

            <div>
                @if(($attendanceStats->percentage ?? 0) >= 80)
                    <span style="background-color: #a7f3d0;" class="inline-block px-3.5 py-1.5 text-black border-2 border-black rounded-xl text-xs font-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        🌟 Kehadiran Sangat Tinggi!
                    </span>
                @elseif(($attendanceStats->percentage ?? 0) >= 50)
                    <span style="background-color: #fef08a;" class="inline-block px-3.5 py-1.5 text-black border-2 border-black rounded-xl text-xs font-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        ⚡ Kehadiran Cukup Baik
                    </span>
                @else
                    <span style="background-color: #fbcfe8;" class="inline-block px-3.5 py-1.5 text-rose-950 border-2 border-black rounded-xl text-xs font-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        📢 Perlu Ditingkatkan
                    </span>
                @endif
            </div>
        </div>

    </div>

    <!-- 3 Card Breakdown Stat Ringkas Berwarna Soft -->
    <div class="grid grid-cols-3 gap-3">
        <!-- Hadir -->
        <div style="background-color: #dcfce7;" class="dark:bg-emerald-950 border-3 border-black dark:border-white rounded-2xl p-3 text-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
            <p class="text-[11px] font-black text-emerald-950 dark:text-emerald-300 uppercase">Hadir</p>
            <p class="text-2xl font-black text-emerald-900 dark:text-emerald-200 font-mono mt-0.5">{{ $attendanceStats->hadir }}</p>
        </div>

        <!-- Izin & Sakit -->
        <div style="background-color: #bae6fd;" class="dark:bg-sky-950 border-3 border-black dark:border-white rounded-2xl p-3 text-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
            <p class="text-[11px] font-black text-sky-950 dark:text-sky-300 uppercase">Izin / Sakit</p>
            <p class="text-2xl font-black text-sky-900 dark:text-sky-200 font-mono mt-0.5">{{ $attendanceStats->izin + $attendanceStats->sakit }}</p>
        </div>

        <!-- Belum Scan -->
        <div style="background-color: #ffe4e6;" class="dark:bg-rose-950 border-3 border-black dark:border-white rounded-2xl p-3 text-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
            <p class="text-[11px] font-black text-rose-950 dark:text-rose-300 uppercase">Belum Scan</p>
            <p class="text-2xl font-black text-rose-900 dark:text-rose-200 font-mono mt-0.5">{{ $attendanceStats->alpha }}</p>
        </div>
    </div>

    @if(isset($tahsinStats) && $tahsinStats->has_session)
        <!-- Tahsin & Tahfidz Hari Ini -->
        <div style="background-color: #e9d5ff;" class="border-3 border-black dark:border-white rounded-2xl p-3 flex items-center justify-between gap-3 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
            <div class="flex items-center gap-2">
                <span class="text-xl">🕌</span>
                <div>
                    <p class="text-[11px] font-black text-purple-950 uppercase">Tahsin &amp; Tahfidz Hari Ini</p>
                    <p class="text-xs font-bold text-purple-900">{{ $tahsinStats->hadir }} hadir · {{ $tahsinStats->izin + $tahsinStats->sakit }} izin/sakit · {{ $tahsinStats->alpha }} belum</p>
                </div>
            </div>
            <span class="text-2xl font-black font-mono text-purple-950">{{ $tahsinStats->percentage }}%</span>
        </div>
    @endif

</div>

