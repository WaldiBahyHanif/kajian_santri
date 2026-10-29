<!DOCTYPE html>
<html class="antialiased" lang="id">
<head>
    <meta charset="utf-8"/>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daaru Hiraa - Dashboard</title>
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#003527" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#121212" media="(prefers-color-scheme: dark)">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Daaru Hiraa">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
    <meta name="mobile-web-app-capable" content="yes">
                    <style>
        :root {
            --on-tertiary-fixed-variant: #5c4300;
            --primary-fixed-dim: #95d3ba;
            --background: #f9f9f9;
            --surface-variant: #e2e2e2;
            --primary-container: #064e3b;
            --on-secondary-fixed-variant: #00513a;
            --on-secondary-container: #247155;
            --tertiary-fixed: #ffdf9f;
            --tertiary: #3c2b00;
            --on-primary: #ffffff;
            --on-primary-container: #80bea6;
            --on-secondary-fixed: #002115;
            --on-tertiary: #ffffff;
            --tertiary-container: #584000;
            --secondary-container: #a6f2cf;
            --inverse-primary: #95d3ba;
            --on-background: #1b1b1b;
            --surface: #f9f9f9;
            --on-secondary: #ffffff;
            --outline-variant: #bfc9c3;
            --error-container: #ffdad6;
            --primary-fixed: #b0f0d6;
            --on-surface-variant: #404944;
            --primary: #003527;
            --secondary: #1b6b4f;
            --on-tertiary-container: #e0a800;
            --surface-container-highest: #e2e2e2;
            --on-error-container: #93000a;
            --secondary-fixed-dim: #8bd6b4;
            --on-primary-fixed: #002117;
            --on-primary-fixed-variant: #0b513d;
            --inverse-on-surface: #f1f1f1;
            --tertiary-fixed-dim: #f9bd22;
            --surface-container-high: #e8e8e8;
            --surface-container: #eeeeee;
            --surface-tint: #2b6954;
            --surface-container-lowest: #ffffff;
            --surface-bright: #f9f9f9;
            --outline: #707974;
            --surface-dim: #dadada;
            --on-tertiary-fixed: #261a00;
            --secondary-fixed: #a6f2cf;
            --surface-container-low: #f3f3f3;
            --on-error: #ffffff;
            --error: #ba1a1a;
            --on-surface: #1b1b1b;
            --inverse-surface: #303030;
            --neobrutal-shadow-color: 0, 0, 0;
            --neobrutal-border-color: #000000;
        }

        .dark {
            --on-tertiary-fixed-variant: #ffdf9f;
            --primary-fixed-dim: #1b6b4f;
            --background: #121212;
            --surface-variant: #2d2d2d;
            --primary-container: #004d38;
            --on-secondary-fixed-variant: #a6f2cf;
            --on-secondary-container: #a6f2cf;
            --tertiary-fixed: #584000;
            --tertiary: #ffdf9f;
            --on-primary: #002117;
            --on-primary-container: #b0f0d6;
            --on-secondary-fixed: #a6f2cf;
            --on-tertiary: #261a00;
            --tertiary-container: #ffdf9f;
            --secondary-container: #003527;
            --inverse-primary: #003527;
            --on-background: #f1f1f1;
            --surface: #1e1e1e;
            --on-secondary: #002115;
            --outline-variant: #4a5568;
            --error-container: #8c1d18;
            --primary-fixed: #1b6b4f;
            --on-surface-variant: #cbd5e1;
            --primary: #4ade80;
            --secondary: #22c55e;
            --on-tertiary-container: #ffdf9f;
            --surface-container-highest: #3e3e3e;
            --on-error-container: #f9cbd2;
            --secondary-fixed-dim: #1b6b4f;
            --on-primary-fixed: #b0f0d6;
            --on-primary-fixed-variant: #b0f0d6;
            --inverse-on-surface: #121212;
            --tertiary-fixed-dim: #ffdf9f;
            --surface-container-high: #2d2d2d;
            --surface-container: #242424;
            --surface-tint: #4ade80;
            --surface-container-lowest: #1a1a1a;
            --surface-bright: #1e1e1e;
            --outline: #94a3b8;
            --surface-dim: #151515;
            --on-tertiary-fixed: #ffdf9f;
            --secondary-fixed: #003527;
            --surface-container-low: #222222;
            --on-error: #601410;
            --error: #f87171;
            --on-surface: #f1f1f1;
            --inverse-surface: #f1f1f1;
            --neobrutal-shadow-color: 255, 255, 255;
            --neobrutal-border-color: #ffffff;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        /* Pure Neobrutalist Shadows matching the rest of the app */
        .neobrutal-shadow {
            box-shadow: 6px 6px 0px 0px rgba(var(--neobrutal-shadow-color),1);
        }
        .neobrutal-shadow-sm {
            box-shadow: 4px 4px 0px 0px rgba(var(--neobrutal-shadow-color),1);
        }
        .neobrutal-shadow-active:active {
            box-shadow: 0px 0px 0px 0px rgba(var(--neobrutal-shadow-color),1);
            transform: translate(6px, 6px);
        }

        /* Dark Mode overrides for compiled elements with explicit classes */
        .dark .border-black {
            border-color: var(--neobrutal-border-color) !important;
        }
        .dark .border-on-background {
            border-color: var(--neobrutal-border-color) !important;
        }
        .dark .bg-white {
            background-color: var(--surface-container-lowest) !important;
        }
        .dark .text-black {
            color: var(--on-surface) !important;
        }

        /* Shadow overrides */
        .dark .shadow-\[6px_6px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 6px 6px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark .shadow-\[4px_4px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 4px 4px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark .shadow-\[2px_2px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 2px 2px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark .shadow-\[2px_2px_0_0_\#000\] {
            box-shadow: 2px 2px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark .shadow-\[4px_4px_0_0_\#000\] {
            box-shadow: 4px 4px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark .shadow-\[6px_6px_0_0_\#000\] {
            box-shadow: 6px 6px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark .shadow-\[0px_-4px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 0px -4px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark [class*="border-dashed"] {
            border-color: var(--outline) !important;
        }

        /* Ustadz AI Cartoon Background Animations */
        @keyframes spin-slow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .animate-spin-slow {
            animation: spin-slow 20s linear infinite;
        }

        @keyframes drift {
            0%, 100% { transform: translateX(0px); }
            50% { transform: translateX(15px); }
        }
        .animate-drift-slow {
            animation: drift 8s ease-in-out infinite;
        }

        .font-pixel {
            font-family: 'Press Start 2P', monospace;
        }

        #village-viewport {
            touch-action: none;
            cursor: grab;
        }
        #village-viewport.dragging {
            cursor: grabbing;
        }
        #village-world {
            transform-origin: 0 0;
            will-change: transform;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Press+Start+2P&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background font-body-md min-h-screen">

<!-- TopAppBar Shell -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 md:px-margin-desktop py-4 bg-surface border-b-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
    <div class="flex items-center gap-2">
        <a href="{{ url('/') }}" class="font-headline-md text-headline-md font-black text-primary tracking-tighter hover:opacity-80">Daaru Hiraa</a>
    </div>
    <div class="flex items-center gap-3">
        <!-- Calendar Button (Mobile & Desktop) -->
        <a href="{{ route('kalender.index') }}" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer text-primary" aria-label="Open Calendar">
            <span class="material-symbols-outlined text-2xl">calendar_month</span>
        </a>

        <!-- Theme Toggle -->
        <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer text-on-background" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-2xl block dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-2xl hidden dark:block">light_mode</span>
        </button>

        <!-- Hamburger Button (Mobile Only) -->
        <button id="hamburger-toggle" class="flex md:hidden flex-col items-center justify-center w-12 h-12 bg-secondary text-on-secondary border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer" aria-label="Menu">
            <span class="material-symbols-outlined text-2xl">menu</span>
        </button>

        <div class="hidden md:flex items-center">
            <a href="{{ route('profile.edit') }}" class="w-12 h-12 border-3 border-on-background rounded-full overflow-hidden neobrutal-shadow flex items-center justify-center bg-secondary-container text-secondary font-bold hover:scale-105 transition-transform flex-shrink-0">
                @if(auth()->user()->avatar)
                    <img src="https://api.dicebear.com/9.x/micah/svg?seed={!! auth()->user()->avatar !!}&backgroundColor=transparent" class="w-full h-full object-cover" alt="User Avatar" />
                @else
                    {{ substr(auth()->user()->name, 0, 1) }}
                @endif
            </a>
        </div>
    </div>
</header>

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-[55] hidden opacity-0 transition-opacity duration-300 md:hidden"></div>

    <x-sidebar active="dashboard" />

<!-- Main Content Canvas -->
<main class="pt-24 pb-24 md:pl-72 md:pr-10 px-4">
    <div class="max-w-5xl mx-auto space-y-8">
        
        <!-- Welcome Section -->
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                @php
                    $firstName = explode(' ', auth()->user()->name)[0];
                    \Carbon\Carbon::setLocale('id');
                @endphp
                <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary tracking-tight">Assalamualaikum, {{ $firstName }}!</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant flex items-center gap-2 mt-2">
                    <span class="material-symbols-outlined">event</span> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('attendance.scan') }}" class="bg-primary text-on-primary border-3 border-on-background neobrutal-shadow neobrutal-shadow-active px-6 py-3 rounded-lg font-bold transition-all text-center block">
                    Scan Absensi
                </a>
                <button type="button" onclick="testWebPushNotification()" class="bg-[#FFDE00] text-black border-3 border-on-background neobrutal-shadow neobrutal-shadow-active px-4 py-3 rounded-lg font-black transition-all text-center flex items-center gap-2 text-xs uppercase cursor-pointer">
                    <span class="material-symbols-outlined text-base">notifications_active</span> Tes Notif HP
                </button>
            </div>
        </section>

        @if(auth()->user()->title === 'Musyrif' && count($flaggedSantri ?? []) > 0)
            <!-- Musyrif Alert Banner -->
            <section class="bg-error-container text-on-error-container border-3 border-on-background p-6 rounded-xl neobrutal-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-symbols-outlined text-3xl text-error">warning</span>
                    <h3 class="font-headline-md text-headline-md font-black">Perhatian Musyrif: Santri Membutuhkan Bantuan</h3>
                </div>
                <p class="text-sm font-bold mb-4">Berikut adalah santri yang mengalami penurunan kondisi ruhani atau membutuhkan teman cerita hari ini. Segera hubungi mereka untuk memberikan dukungan:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($flaggedSantri as $mood)
                        @if($mood->student)
                            <div class="bg-white dark:bg-zinc-800 text-on-background border-2 border-on-background p-4 rounded-lg flex items-center justify-between shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg border-2 border-on-background overflow-hidden flex items-center justify-center bg-secondary-container">
                                        @if($mood->student->avatar)
                                            <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $mood->student->avatar }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="Avatar" />
                                        @else
                                            <span class="font-bold text-lg text-secondary">{{ substr($mood->student->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm">{{ $mood->student->name }}</h4>
                                        <p class="text-[10px] text-on-surface-variant">Kamar {{ $mood->student->room ?? '-' }} · Angkatan {{ $mood->student->generation ?? '-' }}</p>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 text-xs border-2 border-on-background rounded-full font-bold {{ $mood->mood_type === 'Futur' ? 'bg-amber-100 text-amber-800 border-amber-400' : 'bg-rose-100 text-rose-800 border-rose-400' }}">
                                    {{ $mood->mood_type === 'Futur' ? '🍂 Futur' : '💬 Butuh Cerita' }}
                                </span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif

        <!-- 🌾 KEBUN BUAH PONDOK (2D Top-Down Pixel Art Farm ala Harvest Moon: Back to Nature) -->
        @php
            $status = $setting->garden_status ?? 'subur';
            $message = $setting->garden_message ?? 'Mari hiasi hari kita dengan zikir dan kajian berilmu di pondok Daaru Hiraa.';

            // Tema rumput & musim berdasarkan status kebun
            $grassBase = '#569826';
            $grassDark = '#46801C';
            $grassLight = '#6AB034';
            $seasonLabel = 'SPRING · MUSIM SEMI';
            $seasonBadgeBg = '#86EFAC';
            if ($status === 'subur_sekali') {
                $grassBase = '#4E9424';
                $grassDark = '#3E7A18';
                $grassLight = '#64B432';
                $seasonLabel = 'PANEN RAYA · SUBUR';
                $seasonBadgeBg = '#FDE047';
            } elseif ($status === 'biasa') {
                $grassBase = '#689A28';
                $grassDark = '#56821E';
                $grassLight = '#80B238';
                $seasonLabel = 'SUMMER · MUSIM PANAS';
                $seasonBadgeBg = '#FDBA74';
            } elseif ($status === 'kering') {
                $grassBase = '#8C8830';
                $grassDark = '#747022';
                $grassLight = '#A49E3E';
                $seasonLabel = 'AUTUMN · MUSIM GUGUR';
                $seasonBadgeBg = '#FCA5A5';
            }

            // Layout Grid Ladang 2D (6 kolom: 3 kiri jalan utama, 3 kanan jalan utama)
            $villageCols = 6;
            $plotW = 108;
            $plotH = 114;
            $aisleWidth = 44; // Jalan setapak batu di tengah ladang
            $padX = 36;       // Margin pagar kayu kiri/kanan
            $plazaHeight = 112; // Area bangunan Farmhouse, Shipping Bin & Kolam di utara ladang
            $padBottom = 36;

            $villageRows = (int) ceil(max($villageStudents->count(), 1) / $villageCols);
            $villageWidth = ($padX * 2) + ($villageCols * $plotW) + $aisleWidth;
            $villageHeight = $plazaHeight + ($villageRows * $plotH) + $padBottom;

            $stageNames = [
                1 => 'Tahap 1 · Benih Sawah (0-29%)',
                2 => 'Tahap 2 · Tunas Muda (30-59%)',
                3 => 'Tahap 3 · Pohon Berbunga (60-84%)',
                4 => 'Tahap 4 · Pohon Berbuah Lebat (85-100%)',
            ];
            $fruitNames = [
                0 => 'Kebun Apel Merah',
                1 => 'Kebun Jeruk Mandarin',
                2 => 'Kebun Anggur Ungu',
                3 => 'Kebun Mangga Emas',
            ];

            $stageCounts = [
                4 => $villageStudents->where('garden_stage', 4)->count(),
                3 => $villageStudents->where('garden_stage', 3)->count(),
                2 => $villageStudents->where('garden_stage', 2)->count(),
                1 => $villageStudents->where('garden_stage', 1)->count(),
            ];

            $myPlotStudent = $villageStudents->firstWhere('id', auth()->id()) ?? $villageStudents->first();
        @endphp
        <section class="border-3 border-on-background rounded-xl neobrutal-shadow overflow-hidden bg-[#2B1708]">
            <!-- Harvest Moon Retro Top HUD Bar -->
            <div class="p-3 sm:px-4 border-b-3 border-black bg-[#3B200E] text-[#FEF3C7] flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <!-- Pixel Season & Clock Box -->
                    <div class="inline-flex items-center gap-2 bg-[#1F1006] border-2 border-[#A16207] px-2.5 py-1 rounded shadow-[2px_2px_0_0_#000]">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" shape-rendering="crispEdges">
                            <rect x="5" y="5" width="6" height="6" fill="#FACC15"/>
                            <rect x="7" y="1" width="2" height="3" fill="#FDE047"/>
                            <rect x="7" y="12" width="2" height="3" fill="#FDE047"/>
                            <rect x="1" y="7" width="3" height="2" fill="#FDE047"/>
                            <rect x="12" y="7" width="3" height="2" fill="#FDE047"/>
                            <rect x="3" y="3" width="2" height="2" fill="#F59E0B"/>
                            <rect x="11" y="3" width="2" height="2" fill="#F59E0B"/>
                            <rect x="3" y="11" width="2" height="2" fill="#F59E0B"/>
                            <rect x="11" y="11" width="2" height="2" fill="#F59E0B"/>
                        </svg>
                        <span class="font-pixel text-[8px] sm:text-[9px] text-[#FDE047] tracking-wider">{{ $seasonLabel }}</span>
                    </div>

                    <div class="flex items-center gap-1.5">
                        <span class="font-pixel text-[9px] sm:text-[10px] text-white tracking-wide uppercase">Ladang Daaru Hiraa</span>
                        <span class="text-[10px] font-bold bg-[#D97706] text-black px-2 py-0.5 border border-black rounded shadow-[1px_1px_0_0_#000]">
                            {{ $villageStudents->count() }} Petak
                        </span>
                    </div>
                </div>

                <!-- Statistik Panen & Lompat ke Petak Santri -->
                <div class="flex items-center gap-2 flex-wrap w-full sm:w-auto justify-between sm:justify-end">
                    <div class="hidden sm:flex items-center gap-1.5 text-[10px] font-black bg-[#1F1006] border border-[#78350F] px-2.5 py-1 rounded text-[#FDE68A]">
                        <span title="Pohon Berbuah (85%+)">🍎 {{ $stageCounts[4] }}</span>
                        <span class="opacity-40">|</span>
                        <span title="Pohon Rimbun (60-84%)">🌳 {{ $stageCounts[3] }}</span>
                        <span class="opacity-40">|</span>
                        <span title="Tunas Muda (30-59%)">🌱 {{ $stageCounts[2] }}</span>
                        <span class="opacity-40">|</span>
                        <span title="Benih (0-29%)">🌰 {{ $stageCounts[1] }}</span>
                    </div>

                    <select id="village-jump-select" aria-label="Cari Petak Santri" class="bg-[#FEF3C7] text-black border-2 border-black rounded px-2 py-1 text-[11px] font-black shadow-[2px_2px_0_0_#000] focus:outline-none cursor-pointer flex-1 sm:flex-initial sm:max-w-[190px] truncate">
                        <option value="">🔍 Cari Petak Santri...</option>
                        @foreach($villageStudents as $vs)
                            <option value="{{ $vs->id }}" @selected($vs->id === auth()->id())>
                                {{ $vs->name }} (Tahap {{ $vs->garden_stage }})
                            </option>
                        @endforeach
                    </select>

                    <button type="button" id="village-focus-mine" class="bg-[#86EFAC] hover:bg-[#4ADE80] text-black border-2 border-black rounded px-2.5 py-1 text-[10px] font-black uppercase shadow-[2px_2px_0_0_#000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer shrink-0">
                        Petakku
                    </button>
                </div>
            </div>

            <!-- Viewport Map 2D Top-Down (Drag & Zoomable) -->
            <div id="village-viewport" class="relative overflow-hidden border-b-3 border-black select-none h-[340px] sm:h-[400px] md:h-[460px]" style="background-color: {{ $grassDark }};">
                <div id="village-world" style="width: {{ $villageWidth }}px; height: {{ $villageHeight }}px; position: relative; image-rendering: pixelated;">

                    <!-- Layer 0: Seamless 16-bit Pixel Grass & Farm Paths SVG -->
                    <svg width="{{ $villageWidth }}" height="{{ $villageHeight }}" viewBox="0 0 {{ $villageWidth }} {{ $villageHeight }}" shape-rendering="crispEdges" xmlns="http://www.w3.org/2000/svg" class="absolute inset-0 pointer-events-none">
                        <defs>
                            <!-- Tile Rumput Piksel 32x32 -->
                            <pattern id="hm-grass-tile" width="32" height="32" patternUnits="userSpaceOnUse">
                                <rect width="32" height="32" fill="{{ $grassBase }}"/>
                                <!-- Detail rumput piksel -->
                                <rect x="4" y="6" width="2" height="2" fill="{{ $grassDark }}"/>
                                <rect x="6" y="4" width="2" height="2" fill="{{ $grassLight }}"/>
                                <rect x="20" y="12" width="2" height="4" fill="{{ $grassDark }}"/>
                                <rect x="22" y="10" width="2" height="4" fill="{{ $grassLight }}"/>
                                <rect x="10" y="24" width="4" height="2" fill="{{ $grassDark }}"/>
                                <rect x="12" y="22" width="2" height="2" fill="{{ $grassLight }}"/>
                                <rect x="26" y="26" width="2" height="2" fill="#FEF08A"/>
                                <rect x="26" y="28" width="2" height="2" fill="{{ $grassDark }}"/>
                            </pattern>

                            <!-- Tile Jalan Tanah & Batu Piksel 24x24 -->
                            <pattern id="hm-path-tile" width="24" height="24" patternUnits="userSpaceOnUse">
                                <rect width="24" height="24" fill="#C29B61"/>
                                <rect x="0" y="0" width="24" height="2" fill="#A47E46"/>
                                <rect x="0" y="22" width="24" height="2" fill="#8C6732"/>
                                <rect x="4" y="6" width="6" height="4" fill="#D6B47C"/>
                                <rect x="14" y="14" width="6" height="4" fill="#B0894F"/>
                                <rect x="16" y="5" width="3" height="3" fill="#9E7B46"/>
                                <rect x="5" y="16" width="4" height="3" fill="#D6B47C"/>
                            </pattern>

                            <!-- Pagar Kayu Horizontal 16x16 -->
                            <pattern id="hm-fence-h" width="16" height="16" patternUnits="userSpaceOnUse">
                                <rect x="0" y="6" width="16" height="3" fill="#78350F"/>
                                <rect x="0" y="11" width="16" height="3" fill="#5C2808"/>
                                <rect x="5" y="2" width="6" height="14" fill="#451A03"/>
                                <rect x="6" y="3" width="4" height="12" fill="#92400E"/>
                                <rect x="6" y="3" width="4" height="2" fill="#B45309"/>
                            </pattern>

                            <!-- Pagar Kayu Vertikal 16x16 -->
                            <pattern id="hm-fence-v" width="16" height="16" patternUnits="userSpaceOnUse">
                                <rect x="4" y="0" width="8" height="16" fill="#451A03"/>
                                <rect x="5" y="0" width="6" height="16" fill="#78350F"/>
                                <rect x="5" y="2" width="6" height="6" fill="#92400E"/>
                                <rect x="6" y="2" width="4" height="2" fill="#B45309"/>
                            </pattern>
                        </defs>

                        <!-- Hamparan Rumput -->
                        <rect width="{{ $villageWidth }}" height="{{ $villageHeight }}" fill="url(#hm-grass-tile)"/>

                        <!-- Pagar Kayu Keliling Ladang -->
                        <rect x="8" y="8" width="{{ $villageWidth - 16 }}" height="16" fill="url(#hm-fence-h)"/>
                        <rect x="8" y="{{ $villageHeight - 24 }}" width="{{ $villageWidth - 16 }}" height="16" fill="url(#hm-fence-h)"/>
                        <rect x="8" y="8" width="16" height="{{ $villageHeight - 16 }}" fill="url(#hm-fence-v)"/>
                        <rect x="{{ $villageWidth - 24 }}" y="8" width="16" height="{{ $villageHeight - 16 }}" fill="url(#hm-fence-v)"/>

                        <!-- Jalan Setapak Tengah (Dari Pendopo Farmhouse ke Gerbang Bawah) -->
                        @php
                            $centerAisleX = $padX + (3 * $plotW);
                        @endphp
                        <rect x="{{ $centerAisleX }}" y="76" width="{{ $aisleWidth }}" height="{{ $villageHeight - 84 }}" fill="url(#hm-path-tile)"/>
                        <!-- Bingkai jalan setapak tengah -->
                        <rect x="{{ $centerAisleX }}" y="76" width="3" height="{{ $villageHeight - 84 }}" fill="#78350F"/>
                        <rect x="{{ $centerAisleX + $aisleWidth - 3 }}" y="76" width="3" height="{{ $villageHeight - 84 }}" fill="#78350F"/>

                        <!-- Jalan Setapak Horizontal Antar Baris Kebun -->
                        @for($r = 0; $r < $villageRows; $r++)
                            @php
                                $rowWalkwayY = $plazaHeight + ($r * $plotH) + 84;
                            @endphp
                            <rect x="{{ $padX }}" y="{{ $rowWalkwayY }}" width="{{ $villageWidth - ($padX * 2) }}" height="18" fill="url(#hm-path-tile)"/>
                            <rect x="{{ $padX }}" y="{{ $rowWalkwayY }}" width="{{ $villageWidth - ($padX * 2) }}" height="2" fill="#8C6732"/>
                            <rect x="{{ $padX }}" y="{{ $rowWalkwayY + 16 }}" width="{{ $villageWidth - ($padX * 2) }}" height="2" fill="#6E4E22"/>
                        @endfor

                        <!-- Plaza Atas: Farmhouse Pondok, Shipping Bin, dan Kolam Irigasi -->
                        <rect x="{{ $centerAisleX - 110 }}" y="68" width="264" height="26" fill="url(#hm-path-tile)"/>

                        <!-- BANGUNAN 1: Pendopo / Farmhouse Kebun Pondok (Kiri-Tengah Plaza) -->
                        <g transform="translate({{ $centerAisleX - 96 }}, 16)">
                            <!-- Bayangan bangunan -->
                            <rect x="4" y="56" width="104" height="8" fill="#2E5612"/>
                            <!-- Dinding Kayu -->
                            <rect x="8" y="28" width="96" height="32" fill="#451A03"/>
                            <rect x="12" y="30" width="88" height="28" fill="#FDE68A"/>
                            <rect x="12" y="50" width="88" height="8" fill="#D97706"/>
                            <!-- Atap Merah Bata Harvest Moon -->
                            <rect x="2" y="20" width="108" height="10" fill="#7F1D1D"/>
                            <rect x="6" y="12" width="100" height="10" fill="#991B1B"/>
                            <rect x="12" y="6" width="88" height="8" fill="#B91C1C"/>
                            <rect x="16" y="8" width="80" height="4" fill="#DC2626"/>
                            <!-- Pintu & Jendela Piksel -->
                            <rect x="48" y="36" width="16" height="22" fill="#451A03"/>
                            <rect x="50" y="38" width="12" height="20" fill="#92400E"/>
                            <rect x="58" y="47" width="2" height="2" fill="#FACC15"/>
                            <rect x="20" y="36" width="16" height="12" fill="#451A03"/>
                            <rect x="22" y="38" width="12" height="8" fill="#7DD3FC"/>
                            <rect x="76" y="36" width="16" height="12" fill="#451A03"/>
                            <rect x="78" y="38" width="12" height="8" fill="#7DD3FC"/>
                            <!-- Papan Nama Pondok -->
                            <rect x="30" y="22" width="52" height="10" fill="#451A03"/>
                            <rect x="32" y="24" width="48" height="6" fill="#FEF08A"/>
                        </g>

                        <!-- BANGUNAN 2: Shipping Bin (Kotak Hasil Panen Kayu di Sebelah Jalan Tengah) -->
                        <g transform="translate({{ $centerAisleX + 16 }}, 38)">
                            <rect x="0" y="24" width="44" height="6" fill="#2E5612"/>
                            <rect x="2" y="4" width="40" height="24" fill="#451A03"/>
                            <rect x="4" y="6" width="36" height="8" fill="#D97706"/>
                            <rect x="4" y="14" width="36" height="12" fill="#92400E"/>
                            <rect x="4" y="12" width="36" height="2" fill="#451A03"/>
                            <rect x="18" y="10" width="8" height="6" fill="#FACC15"/>
                        </g>

                        <!-- BANGUNAN 3: Kolam Air / Sumur Irigasi Piksel (Kanan Plaza) -->
                        <g transform="translate({{ $centerAisleX + 78 }}, 26)">
                            <!-- Bingkai Batu Kolam -->
                            <rect x="4" y="4" width="76" height="44" fill="#374151"/>
                            <rect x="8" y="0" width="68" height="52" fill="#4B5563"/>
                            <rect x="8" y="4" width="68" height="44" fill="#9CA3AF"/>
                            <!-- Air Kolam Piksel -->
                            <rect x="12" y="8" width="60" height="36" fill="#0284C7"/>
                            <rect x="16" y="12" width="52" height="28" fill="#38BDF8"/>
                            <!-- Riak Air Putih -->
                            <rect x="22" y="18" width="10" height="2" fill="#E0F2FE"/>
                            <rect x="44" y="28" width="14" height="2" fill="#E0F2FE"/>
                            <rect x="28" y="32" width="8" height="2" fill="#BAE6FD"/>
                        </g>
                    </svg>

                    <!-- Layer 1: Petak Kebun Tiap Santri -->
                    @foreach($villageStudents as $villageStudent)
                        @php
                            $vCol = $loop->index % $villageCols;
                            $vRow = intdiv($loop->index, $villageCols);
                            $aisleOffset = $vCol >= 3 ? $aisleWidth : 0;
                            $plotLeft = $padX + ($vCol * $plotW) + $aisleOffset;
                            $plotTop = $plazaHeight + ($vRow * $plotH);
                            $isMe = $villageStudent->id === auth()->id();
                            $fruitVariant = $villageStudent->id % 4;
                        @endphp
                        <div
                            class="village-plot-item absolute flex flex-col items-center cursor-pointer group"
                            data-student-id="{{ $villageStudent->id }}"
                            data-student-name="{{ $villageStudent->name }}"
                            data-stage="{{ $villageStudent->garden_stage }}"
                            data-stage-label="{{ $stageNames[$villageStudent->garden_stage] ?? '' }}"
                            data-fruit-label="{{ $fruitNames[$fruitVariant] ?? 'Kebun Buah' }}"
                            data-hadir="{{ $villageStudent->hadir_count ?? 0 }}"
                            data-pct="{{ $villageStudent->attendance_pct ?? 0 }}"
                            data-plot-x="{{ $plotLeft + ($plotW / 2) }}"
                            data-plot-y="{{ $plotTop + ($plotH / 2) }}"
                            style="left: {{ $plotLeft }}px; top: {{ $plotTop }}px; width: {{ $plotW }}px; height: {{ $plotH }}px;"
                        >
                            <!-- Kursor Seleksi Harvest Moon (muncul saat dipilih/hover) -->
                            <div class="plot-cursor pointer-events-none absolute inset-x-2 top-1 bottom-4 border-2 border-dashed {{ $isMe ? 'border-[#FDE047] opacity-100' : 'border-white opacity-0 group-hover:opacity-80' }} rounded transition-opacity z-20"></div>

                            <!-- Sprite Pohon & Tanah Cangkulan 3x3 -->
                            <div class="w-[82px] h-[82px] relative flex items-center justify-center shrink-0 transition-transform group-hover:-translate-y-0.5">
                                <x-pixel-tree :stage="$villageStudent->garden_stage" :variant="$fruitVariant" class="w-full h-full" />
                            </div>

                            <!-- Papan Nama Kayu Piksel (Signboard) -->
                            <div class="relative z-10 -mt-1 px-2 py-0.5 max-w-[100px] border-2 border-[#271204] {{ $isMe ? 'bg-[#FDE047] text-black' : 'bg-[#D9A066] text-[#1F1006]' }} shadow-[2px_2px_0_0_#1F1006] flex items-center gap-1">
                                <span class="w-1.5 h-1.5 shrink-0 border border-black {{ $villageStudent->garden_stage == 4 ? 'bg-red-500' : ($villageStudent->garden_stage == 3 ? 'bg-emerald-500' : ($villageStudent->garden_stage == 2 ? 'bg-lime-400' : 'bg-amber-300')) }}"></span>
                                <p class="font-pixel text-[6px] leading-tight truncate" title="{{ $villageStudent->name }}">
                                    {{ \Illuminate\Support\Str::limit($villageStudent->name, 12, '') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Kontrol Kamera 2D (Kanan Bawah) -->
                <div class="absolute bottom-3 right-3 flex flex-col gap-1.5 z-20">
                    <button type="button" id="village-zoom-in" title="Perbesar" class="w-8 h-8 bg-[#FEF3C7] text-black border-2 border-black rounded font-black text-lg leading-none shadow-[2px_2px_0_0_#000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none cursor-pointer">+</button>
                    <button type="button" id="village-zoom-out" title="Perkecil" class="w-8 h-8 bg-[#FEF3C7] text-black border-2 border-black rounded font-black text-lg leading-none shadow-[2px_2px_0_0_#000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none cursor-pointer">−</button>
                    <button type="button" id="village-zoom-reset" title="Lihat Seluruh Ladang" class="w-8 h-8 bg-[#FEF3C7] text-black border-2 border-black rounded flex items-center justify-center shadow-[2px_2px_0_0_#000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none cursor-pointer">
                        <span class="material-symbols-outlined text-base">center_focus_weak</span>
                    </button>
                </div>

                <!-- Petunjuk Geser (Kiri Bawah) -->
                <div class="absolute bottom-3 left-3 z-20 pointer-events-none hidden sm:flex items-center gap-1.5 bg-[#1F1006]/90 text-[#FEF3C7] border border-[#92400E] px-2.5 py-1 rounded text-[10px] font-bold">
                    <span>🖐️ Geser peta · Klik petak santri untuk detail tanaman</span>
                </div>
            </div>

            <!-- Harvest Moon RPG Dialogue & Inspector Box -->
            <div class="p-4 bg-[#F5E6C8] dark:bg-[#24160B] border-t-3 border-black grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <!-- Inspector Petak Terpilih -->
                <div class="md:col-span-6 bg-[#FFF8E7] dark:bg-[#1A0F07] border-2 border-[#451A03] dark:border-[#92400E] rounded-lg p-3 shadow-[3px_3px_0_0_#271204] flex items-center justify-between gap-3">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="px-1.5 py-0.5 bg-[#86EFAC] text-black border border-black font-pixel text-[7px] uppercase">Petak Kebun</span>
                            <span id="hm-inspector-fruit" class="text-[11px] font-black text-[#92400E] dark:text-[#FBBF24] truncate">
                                {{ $fruitNames[($myPlotStudent->id ?? 0) % 4] }}
                            </span>
                        </div>
                        <p id="hm-inspector-name" class="text-sm font-black text-black dark:text-white truncate mt-1">
                            {{ $myPlotStudent->name ?? auth()->user()->name }}
                        </p>
                        <p id="hm-inspector-stage" class="text-xs font-bold text-[#15803D] dark:text-[#4ADE80]">
                            {{ $stageNames[$myPlotStudent->garden_stage ?? 1] }}
                        </p>
                    </div>
                    <div class="text-right shrink-0 bg-[#FEF08A] text-black border-2 border-black px-2.5 py-1.5 rounded shadow-[2px_2px_0_0_#000]">
                        <p class="text-[9px] font-black uppercase tracking-wider">Hadir 30 Hari</p>
                        <p id="hm-inspector-stats" class="text-base font-black leading-tight">
                            {{ $myPlotStudent->hadir_count ?? 0 }}x ({{ $myPlotStudent->attendance_pct ?? 0 }}%)
                        </p>
                    </div>
                </div>

                <!-- Pesan Pengasuh & Admin -->
                <div class="md:col-span-6 flex items-start gap-3 px-1">
                    <div class="w-9 h-9 bg-[#D97706] border-2 border-black rounded flex items-center justify-center shrink-0 shadow-[2px_2px_0_0_#000] text-white font-pixel text-xs">
                        !
                    </div>
                    <div class="min-w-0">
                        <p class="font-pixel text-[8px] text-[#78350F] dark:text-[#FCD34D] uppercase tracking-wider">Papan Pengumuman Kebun</p>
                        <p class="text-xs font-bold text-[#1F1006] dark:text-[#FEF3C7] leading-relaxed mt-1">
                            "{{ $message }}"
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <script>
        (function () {
            var viewport = document.getElementById('village-viewport');
            var world = document.getElementById('village-world');
            if (!viewport || !world) return;

            var worldW = parseFloat(world.style.width);
            var worldH = parseFloat(world.style.height);
            var minScale = 0.45, maxScale = 2.4;
            var scale = 1, originX = 0, originY = 0;
            var dragging = false, pointerMoved = false, startX = 0, startY = 0, lastX = 0, lastY = 0;

            function clampScale(s) {
                return Math.max(minScale, Math.min(maxScale, s));
            }

            function clampBounds() {
                var vw = viewport.clientWidth, vh = viewport.clientHeight;
                var scaledW = worldW * scale;
                var scaledH = worldH * scale;

                if (scaledW <= vw) {
                    originX = (vw - scaledW) / 2;
                } else {
                    var minX = vw - scaledW - 12;
                    var maxX = 12;
                    originX = Math.max(minX, Math.min(maxX, originX));
                }

                if (scaledH <= vh) {
                    originY = Math.max(0, (vh - scaledH) / 2);
                } else {
                    var minY = vh - scaledH - 16;
                    var maxY = 12;
                    originY = Math.max(minY, Math.min(maxY, originY));
                }
            }

            function updateZoomButtons() {
                var zoomInBtn = document.getElementById('village-zoom-in');
                var zoomOutBtn = document.getElementById('village-zoom-out');
                if (zoomOutBtn) {
                    if (scale <= minScale + 0.005) {
                        zoomOutBtn.classList.add('opacity-40', 'cursor-not-allowed', 'pointer-events-none');
                    } else {
                        zoomOutBtn.classList.remove('opacity-40', 'cursor-not-allowed', 'pointer-events-none');
                    }
                }
                if (zoomInBtn) {
                    if (scale >= maxScale - 0.005) {
                        zoomInBtn.classList.add('opacity-40', 'cursor-not-allowed', 'pointer-events-none');
                    } else {
                        zoomInBtn.classList.remove('opacity-40', 'cursor-not-allowed', 'pointer-events-none');
                    }
                }
            }

            function applyTransform() {
                clampBounds();
                world.style.transform = 'translate(' + originX + 'px, ' + originY + 'px) scale(' + scale + ')';
                updateZoomButtons();
            }

            function fitView() {
                var vw = viewport.clientWidth, vh = viewport.clientHeight;
                // Pas layar: di mobile (portrait/lebar sempit) pas selebar layar (seperti screenshot 2)
                var fitW = (vw - 8) / worldW;
                var fitH = (vh - 12) / worldH;
                var defaultScale = (vw < 640) ? fitW : Math.min(fitW, fitH);

                // Default adalah skala paling kecil: tidak bisa dikecilkan lagi dari batas pas ini
                minScale = defaultScale;
                maxScale = Math.max(minScale * 3.5, 2.5);
                scale = defaultScale;

                originX = (vw - worldW * scale) / 2;
                originY = 0;
                applyTransform();
            }

            function zoomAt(cx, cy, newScale) {
                newScale = clampScale(newScale);
                if (Math.abs(newScale - scale) < 0.001) return;
                var worldX = (cx - originX) / scale;
                var worldY = (cy - originY) / scale;
                scale = newScale;
                originX = cx - worldX * scale;
                originY = cy - worldY * scale;
                applyTransform();
            }

            function focusPlotElement(plotEl) {
                if (!plotEl) return;
                var px = parseFloat(plotEl.getAttribute('data-plot-x') || '0');
                var py = parseFloat(plotEl.getAttribute('data-plot-y') || '0');
                var vw = viewport.clientWidth, vh = viewport.clientHeight;
                scale = clampScale(Math.max(scale, minScale * 1.8));
                originX = (vw / 2) - (px * scale);
                originY = (vh / 2) - (py * scale);
                applyTransform();
                selectPlotElement(plotEl);
            }

            function selectPlotElement(plotEl) {
                if (!plotEl) return;
                document.querySelectorAll('.village-plot-item .plot-cursor').forEach(function (el) {
                    el.classList.remove('border-[#FDE047]', 'opacity-100');
                    el.classList.add('border-white', 'opacity-0');
                });
                var cursor = plotEl.querySelector('.plot-cursor');
                if (cursor) {
                    cursor.classList.remove('border-white', 'opacity-0');
                    cursor.classList.add('border-[#FDE047]', 'opacity-100');
                }

                var nameEl = document.getElementById('hm-inspector-name');
                var stageEl = document.getElementById('hm-inspector-stage');
                var fruitEl = document.getElementById('hm-inspector-fruit');
                var statsEl = document.getElementById('hm-inspector-stats');

                if (nameEl) nameEl.textContent = plotEl.getAttribute('data-student-name') || '';
                if (stageEl) stageEl.textContent = plotEl.getAttribute('data-stage-label') || '';
                if (fruitEl) fruitEl.textContent = plotEl.getAttribute('data-fruit-label') || '';
                if (statsEl) {
                    statsEl.textContent = (plotEl.getAttribute('data-hadir') || '0') + 'x (' + (plotEl.getAttribute('data-pct') || '0') + '%)';
                }
            }

            fitView();
            window.addEventListener('resize', fitView);

            // Scroll wheel zoom
            viewport.addEventListener('wheel', function (e) {
                e.preventDefault();
                var rect = viewport.getBoundingClientRect();
                var cx = e.clientX - rect.left, cy = e.clientY - rect.top;
                var delta = e.deltaY < 0 ? 1.12 : 0.89;
                zoomAt(cx, cy, scale * delta);
            }, { passive: false });

            // Drag to pan & tap to inspect plot
            var activePointers = {};
            var pinchStartDist = null, pinchStartScale = null;

            function getDistance(p1, p2) {
                return Math.hypot(p1.x - p2.x, p1.y - p2.y);
            }

            viewport.addEventListener('pointerdown', function (e) {
                if (e.target.closest('button')) return;
                viewport.setPointerCapture(e.pointerId);
                activePointers[e.pointerId] = { x: e.clientX, y: e.clientY };
                var ids = Object.keys(activePointers);
                if (ids.length === 1) {
                    dragging = true;
                    pointerMoved = false;
                    startX = lastX = e.clientX;
                    startY = lastY = e.clientY;
                    viewport.classList.add('dragging');
                } else if (ids.length === 2) {
                    dragging = false;
                    pointerMoved = true;
                    var pts = ids.map(function (id) { return activePointers[id]; });
                    pinchStartDist = getDistance(pts[0], pts[1]);
                    pinchStartScale = scale;
                }
            });

            viewport.addEventListener('pointermove', function (e) {
                if (!activePointers[e.pointerId]) return;
                activePointers[e.pointerId] = { x: e.clientX, y: e.clientY };
                var ids = Object.keys(activePointers);

                if (ids.length === 2 && pinchStartDist) {
                    var pts = ids.map(function (id) { return activePointers[id]; });
                    var newDist = getDistance(pts[0], pts[1]);
                    var rect = viewport.getBoundingClientRect();
                    var midX = (pts[0].x + pts[1].x) / 2 - rect.left;
                    var midY = (pts[0].y + pts[1].y) / 2 - rect.top;
                    zoomAt(midX, midY, pinchStartScale * (newDist / pinchStartDist));
                } else if (dragging && ids.length === 1) {
                    if (Math.hypot(e.clientX - startX, e.clientY - startY) > 5) {
                        pointerMoved = true;
                    }
                    originX += e.clientX - lastX;
                    originY += e.clientY - lastY;
                    lastX = e.clientX;
                    lastY = e.clientY;
                    applyTransform();
                }
            });

            function endPointer(e) {
                if (!pointerMoved && e.type === 'pointerup') {
                    var plotItem = e.target.closest('.village-plot-item');
                    if (plotItem) {
                        selectPlotElement(plotItem);
                    }
                }
                delete activePointers[e.pointerId];
                if (Object.keys(activePointers).length < 2) {
                    pinchStartDist = null;
                }
                if (Object.keys(activePointers).length === 0) {
                    dragging = false;
                    viewport.classList.remove('dragging');
                }
            }
            viewport.addEventListener('pointerup', endPointer);
            viewport.addEventListener('pointercancel', endPointer);
            viewport.addEventListener('pointerleave', endPointer);

            // Zoom & Focus controls
            var zoomInBtn = document.getElementById('village-zoom-in');
            var zoomOutBtn = document.getElementById('village-zoom-out');
            var zoomResetBtn = document.getElementById('village-zoom-reset');
            var focusMineBtn = document.getElementById('village-focus-mine');
            var jumpSelect = document.getElementById('village-jump-select');

            if (zoomInBtn) zoomInBtn.addEventListener('click', function () {
                zoomAt(viewport.clientWidth / 2, viewport.clientHeight / 2, scale * 1.25);
            });
            if (zoomOutBtn) zoomOutBtn.addEventListener('click', function () {
                zoomAt(viewport.clientWidth / 2, viewport.clientHeight / 2, scale / 1.25);
            });
            if (zoomResetBtn) zoomResetBtn.addEventListener('click', fitView);

            if (focusMineBtn) {
                focusMineBtn.addEventListener('click', function () {
                    var myPlot = document.querySelector('.village-plot-item[data-student-id="{{ auth()->id() }}"]');
                    if (myPlot) focusPlotElement(myPlot);
                });
            }

            if (jumpSelect) {
                jumpSelect.addEventListener('change', function () {
                    if (!this.value) return;
                    var targetPlot = document.querySelector('.village-plot-item[data-student-id="' + this.value + '"]');
                    if (targetPlot) focusPlotElement(targetPlot);
                });
            }
        })();
        </script>

        <!-- Card Persentase Kehadiran Kajian & Card Jadwal Sholat Maguwoharjo Sleman -->
        <section class="space-y-6">
            @include('dashboard.partials.attendance_gauge_card')
            @include('dashboard.partials.kajian_prayer_card')
        </section>

        <!-- Bento Grid Stats -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            
            <!-- Streak Counter -->
            <div class="md:col-span-4 bg-tertiary-fixed border-3 border-on-background neobrutal-shadow p-6 rounded-xl flex flex-col justify-between h-64">
                <div class="flex justify-between items-start">
                    <span class="font-label-sm text-label-sm uppercase text-on-tertiary-fixed font-bold">Kajian Streak</span>
                    <span class="material-symbols-outlined text-4xl text-on-tertiary-fixed" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                </div>
                <div>
                    <div class="font-display-lg text-display-lg text-on-tertiary-fixed leading-none tracking-tighter">{{ auth()->user()->current_streak ?? 0 }}</div>
                    <div class="font-headline-md text-headline-md text-on-tertiary-fixed font-bold">Hari Tanpa Putus</div>
                </div>
                <div class="bg-white border-2 border-on-background p-2 rounded-lg text-sm font-bold text-center mt-2">
                    Sesi Selesai: {{ auth()->user()->total_attendance ?? 0 }} Sesi
                </div>
            </div>

            <!-- Attendance Progress Chart -->
            <div class="md:col-span-8 bg-white border-3 border-on-background neobrutal-shadow p-6 rounded-xl flex flex-col justify-between">
                <div>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-3xl p-1 bg-secondary-container border-2 border-on-background rounded-lg">calendar_today</span>
                            <h3 class="font-headline-md text-headline-md text-primary font-black">Riwayat Kehadiran (7 Sesi)</h3>
                        </div>
                        <div class="flex flex-wrap gap-2 text-[10px] font-black">
                            <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-secondary border-2 border-on-background rounded-full"></span> Hadir</span>
                            <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-primary-fixed-dim border-2 border-on-background rounded-full"></span> Izin</span>
                            <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-tertiary-fixed border-2 border-on-background rounded-full"></span> Sakit</span>
                            <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 bg-error-container border-2 border-on-background rounded-full"></span> Alpha</span>
                        </div>
                    </div>
                    
                    @php
                        $displayLogs = [];
                        $logCount = count($recentLogs);
                        
                        // Pad to 7 items if less
                        for ($i = 0; $i < 7; $i++) {
                            if ($i < 7 - $logCount) {
                                $displayLogs[] = [
                                    'date' => '-',
                                    'status' => 'empty',
                                    'session' => '-',
                                    'time' => '-'
                                ];
                            } else {
                                $realLog = $recentLogs[$i - (7 - $logCount)];
                                $displayLogs[] = [
                                    'date' => \Carbon\Carbon::parse($realLog->attendance_date)->isoFormat('DD MMM'),
                                    'status' => $realLog->status,
                                    'session' => $realLog->session_type,
                                    'time' => \Carbon\Carbon::parse($realLog->attendance_time)->format('H:i')
                                ];
                            }
                        }

                        $heights = [
                            'H' => 'h-full',
                            'I' => 'h-[65%]',
                            'S' => 'h-[65%]',
                            'A' => 'h-[25%]',
                            'empty' => 'h-[10%]'
                        ];

                        $bgColors = [
                            'H' => 'bg-secondary text-white',
                            'I' => 'bg-primary-fixed-dim text-primary',
                            'S' => 'bg-tertiary-fixed text-tertiary',
                            'A' => 'bg-error-container text-on-error-container',
                            'empty' => 'bg-surface-variant/40 border-dashed border-outline text-on-surface-variant'
                        ];

                        $statusLabels = [
                            'H' => 'Hadir',
                            'I' => 'Izin',
                            'S' => 'Sakit',
                            'A' => 'Alpha',
                            'empty' => '-'
                        ];
                    @endphp

                    <div class="flex items-end justify-between h-36 border-b-3 border-on-background pb-2 mt-4 px-2">
                        @foreach($displayLogs as $log)
                            <div class="flex-1 flex flex-col justify-end items-center h-full group relative">
                                <!-- Tooltip on Hover -->
                                @if($log['status'] !== 'empty')
                                    <div class="absolute bottom-full mb-2 hidden group-hover:block bg-zinc-900 text-white text-[10px] font-bold p-2 border-2 border-on-background rounded-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] z-30 text-center w-24">
                                        <div class="uppercase text-[9px] font-black text-secondary">{{ $log['session'] }}</div>
                                        <div class="font-normal">{{ $log['time'] }} WIB</div>
                                        <div class="font-black mt-1">{{ $statusLabels[$log['status']] }}</div>
                                    </div>
                                @endif

                                <!-- Vertical Column Bar -->
                                <div class="w-8 sm:w-10 border-3 border-on-background rounded-t-lg transition-all group-hover:-translate-y-1 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] overflow-hidden {{ $heights[$log['status']] }} {{ $bgColors[$log['status']] }} flex flex-col justify-between py-1.5 items-center">
                                    <span class="text-xs font-black">{{ $log['status'] === 'empty' ? '-' : $log['status'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- X-Axis Labels -->
                <div class="flex justify-between border-t-2 border-on-background pt-2 text-[10px] font-black text-on-surface-variant font-bold px-2">
                    @foreach($displayLogs as $log)
                        <div class="flex-1 text-center flex flex-col items-center">
                            <span>{{ $log['date'] }}</span>
                            <span class="text-[8px] opacity-75 font-normal uppercase mt-0.5">{{ $log['status'] === 'empty' ? '-' : $log['session'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Mitsur Duo & Setoran Hafalan Widgets -->
            @php
                $simakanCfg = \App\Models\Setting::getSimakanConfig();
                $myLastSetoran = \App\Models\TahfizhSetoran::where('student_id', auth()->id())
                    ->latest('tanggal_setor')
                    ->latest('id')
                    ->first();
                $myTotalBaris = (int) \App\Models\TahfizhSetoran::where('student_id', auth()->id())
                    ->where('predikat', '!=', 'Mengulang')
                    ->sum('jumlah_baris');
            @endphp
            <div class="md:col-span-5 flex flex-col gap-6">
                <div class="bg-secondary-container border-3 border-on-background neobrutal-shadow p-6 rounded-xl">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="material-symbols-outlined text-on-secondary-container text-3xl p-2 bg-white border-2 border-on-background rounded-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">diversity_3</span>
                        <h3 class="font-headline-md text-headline-md text-on-secondary-container">Mitsur Duo</h3>
                    </div>
                    <a href="{{ route('mitsur') }}" class="flex items-center gap-4 bg-white border-3 border-on-background p-4 rounded-lg neobrutal-shadow-sm mt-4 hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-all">
                        <div class="w-12 h-12 rounded-lg border-2 border-on-background overflow-hidden flex items-center justify-center bg-surface-variant shrink-0">
                            <span class="material-symbols-outlined text-3xl text-on-surface-variant">person_search</span>
                        </div>
                        <div>
                            <div class="font-headline-md text-[16px] font-bold text-on-surface leading-tight">Cari Partner</div>
                            <div class="text-xs font-bold text-on-surface-variant mt-0.5">Mulai Muroja'ah Bersama!</div>
                        </div>
                    </a>
                </div>

                <!-- Kartu Kendali Setoran Hafalan Widget -->
                <div class="bg-amber-100 dark:bg-amber-950/30 border-3 border-on-background neobrutal-shadow p-5 rounded-xl flex flex-col justify-between">
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <div class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-amber-900 text-2xl p-1.5 bg-[#FFDE00] border-2 border-black rounded-lg shadow-[2px_2px_0_0_#000]">menu_book</span>
                            <div>
                                <h3 class="font-headline-md text-base font-black text-on-background leading-tight">Setoran Hafalan</h3>
                                <p class="text-[10px] font-bold text-on-surface-variant">Min Baru: {{ $simakanCfg['min_baris_ziyadah'] ?? 2 }} Brs · Muroja'ah: {{ $simakanCfg['min_baris_murojaah'] ?? 6 }} Brs</p>
                            </div>
                        </div>
                        <span class="bg-white dark:bg-zinc-800 border-2 border-on-background px-2.5 py-1 rounded-lg text-xs font-black">
                            {{ $myTotalBaris }} Baris
                        </span>
                    </div>

                    @if($myLastSetoran)
                        <div class="bg-white dark:bg-zinc-900 border-2 border-on-background rounded-lg p-3 mb-3 text-xs font-bold">
                            <div class="flex items-center justify-between">
                                <span class="font-black text-primary">Terakhir: QS. {{ $myLastSetoran->surah }}</span>
                                <span class="bg-[#86EFAC] text-black px-1.5 py-0.5 rounded border border-black text-[10px] font-black">{{ $myLastSetoran->jumlah_baris }} Brs</span>
                            </div>
                            <p class="text-[11px] text-on-surface-variant mt-1">
                                {{ $myLastSetoran->jenis_label }} · {{ $myLastSetoran->predikat }} · Ust. {{ $myLastSetoran->penyimak_nama }}
                            </p>
                        </div>
                    @endif

                    <a href="{{ route('setoran.index') }}" class="w-full bg-primary text-on-primary border-2 border-on-background py-2.5 px-4 rounded-lg font-black text-xs uppercase flex items-center justify-center gap-1.5 shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                        <span>Lihat Kartu Kendali Setoran</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>


        </div>

        <!-- Streak Leaderboard Section -->
        <section class="mt-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl text-orange-500" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                    Kajian Streak Teratas
                </h3>
                <button id="btn-lihat-semua" class="text-sm font-bold text-primary hover:text-secondary border-b-2 border-primary hover:border-secondary transition-colors cursor-pointer">
                    Lihat Semua
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($topStreaks as $index => $student)
                    @php
                        $rankColors = [
                            0 => 'bg-amber-100 text-amber-800 border-amber-400',
                            1 => 'bg-slate-100 text-slate-800 border-slate-400',
                            2 => 'bg-orange-100 text-orange-800 border-orange-400',
                        ];
                        $rankBadges = [
                            0 => '🥇',
                            1 => '🥈',
                            2 => '🥉',
                        ];
                    @endphp
                    <div class="bg-white border-3 border-on-background p-5 rounded-xl neobrutal-shadow-sm flex items-center justify-between hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all {{ auth()->id() === $student->id ? 'border-primary' : '' }}">
                        <div class="flex items-center gap-4">
                            <!-- Rank Badge -->
                            <div class="w-8 h-8 rounded-lg border-2 border-on-background flex items-center justify-center font-black text-sm {{ $rankColors[$index] ?? 'bg-surface' }}">
                                {{ $rankBadges[$index] ?? '#' . ($index + 1) }}
                            </div>
                            <!-- Avatar -->
                            <div class="w-12 h-12 rounded-lg border-2 border-on-background bg-secondary-container overflow-hidden flex items-center justify-center">
                                <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $student->avatar ?? ($student->username ?? $student->name) }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="User Avatar" />
                            </div>
                            <!-- Name and Label -->
                            <div>
                                <h4 class="font-headline-md text-[16px] font-black leading-tight flex items-center gap-1">
                                    {{ explode(' ', $student->name)[0] }}
                                    @if(auth()->id() === $student->id)
                                        <span class="text-[10px] bg-secondary-container text-on-secondary-container border border-on-background px-1.5 py-0.5 rounded font-bold">Kamu</span>
                                    @endif
                                </h4>
                                <p class="text-xs text-on-surface-variant font-medium">{{ $student->title ?? 'Santri' }}</p>
                            </div>
                        </div>
                        <!-- Streak count -->
                        <div class="flex items-center gap-1 bg-tertiary-fixed text-on-tertiary-fixed border-2 border-on-background px-3 py-1.5 rounded-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] font-bold font-headline-md">
                            <span class="text-sm font-black">{{ $student->current_streak }}</span>
                            <span class="material-symbols-outlined text-lg leading-none" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Refleksi Harian Section -->
        @php
            $nowWib = \Carbon\Carbon::now('Asia/Jakarta');
            $reflectionCutoff = \Carbon\Carbon::today('Asia/Jakarta')->setTime(7, 0, 0);
            $canAttendViaReflection = $nowWib->lte($reflectionCutoff);
        @endphp
        <section class="mt-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
                <div>
                    <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-3xl text-primary" style="font-variation-settings: 'FILL' 1;">psychology</span>
                        Refleksi Harian Santri
                    </h3>
                    <p class="text-xs font-bold mt-1 {{ $canAttendViaReflection ? 'text-secondary' : 'text-on-surface-variant' }}">
                        @if($canAttendViaReflection)
                            🟢 Absen Kajian Pagi via refleksi dibuka s/d 07:00 WIB.
                        @else
                            🕒 Batas absen via refleksi (07:00 WIB) telah tutup — pengisian saat ini tercatat sebagai jurnal harian.
                        @endif
                    </p>
                </div>
                <a href="{{ route('refleksi') }}" class="bg-primary text-on-primary border-3 border-on-background px-4 py-2 rounded-lg font-bold shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-xs md:text-sm flex items-center justify-center gap-1.5 shrink-0">
                    <span class="material-symbols-outlined text-base">edit_note</span>
                    Tulis Refleksi Saya
                </a>
            </div>
            
            @php
                $bgClasses = [
                    0 => 'bg-amber-50 dark:bg-yellow-950/20',
                    1 => 'bg-cyan-50 dark:bg-cyan-950/20',
                    2 => 'bg-rose-50 dark:bg-rose-950/20',
                    3 => 'bg-emerald-50 dark:bg-emerald-950/20',
                    4 => 'bg-violet-50 dark:bg-violet-950/20',
                    5 => 'bg-blue-50 dark:bg-blue-950/20',
                ];
            @endphp

            <div id="reflection-carousel" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($reflections as $reflection)
                    <div data-reflection-page="{{ intdiv($loop->index, 5) }}" class="reflection-card {{ $loop->index >= 5 ? 'hidden' : '' }} relative overflow-hidden border-3 border-on-background rounded-xl p-5 neobrutal-shadow-sm flex flex-col justify-between min-h-[220px] transition-all hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] {{ $bgClasses[$loop->index % 6] }}">
                        <!-- Cartoon Background Elements (Absolute) -->
                        @if($loop->index % 6 === 0)
                            <!-- Cloud -->
                            <div class="absolute right-[-10px] bottom-[-10px] w-24 h-24 opacity-15 dark:opacity-30 pointer-events-none">
                                <svg viewBox="0 0 100 100" class="w-full h-full fill-secondary-container stroke-on-background" stroke-width="3">
                                    <path d="M20,50 C20,35 40,30 50,40 C55,30 75,35 75,50 C85,50 85,65 75,70 C70,80 30,80 25,70 C15,65 15,50 20,50 Z" />
                                    <path d="M38,55 Q42,50 46,55" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M54,55 Q58,50 62,55" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M48,63 Q50,66 52,63" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                        @elseif($loop->index % 6 === 1)
                            <!-- Sparkle Star -->
                            <div class="absolute right-[-10px] bottom-[-10px] w-24 h-24 opacity-15 dark:opacity-30 pointer-events-none">
                                <svg viewBox="0 0 100 100" class="w-full h-full fill-tertiary-fixed-dim stroke-on-background" stroke-width="3">
                                    <path d="M50,10 L58,38 L86,38 L63,55 L72,83 L50,66 L28,83 L37,55 L14,38 L42,38 Z" />
                                </svg>
                            </div>
                        @elseif($loop->index % 6 === 2)
                            <!-- Sun -->
                            <div class="absolute right-[-10px] bottom-[-10px] w-24 h-24 opacity-15 dark:opacity-30 pointer-events-none">
                                <svg viewBox="0 0 100 100" class="w-full h-full fill-amber-200 stroke-on-background" stroke-width="3">
                                    <circle cx="50" cy="50" r="22" />
                                    <path d="M50,15 L50,5 M50,85 L50,95 M15,50 L5,50 M85,50 L95,50 M25,25 L18,18 M75,75 L82,82 M25,75 L18,82 M75,25 L82,18" stroke="#000" stroke-width="3" stroke-linecap="round" />
                                </svg>
                            </div>
                        @elseif($loop->index % 6 === 3)
                            <!-- Heart -->
                            <div class="absolute right-[-10px] bottom-[-10px] w-24 h-24 opacity-15 dark:opacity-30 pointer-events-none">
                                <svg viewBox="0 0 100 100" class="w-full h-full fill-red-200 stroke-on-background" stroke-width="3">
                                    <path d="M50,30 C50,30 45,15 30,15 C15,15 10,25 10,40 C10,60 40,80 50,85 C60,80 90,60 90,40 C90,25 85,15 70,15 C55,15 50,30 50,30 Z" />
                                </svg>
                            </div>
                        @elseif($loop->index % 6 === 4)
                            <!-- Cute Smile -->
                            <div class="absolute right-[-10px] bottom-[-10px] w-24 h-24 opacity-15 dark:opacity-30 pointer-events-none">
                                <svg viewBox="0 0 100 100" class="w-full h-full fill-indigo-200 stroke-on-background" stroke-width="3">
                                    <circle cx="50" cy="50" r="25" />
                                    <path d="M42,45 Q45,40 48,45 M52,45 Q55,40 58,45" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M40,58 Q50,70 60,58" fill="none" stroke="#000" stroke-width="3" stroke-linecap="round"/>
                                </svg>
                            </div>
                        @else
                            <!-- Rocket / Sparkles -->
                            <div class="absolute right-[-10px] bottom-[-10px] w-24 h-24 opacity-15 dark:opacity-30 pointer-events-none">
                                <svg viewBox="0 0 100 100" class="w-full h-full fill-teal-200 stroke-on-background" stroke-width="3">
                                    <path d="M50,15 L53,30 L68,33 L53,36 L50,51 L47,36 L32,33 L47,30 Z" />
                                    <path d="M20,60 L22,68 L30,70 L22,72 L20,80 L18,72 L10,70 L18,68 Z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="relative z-10 flex-grow">
                            <!-- User Header -->
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-full border-2 border-on-background bg-secondary-container overflow-hidden flex items-center justify-center shrink-0">
                                    <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $reflection->user->avatar ?? ($reflection->user->username ?? $reflection->name) }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="User Avatar" />
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-headline-md text-sm font-black leading-tight truncate">{{ $reflection->name }}</h4>
                                    <p class="text-[10px] text-on-surface-variant font-semibold">
                                        {{ $reflection->created_at ? $reflection->created_at->diffForHumans() : '-' }}
                                    </p>
                                </div>
                            </div>
                            @if($reflection->topic)
                                <span class="inline-flex items-center gap-1 bg-tertiary-fixed border-2 border-on-background text-tertiary px-2 py-0.5 rounded-md text-[10px] font-bold mb-2">
                                    <span class="material-symbols-outlined text-xs">menu_book</span>
                                    {{ $reflection->topic->title }}
                                </span>
                            @endif
                            <!-- Text -->
                            <p class="font-body-md text-sm text-on-background leading-relaxed whitespace-pre-wrap line-clamp-4">"{{ $reflection->content }}"</p>
                            @if(strlen($reflection->content) > 180)
                                <button type="button"
                                    class="reflection-see-more block mt-2 text-xs font-bold text-primary underline hover:no-underline"
                                    data-index="{{ $loop->index }}">
                                    Lihat Selengkapnya
                                </button>
                                <template data-full-content="{{ $loop->index }}">{{ $reflection->content }}</template>
                                <span data-full-name="{{ $loop->index }}" class="hidden">{{ $reflection->name }}</span>
                                <span data-full-time="{{ $loop->index }}" class="hidden">{{ $reflection->created_at ? $reflection->created_at->diffForHumans() : '-' }}</span>
                            @endif
                        </div>

                        <!-- Bottom Stats / Actions -->
                        <div class="relative z-10 mt-4 pt-3 border-t border-on-background/10 flex items-center justify-between text-xs text-on-surface-variant font-bold shrink-0">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">schedule</span>
                                {{ $reflection->created_at ? \Carbon\Carbon::parse($reflection->created_at)->format('H:i') : '' }} WIB
                            </span>
                            <span class="flex items-center gap-1 text-secondary">
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                {{ $reflection->likes ?? 0 }} Suka
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full relative overflow-hidden bg-amber-50 dark:bg-yellow-950/20 border-3 border-on-background rounded-xl p-8 text-center neobrutal-shadow flex flex-col items-center justify-center">
                        <svg viewBox="0 0 100 100" class="w-20 h-20 fill-secondary-container stroke-on-background mb-4" stroke-width="3">
                            <path d="M20,50 C20,35 40,30 50,40 C55,30 75,35 75,50 C85,50 85,65 75,70 C70,80 30,80 25,70 C15,65 15,50 20,50 Z" />
                            <path d="M38,55 Q42,50 46,55" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                            <path d="M54,55 Q58,50 62,55" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                            <path d="M48,63 Q50,66 52,63" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <p class="font-headline-md text-lg font-black text-primary mb-2">Belum Ada Jurnal Refleksi Hari Ini</p>
                        <p class="text-sm text-on-surface-variant mb-4 max-w-md">Jadilah yang pertama menuliskan rasa syukur dan evaluasi dirimu hari ini!</p>
                        <a href="{{ route('refleksi') }}" class="bg-primary text-on-primary border-3 border-on-background px-6 py-2.5 rounded-lg font-bold shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm">
                            Tulis Refleksi Saya
                        </a>
                    </div>
                @endforelse
            </div>

            @if($reflections->count() > 5)
                <div id="reflection-carousel-nav" class="flex items-center justify-center gap-2 mt-5">
                    <button type="button" id="reflection-carousel-prev" class="w-9 h-9 flex items-center justify-center bg-surface border-2 border-on-background rounded-lg font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-1px] hover:translate-y-[-1px] active:translate-x-0 active:translate-y-0 active:shadow-none transition-all" aria-label="Halaman sebelumnya">
                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                    </button>
                    @for($i = 0; $i < (int) ceil($reflections->count() / 5); $i++)
                        <button type="button" data-reflection-page-btn="{{ $i }}" class="min-w-9 h-9 px-2 flex items-center justify-center border-2 border-on-background rounded-lg font-bold text-sm transition-all {{ $i === 0 ? 'bg-primary text-on-primary' : 'bg-surface text-on-background' }}" aria-label="Halaman refleksi {{ $i + 1 }}">{{ $i + 1 }}</button>
                    @endfor
                    <button type="button" id="reflection-carousel-next" class="w-9 h-9 flex items-center justify-center bg-surface border-2 border-on-background rounded-lg font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-1px] hover:translate-y-[-1px] active:translate-x-0 active:translate-y-0 active:shadow-none transition-all" aria-label="Halaman berikutnya">
                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                    </button>
                </div>
            @endif
        </section>

        <!-- Saran & Masukan Section (Neobrutalist Colorful Form) -->
        <section class="bg-violet-100 dark:bg-violet-950/20 border-3 border-on-background p-6 rounded-xl neobrutal-shadow relative overflow-hidden">
            <!-- Decorative Sparkles / Shapes -->
            <div class="absolute right-[-10px] top-[-10px] w-20 h-20 opacity-20 pointer-events-none">
                <svg viewBox="0 0 100 100" class="w-full h-full fill-violet-300 stroke-on-background" stroke-width="3">
                    <path d="M50,15 L53,30 L68,33 L53,36 L50,51 L47,36 L32,33 L47,30 Z" />
                </svg>
            </div>
            
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg border-2 border-on-background bg-yellow-300 flex items-center justify-center font-black text-xl shadow-[2px_2px_0_0_#000]">📣</div>
                <div>
                    <h3 class="font-headline-md text-xl font-black text-primary">Saran & Masukan untuk Pengasuh/Admin</h3>
                    <p class="text-xs text-on-surface-variant font-bold mt-0.5">Pendapatmu sangat berarti untuk kemajuan pondok Daaru Hiraa</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-emerald-100 text-emerald-800 border-2 border-emerald-400 p-4 rounded-lg font-bold text-xs shadow-[2px_2px_0_0_#000]">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('saran.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="saran_message" class="block text-xs font-black uppercase text-on-background mb-2">Tulis Masukan/Saran Anda di Sini:</label>
                    <textarea 
                        id="saran_message" 
                        name="message" 
                        rows="3" 
                        required
                        class="w-full bg-white dark:bg-zinc-800 border-3 border-on-background p-3 rounded-lg focus:outline-none text-sm font-bold text-black dark:text-white"
                        placeholder="Contoh: Tolong jadwal kajian malam minggu digeser lebih awal agar waktu istirahat cukup..."
                    ></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-[10px] text-gray-500 font-bold uppercase">
                        ✍️ Dikirim sebagai: <span class="bg-yellow-200 text-black px-1.5 py-0.5 rounded border border-black">{{ auth()->user()->name }}</span>
                    </p>
                    <button type="submit" class="bg-yellow-300 hover:bg-yellow-400 text-black border-3 border-on-background px-6 py-2.5 rounded-lg font-black text-xs shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all cursor-pointer">
                        Kirim Saran
                    </button>
                </div>
            </form>
        </section>

    </div>
</main>

<!-- BottomNavBar Removed -->

<!-- Floating Action Button (FAB) -->
<a href="{{ route('attendance.scan') }}" class="fixed bottom-24 right-6 md:bottom-8 md:right-8 w-14 h-14 bg-primary text-on-primary border-3 border-on-background rounded-full neobrutal-shadow flex items-center justify-center hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all z-40">
    <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
</a>

<!-- Streak Modal Popup -->
<div id="streak-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div id="streak-modal-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Content -->
    <div class="bg-white border-3 border-on-background rounded-xl neobrutal-shadow max-w-md w-full mx-4 overflow-hidden relative z-50 max-h-[80vh] flex flex-col transition-all">
        <!-- Modal Header -->
        <div class="p-5 border-b-3 border-on-background bg-secondary-container flex justify-between items-center">
            <h3 class="font-headline-md text-[20px] font-black text-on-secondary-container flex items-center gap-2" id="modal-title">
                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                Semua Streak Santri
            </h3>
            <button id="btn-close-modal" class="w-8 h-8 border-2 border-on-background rounded-lg flex items-center justify-center bg-white hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] cursor-pointer">
                <span class="material-symbols-outlined text-lg font-black text-on-background">close</span>
            </button>
        </div>

        <!-- Modal Body (Scrollable List) -->
        <div class="p-5 overflow-y-auto flex-grow space-y-3 bg-background dark:bg-surface-container">
            @foreach($allStreaks as $index => $student)
                @php
                    $isTop3 = $index < 3;
                    $rankColors = [
                        0 => 'bg-amber-100 text-amber-800 border-amber-400',
                        1 => 'bg-slate-100 text-slate-800 border-slate-400',
                        2 => 'bg-orange-100 text-orange-800 border-orange-400',
                    ];
                    $rankBadges = [
                        0 => '🥇',
                        1 => '🥈',
                        2 => '🥉',
                    ];
                @endphp
                <div class="flex items-center justify-between p-3 border-2 border-on-background rounded-lg bg-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-y-[-1px] transition-transform {{ auth()->id() === $student->id ? 'border-primary bg-secondary-container/10' : '' }}">
                    <div class="flex items-center gap-3">
                        <!-- Rank -->
                        <div class="w-7 h-7 rounded border border-on-background flex items-center justify-center font-bold text-xs {{ $isTop3 ? ($rankColors[$index] ?? 'bg-surface') : 'bg-surface-variant text-on-surface-variant' }}">
                            {{ $isTop3 ? ($rankBadges[$index] ?? '#'.($index+1)) : ($index + 1) }}
                        </div>
                        <!-- Avatar -->
                        <div class="w-10 h-10 rounded border border-on-background bg-secondary-container overflow-hidden flex items-center justify-center">
                            <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $student->avatar ?? ($student->username ?? $student->name) }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="User Avatar" />
                        </div>
                        <!-- Name -->
                        <div>
                            <h4 class="font-headline-md text-sm font-black leading-tight flex items-center gap-1">
                                {{ $student->name }}
                                @if(auth()->id() === $student->id)
                                    <span class="text-[9px] bg-secondary-container text-on-secondary-container border border-on-background px-1 py-0.2 rounded font-bold">Kamu</span>
                                @endif
                            </h4>
                            <p class="text-[10px] text-on-surface-variant font-semibold">{{ $student->title ?? 'Santri' }}</p>
                        </div>
                    </div>
                    <!-- Streak -->
                    <div class="flex items-center gap-1 bg-tertiary-fixed text-on-tertiary-fixed border border-on-background px-2.5 py-1 rounded shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] font-bold">
                        <span class="text-xs font-black">{{ $student->current_streak }}</span>
                        <span class="material-symbols-outlined text-sm leading-none" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    const streakModal = document.getElementById('streak-modal');
    const btnLihatSemua = document.getElementById('btn-lihat-semua');
    const btnCloseModal = document.getElementById('btn-close-modal');
    const modalBackdrop = document.getElementById('streak-modal-backdrop');

    if (streakModal && btnLihatSemua && btnCloseModal && modalBackdrop) {
        btnLihatSemua.addEventListener('click', function() {
            streakModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        const hideModal = function() {
            streakModal.classList.add('hidden');
            document.body.style.overflow = '';
        };

        btnCloseModal.addEventListener('click', hideModal);
        modalBackdrop.addEventListener('click', hideModal);
        
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !streakModal.classList.contains('hidden')) {
                hideModal();
            }
        });
    }
</script>

<script>
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    }

    // Mobile Sidebar Toggle
    const hamburgerToggle = document.getElementById('hamburger-toggle');
    const sidebarClose = document.getElementById('sidebar-close');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const sidebarMenu = document.querySelector('aside');

    function openSidebar() {
        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('hidden');
            setTimeout(() => {
                sidebarOverlay.classList.add('opacity-100');
                sidebarOverlay.classList.remove('opacity-0');
            }, 50);
        }
        if (sidebarMenu) {
            sidebarMenu.classList.remove('-translate-x-full');
            sidebarMenu.classList.add('translate-x-0');
        }
    }

    function closeSidebar() {
        if (sidebarOverlay) {
            sidebarOverlay.classList.add('opacity-0');
            sidebarOverlay.classList.remove('opacity-100');
            setTimeout(() => {
                sidebarOverlay.classList.add('hidden');
            }, 300);
        }
        if (sidebarMenu) {
            sidebarMenu.classList.remove('translate-x-0');
            sidebarMenu.classList.add('-translate-x-full');
        }
    }

    if (hamburgerToggle) {
        hamburgerToggle.addEventListener('click', openSidebar);
    }
    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }
</script>

<x-calendar-modal />

<!-- Reflection "Lihat Selengkapnya" Modal -->
<div id="reflection-modal" class="fixed inset-0 z-[900] hidden bg-on-background/50 flex items-center justify-center p-4">
    <div class="bg-surface border-3 border-on-background rounded-xl p-6 max-w-lg w-full neobrutal-shadow max-h-[80vh] overflow-y-auto relative">
        <button type="button" id="reflection-modal-close" class="absolute top-4 right-4 bg-error text-on-error w-8 h-8 rounded border-2 border-on-background hover:scale-105 active:scale-95 transition-transform flex items-center justify-center font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:shadow-none cursor-pointer">
            <span class="material-symbols-outlined text-lg">close</span>
        </button>
        <div class="mb-4 pr-10">
            <h4 id="reflection-modal-name" class="font-headline-md text-base font-black text-primary"></h4>
            <p id="reflection-modal-time" class="text-xs text-on-surface-variant font-semibold"></p>
        </div>
        <p id="reflection-modal-content" class="font-body-md text-sm text-on-background leading-relaxed whitespace-pre-wrap break-words"></p>
    </div>
</div>

<script>
(function () {
    var pages = document.querySelectorAll('.reflection-card');
    var pageBtns = document.querySelectorAll('[data-reflection-page-btn]');
    var prevBtn = document.getElementById('reflection-carousel-prev');
    var nextBtn = document.getElementById('reflection-carousel-next');
    var totalPages = pageBtns.length;
    var currentPage = 0;
    var autoTimer = null;

    function showPage(page) {
        currentPage = page;
        pages.forEach(function (card) {
            var cardPage = parseInt(card.getAttribute('data-reflection-page'), 10);
            card.classList.toggle('hidden', cardPage !== page);
        });
        pageBtns.forEach(function (btn) {
            var btnPage = parseInt(btn.getAttribute('data-reflection-page-btn'), 10);
            var active = btnPage === page;
            btn.classList.toggle('bg-primary', active);
            btn.classList.toggle('text-on-primary', active);
            btn.classList.toggle('bg-surface', !active);
            btn.classList.toggle('text-on-background', !active);
        });
    }

    function goToPage(page) {
        showPage((page + totalPages) % totalPages);
    }

    function resetAutoTimer() {
        if (autoTimer) clearInterval(autoTimer);
        if (totalPages > 1) {
            autoTimer = setInterval(function () { goToPage(currentPage + 1); }, 5000);
        }
    }

    if (totalPages > 1) {
        pageBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                goToPage(parseInt(btn.getAttribute('data-reflection-page-btn'), 10));
                resetAutoTimer();
            });
        });
        if (prevBtn) prevBtn.addEventListener('click', function () { goToPage(currentPage - 1); resetAutoTimer(); });
        if (nextBtn) nextBtn.addEventListener('click', function () { goToPage(currentPage + 1); resetAutoTimer(); });
        resetAutoTimer();
    }

    // Lihat Selengkapnya modal
    var modal = document.getElementById('reflection-modal');
    var modalName = document.getElementById('reflection-modal-name');
    var modalTime = document.getElementById('reflection-modal-time');
    var modalContent = document.getElementById('reflection-modal-content');
    var modalClose = document.getElementById('reflection-modal-close');

    function openReflectionModal(index) {
        var fullContent = document.querySelector('template[data-full-content="' + index + '"]');
        var fullName = document.querySelector('[data-full-name="' + index + '"]');
        var fullTime = document.querySelector('[data-full-time="' + index + '"]');
        modalName.textContent = fullName ? fullName.textContent : '';
        modalTime.textContent = fullTime ? fullTime.textContent : '';
        modalContent.textContent = fullContent ? fullContent.content.textContent : '';
        modal.classList.remove('hidden');
    }

    function closeReflectionModal() {
        modal.classList.add('hidden');
    }

    document.querySelectorAll('.reflection-see-more').forEach(function (btn) {
        btn.addEventListener('click', function () {
            openReflectionModal(btn.getAttribute('data-index'));
        });
    });

    if (modalClose) modalClose.addEventListener('click', closeReflectionModal);
    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeReflectionModal();
        });
    }
})();
</script>


<!-- ========================= -->
<!-- PWA Install Banner        -->
<!-- ========================= -->
<div id="pwa-install-banner" class="hidden fixed bottom-0 left-0 right-0 z-[999] p-4 md:p-6 md:bottom-6 md:left-auto md:right-6 md:max-w-sm">
    <div class="bg-surface border-3 border-on-background shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] rounded-2xl p-4 flex items-start gap-3">
        <div class="w-14 h-14 shrink-0 rounded-xl overflow-hidden border-2 border-on-background">
            <img src="/icons/icon-192.png" alt="Icon" class="w-full h-full object-cover">
        </div>
        <div class="flex-1 min-w-0">
            <p class="font-headline-md text-[14px] font-black text-primary leading-tight">Install Daaru Hiraa</p>
            <p class="text-[11px] text-on-surface-variant mt-0.5 mb-3">Akses lebih cepat dari layar utama HP kamu, tanpa browser!</p>
            <div class="flex gap-2">
                <button id="pwa-install-btn" class="flex-1 bg-primary text-on-primary border-2 border-on-background px-3 py-2 rounded-lg font-bold text-[12px] shadow-[3px_3px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[2px_2px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer">
                    📲 Install
                </button>
                <button id="pwa-dismiss-btn" class="px-3 py-2 border-2 border-on-background rounded-lg text-[12px] font-bold text-on-surface-variant hover:bg-surface-container transition-colors cursor-pointer bg-surface">
                    Nanti
                </button>
            </div>
        </div>
        <button id="pwa-close-btn" class="shrink-0 w-7 h-7 flex items-center justify-center border-2 border-on-background rounded-lg text-on-surface-variant hover:bg-error-container cursor-pointer bg-surface transition-colors">
            <span class="material-symbols-outlined text-base">close</span>
        </button>
    </div>
</div>

<!-- Offline indicator toast -->
<div id="offline-toast" class="hidden fixed top-20 left-1/2 -translate-x-1/2 z-[1000] bg-on-surface text-inverse-on-surface text-[13px] font-bold px-5 py-2.5 rounded-full border-2 border-on-background shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] flex items-center gap-2">
    <span class="material-symbols-outlined text-base">wifi_off</span>
    Mode Offline — Data mungkin tidak terbaru
</div>

<script>
// =========================================================
// Service Worker Registration & Push Notification Setup
// =========================================================
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js', { scope: '/' })
            .then(reg => {
                console.log('[PWA] Service Worker registered:', reg.scope);
                // Try to setup push notifications once SW is ready
                setupPushNotifications(reg);
            })
            .catch(err => console.warn('[PWA] SW registration failed:', err));
    });
}

function setupPushNotifications(registration) {
    // Check if push messaging and notification permission are supported
    if (!('PushManager' in window) || !('Notification' in window)) {
        console.warn('[PWA Push] Push notifications not supported on this browser.');
        return;
    }

    // Ask user for permission if not granted yet
    if (Notification.permission === 'default') {
        // We can show a quiet prompt or ask directly. Let's ask directly for now.
        setTimeout(() => {
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    subscribeUser(registration);
                }
            });
        }, 5000); // Ask 5 seconds after load so it's not too intrusive
    } else if (Notification.permission === 'granted') {
        subscribeUser(registration);
    }
}

function subscribeUser(registration) {
    const publicKey = '{{ config("webpush.vapid.public_key") }}';
    if (!publicKey) {
        console.warn('[PWA Push] VAPID public key not found in config.');
        return;
    }

    const applicationServerKey = urlBase64ToUint8Array(publicKey);
    
    registration.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: applicationServerKey
    })
    .then(subscription => {
        console.log('[PWA Push] User subscribed:', subscription);
        sendSubscriptionToServer(subscription);
    })
    .catch(err => {
        console.error('[PWA Push] Failed to subscribe user:', err);
    });
}

function sendSubscriptionToServer(subscription) {
    fetch('/push/subscribe', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(subscription)
    })
    .then(res => res.json())
    .then(data => console.log('[PWA Push] Subscription saved on server:', data))
    .catch(err => console.error('[PWA Push] Failed to save subscription on server:', err));
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

// =========================================================
// PWA Install Banner
// =========================================================
let deferredPrompt = null;
const installBanner = document.getElementById('pwa-install-banner');
const installBtn = document.getElementById('pwa-install-btn');
const dismissBtn = document.getElementById('pwa-dismiss-btn');
const closeBtn = document.getElementById('pwa-close-btn');

// Capture the install prompt
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;

    // Don't show if user dismissed before
    const dismissed = sessionStorage.getItem('pwa-banner-dismissed');
    if (!dismissed) {
        // Show banner after 3 seconds
        setTimeout(() => {
            installBanner.classList.remove('hidden');
            installBanner.style.animation = 'slideUpBanner 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards';
        }, 3000);
    }
});

// Handle install click
if (installBtn) {
    installBtn.addEventListener('click', async () => {
        if (!deferredPrompt) return;
        deferredPrompt.prompt();
        const { outcome } = await deferredPrompt.userChoice;
        console.log('[PWA] Install outcome:', outcome);
        deferredPrompt = null;
        installBanner.classList.add('hidden');
    });
}

function dismissBanner() {
    installBanner.classList.add('hidden');
    sessionStorage.setItem('pwa-banner-dismissed', '1');
}

if (dismissBtn) dismissBtn.addEventListener('click', dismissBanner);
if (closeBtn) closeBtn.addEventListener('click', dismissBanner);

// Hide banner when app is installed
window.addEventListener('appinstalled', () => {
    console.log('[PWA] App installed!');
    installBanner.classList.add('hidden');
    deferredPrompt = null;
    // Show success toast
    showToast('🎉 Daaru Hiraa berhasil diinstall!', 3000);
});

// =========================================================
// Offline/Online indicator
// =========================================================
const offlineToast = document.getElementById('offline-toast');

function updateOnlineStatus() {
    if (!navigator.onLine) {
        offlineToast.classList.remove('hidden');
    } else {
        offlineToast.classList.add('hidden');
    }
}

window.addEventListener('online', updateOnlineStatus);
window.addEventListener('offline', updateOnlineStatus);
updateOnlineStatus();

function showToast(msg, duration = 3000) {
    const t = document.createElement('div');
    t.className = 'fixed top-20 left-1/2 -translate-x-1/2 z-[1001] bg-secondary text-on-secondary text-[13px] font-bold px-5 py-2.5 rounded-full border-2 border-on-background shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] flex items-center gap-2';
    t.style.animation = 'fadeInDown 0.3s ease forwards';
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), duration);
}
</script>
<style>
@keyframes slideUpBanner {
    from { transform: translateY(100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
@keyframes fadeInDown {
    from { transform: translate(-50%, -20px); opacity: 0; }
    to { transform: translate(-50%, 0); opacity: 1; }
}
</style>

</body>
</html>

