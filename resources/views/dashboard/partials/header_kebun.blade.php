<!-- Header Dashboard & Modul Kebun Kebaikan Kartun 2D Organik -->
<div class="bg-[#86EFAC] dark:bg-emerald-950/80 border-3 border-black dark:border-white shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] dark:shadow-[5px_5px_0px_0px_rgba(255,255,255,1)] rounded-3xl p-6 md:p-7 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
    
    <!-- Bagian Salam & Info Santri -->
    <div class="space-y-3 z-10 max-w-lg">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-[#7DD3FC] text-sky-950 border-2 border-black rounded-full text-xs font-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
            <span class="material-symbols-outlined text-base">calendar_month</span>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
        
        <h1 class="font-headline-md text-2xl md:text-3xl font-black text-black dark:text-white tracking-tight">
            Assalamu'alaikum, {{ $user->name }}! 🌟
        </h1>
        <p class="text-sm font-bold text-emerald-950 dark:text-emerald-100 leading-relaxed">
            Setiap amal dan kajianmu memupuk Pohon Kebaikan di pondok Daaru Hiraa! Mari jaga keistiqomahan hari ini! ✨
        </p>

        <!-- Status & Level Kebun -->
        <div class="pt-2 flex items-center gap-3">
            <span class="px-3 py-1 bg-[#FDE047] text-black border-2 border-black rounded-xl text-xs font-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                Progres: 
                @if(($gardenStage ?? 1) == 4) 🍎 Pohon Berbuah (Istimewa)
                @elseif(($gardenStage ?? 1) == 3) 🌿 Pohon Rimbun (Subur)
                @elseif(($gardenStage ?? 1) == 2) 🌱 Tunas Kebaikan (Biasa)
                @else 💧 Benih Amal (Awal)
                @endif
            </span>
        </div>
    </div>

    <!-- Bagian Visual Vektor 2D Kartun Organik Kebun Kebaikan -->
    <div class="relative z-10 w-44 h-44 md:w-52 md:h-52 bg-[#FEF08A] dark:bg-zinc-900 border-3 border-black dark:border-white rounded-3xl p-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center shrink-0">
        
        @if(($gardenStage ?? 1) == 4)
            <!-- Stage 4: Pohon Rimbun Berbuah Emas & Bunga (SVG 2D Kartun) -->
            <svg class="w-full h-full animate-sway" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Tanah Pot Kartun -->
                <ellipse cx="50" cy="85" rx="35" ry="8" fill="#78350F" stroke="#000" stroke-width="2.5"/>
                <path d="M25 85 Q 50 95 75 85 L 70 72 L 30 72 Z" fill="#92400E" stroke="#000" stroke-width="2.5"/>
                <!-- Batang Pohon -->
                <path d="M46 72 Q 45 45 35 35 M 54 72 Q 55 45 65 35" stroke="#78350F" stroke-width="6" stroke-linecap="round"/>
                <!-- Dedaunan Rimbun -->
                <circle cx="50" cy="38" r="26" fill="#22C55E" stroke="#000" stroke-width="2.5"/>
                <circle cx="34" cy="42" r="18" fill="#16A34A" stroke="#000" stroke-width="2.5"/>
                <circle cx="66" cy="42" r="18" fill="#15803D" stroke="#000" stroke-width="2.5"/>
                <circle cx="50" cy="24" r="18" fill="#4ADE80" stroke="#000" stroke-width="2.5"/>
                <!-- Buah-Buahan Emas Kartun -->
                <circle cx="42" cy="30" r="4.5" fill="#EAB308" stroke="#000" stroke-width="1.5"/>
                <circle cx="58" cy="34" r="4.5" fill="#EAB308" stroke="#000" stroke-width="1.5"/>
                <circle cx="34" cy="45" r="4.5" fill="#EF4444" stroke="#000" stroke-width="1.5"/>
                <circle cx="64" cy="46" r="4.5" fill="#EF4444" stroke="#000" stroke-width="1.5"/>
                <circle cx="50" cy="48" r="4.5" fill="#EAB308" stroke="#000" stroke-width="1.5"/>
                <!-- Bunga Bermekaran -->
                <path d="M 42 20 L 44 24 L 48 24 L 45 27 L 46 31 L 42 28 L 38 31 L 39 27 L 36 24 L 40 24 Z" fill="#F472B6" stroke="#000" stroke-width="1"/>
                <!-- Kilatan Cahaya Kartun -->
                <path d="M 78 20 L 82 22 L 80 26 L 84 28" stroke="#000" stroke-width="2" stroke-linecap="round"/>
            </svg>

        @elseif(($gardenStage ?? 1) == 3)
            <!-- Stage 3: Pohon Rimbun Hijau (SVG 2D Kartun) -->
            <svg class="w-full h-full animate-sway" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Pot Kartun -->
                <ellipse cx="50" cy="85" rx="32" ry="7" fill="#78350F" stroke="#000" stroke-width="2.5"/>
                <path d="M26 85 Q 50 94 74 85 L 68 73 L 32 73 Z" fill="#92400E" stroke="#000" stroke-width="2.5"/>
                <!-- Batang -->
                <path d="M47 73 Q 46 48 38 40 M 53 73 Q 54 48 62 40" stroke="#78350F" stroke-width="5.5" stroke-linecap="round"/>
                <!-- Dedaunan Rimbun -->
                <circle cx="50" cy="40" r="23" fill="#22C55E" stroke="#000" stroke-width="2.5"/>
                <circle cx="36" cy="45" r="16" fill="#16A34A" stroke="#000" stroke-width="2.5"/>
                <circle cx="64" cy="45" r="16" fill="#15803D" stroke="#000" stroke-width="2.5"/>
                <circle cx="50" cy="28" r="16" fill="#4ADE80" stroke="#000" stroke-width="2.5"/>
            </svg>

        @elseif(($gardenStage ?? 1) == 2)
            <!-- Stage 2: Tunas Kebaikan (SVG 2D Kartun) -->
            <svg class="w-full h-full animate-bounce-slow" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Pot Humus -->
                <ellipse cx="50" cy="85" rx="30" ry="7" fill="#78350F" stroke="#000" stroke-width="2.5"/>
                <path d="M28 85 Q 50 93 72 85 L 66 74 L 34 74 Z" fill="#92400E" stroke="#000" stroke-width="2.5"/>
                <!-- Batang Tunas -->
                <path d="M50 74 C 50 60 52 50 50 42" stroke="#15803D" stroke-width="4.5" stroke-linecap="round"/>
                <!-- Daun 1 -->
                <path d="M50 55 C 35 50 30 38 44 42 Z" fill="#4ADE80" stroke="#000" stroke-width="2.5"/>
                <!-- Daun 2 -->
                <path d="M50 48 C 65 43 70 31 56 35 Z" fill="#22C55E" stroke="#000" stroke-width="2.5"/>
                <!-- Tunas Kecil Atas -->
                <path d="M50 42 C 45 32 50 25 50 25 C 50 25 55 32 50 42 Z" fill="#86EFAC" stroke="#000" stroke-width="2"/>
            </svg>

        @else
            <!-- Stage 1: Benih di Tanah Humus + Tetesan Air (SVG 2D Kartun) -->
            <svg class="w-full h-full" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Pot & Tanah Humus -->
                <ellipse cx="50" cy="85" rx="30" ry="7" fill="#78350F" stroke="#000" stroke-width="2.5"/>
                <path d="M28 85 Q 50 93 72 85 L 66 74 L 34 74 Z" fill="#92400E" stroke="#000" stroke-width="2.5"/>
                <!-- Benih Emas Kartun -->
                <ellipse cx="50" cy="72" rx="6" ry="8" fill="#FACC15" stroke="#000" stroke-width="2"/>
                <path d="M50 64 Q 52 58 48 55" stroke="#16A34A" stroke-width="2" stroke-linecap="round"/>
                <!-- Tetesan Air Ceria Animasi Drop -->
                <path class="animate-drop" d="M50 28 C 44 38 42 44 50 50 C 58 44 56 38 50 28 Z" fill="#38BDF8" stroke="#000" stroke-width="2"/>
                <!-- Mata Ceria Tetesan Air -->
                <circle cx="48" cy="42" r="1" fill="#000"/>
                <circle cx="52" cy="42" r="1" fill="#000"/>
            </svg>
        @endif

    </div>
</div>

<style>
@keyframes swayGentle {
    0%, 100% { transform: rotate(-2.5deg); }
    50% { transform: rotate(2.5deg); }
}
.animate-sway {
    animation: swayGentle 4s ease-in-out infinite;
    transform-origin: bottom center;
}
@keyframes bounceSlow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}
.animate-bounce-slow {
    animation: bounceSlow 3s ease-in-out infinite;
}
@keyframes waterDrop {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(6px); }
}
.animate-drop {
    animation: waterDrop 2s ease-in-out infinite;
}
</style>
