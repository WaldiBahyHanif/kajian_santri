<!-- Quick Action Buttons Playful Neobrutalism (Single-Click Bouncy) -->
<div class="bg-[#7DD3FC] dark:bg-sky-950/80 border-3 border-black dark:border-white shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] dark:shadow-[5px_5px_0px_0px_rgba(255,255,255,1)] rounded-3xl p-6 space-y-4">
    <div class="flex items-center justify-between">
        <h3 class="text-xl font-black text-black dark:text-white tracking-tight flex items-center gap-2">
            <span class="text-2xl">⚡</span>
            Aksi Cepat Santri
        </h3>
        <span class="text-xs font-bold text-sky-950 dark:text-sky-200">Akses 1-Tap Instan</span>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3.5">
        <!-- Scan QR Absensi -->
        <a href="{{ route('attendance.scan') }}" class="flex flex-col items-center justify-center p-4 bg-[#86EFAC] text-black border-3 border-black rounded-2xl font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[-3px] active:translate-y-0 active:scale-95 transition-all cursor-pointer text-center group">
            <span class="material-symbols-outlined text-3xl mb-1 group-hover:rotate-12 transition-transform">qr_code_scanner</span>
            <span class="text-xs font-black">Scan Absensi</span>
        </a>

        <!-- Mitsur Duo -->
        <a href="{{ route('mitsur') }}" class="flex flex-col items-center justify-center p-4 bg-[#D8B4FE] text-black border-3 border-black rounded-2xl font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[-3px] active:translate-y-0 active:scale-95 transition-all cursor-pointer text-center group">
            <span class="material-symbols-outlined text-3xl mb-1 group-hover:rotate-12 transition-transform">group</span>
            <span class="text-xs font-black">Mitsur Duo</span>
        </a>

        <!-- Refleksi Harian -->
        <a href="{{ route('refleksi') }}" class="flex flex-col items-center justify-center p-4 bg-[#FDE047] text-black border-3 border-black rounded-2xl font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[-3px] active:translate-y-0 active:scale-95 transition-all cursor-pointer text-center group">
            <span class="material-symbols-outlined text-3xl mb-1 group-hover:rotate-12 transition-transform">edit_note</span>
            <span class="text-xs font-black">Refleksi</span>
        </a>

        <!-- Tasbih Digital -->
        <a href="{{ route('zikir') }}" class="flex flex-col items-center justify-center p-4 bg-[#38BDF8] text-black border-3 border-black rounded-2xl font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[-3px] active:translate-y-0 active:scale-95 transition-all cursor-pointer text-center group">
            <span class="material-symbols-outlined text-3xl mb-1 group-hover:rotate-12 transition-transform">auto_awesome</span>
            <span class="text-xs font-black">Tasbih Zikir</span>
        </a>

        <!-- Rapor & Rekap -->
        <a href="{{ route('rapor') }}" class="flex flex-col items-center justify-center p-4 bg-[#FDA4AF] text-black border-3 border-black rounded-2xl font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[-3px] active:translate-y-0 active:scale-95 transition-all cursor-pointer text-center group col-span-2 sm:col-span-1">
            <span class="material-symbols-outlined text-3xl mb-1 group-hover:rotate-12 transition-transform">analytics</span>
            <span class="text-xs font-black">Rapor & Rekap</span>
        </a>
    </div>
</div>
