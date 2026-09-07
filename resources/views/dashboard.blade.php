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

        @keyframes sway {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(2.5deg); }
        }
        .animate-sway {
            transform-origin: bottom center;
            animation: sway 6s ease-in-out infinite;
        }

        @keyframes cloud-move {
            0% { transform: translateX(-20px); }
            50% { transform: translateX(20px); }
            100% { transform: translateX(-20px); }
        }
        .animate-cloud-1 {
            animation: cloud-move 12s ease-in-out infinite;
        }
        .animate-cloud-2 {
            animation: cloud-move 18s ease-in-out infinite;
        }

        @keyframes leaf-fall {
            0% { transform: translateY(-10px) translateX(0) rotate(0deg); opacity: 0; }
            20% { opacity: 1; }
            80% { opacity: 1; }
            100% { transform: translateY(90px) translateX(25px) rotate(120deg); opacity: 0; }
        }
        .animate-leaf-1 {
            animation: leaf-fall 6s linear infinite;
        }
        .animate-leaf-2 {
            animation: leaf-fall 8s linear infinite 3s;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
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

        @if(auth()->user()->title === 'Musyrif' && count($flaggedSantri) > 0)
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

        <!-- 🌱 KEBUN KEBAIKAN PONDOK (Virtual Shared Garden) -->
        @php
            $status = $setting->garden_status ?? 'subur';
            $message = $setting->garden_message ?? 'Mari hiasi hari kita dengan zikir dan kajian berilmu di pondok Daaru Hiraa.';
            
            // Konfigurasi warna langsung via Hex untuk bypass JIT compile
            $skyColorHex = '#bae6fd'; // default: cyan-200 / sky-200
            $soilColorHex = '#34d399'; // default: emerald-400
            $sunClass = 'text-yellow-400';
            
            if ($status === 'subur_sekali') {
                $skyColorHex = '#7dd3fc'; // sky-300
            } elseif ($status === 'biasa') {
                $skyColorHex = '#fed7aa'; // orange-200 (sore)
                $sunClass = 'text-orange-400 translate-y-6';
            } elseif ($status === 'kering') {
                $skyColorHex = '#fef3c7'; // amber-100 (kering)
                $sunClass = 'text-amber-500 translate-y-12';
                $soilColorHex = '#ca8a04'; // yellow-600 (tanah kering)
            }
        @endphp
        <section class="bg-white border-3 border-on-background rounded-xl neobrutal-shadow overflow-hidden">
            <!-- Header Kebun -->
            <div class="p-4 border-b-3 border-on-background bg-emerald-300 text-black font-black uppercase text-xs tracking-widest flex items-center justify-between">
                <span class="flex items-center gap-2">🌱 Kebun Kebaikan Daaru Hiraa</span>
                <span class="text-[10px] bg-white px-2 py-0.5 border border-black rounded shadow-[1px_1px_0_0_#000] dark:text-black">
                    Kondisi: 
                    @if($status === 'subur_sekali') 🌳 Sangat Subur
                    @elseif($status === 'subur') 🌿 Subur
                    @elseif($status === 'biasa') 🍃 Kurang Subur
                    @else 🍂 Layu / Kering
                    @endif
                </span>
            </div>

            <!-- Canvas Kebun (Menggunakan inline style height & background agar selalu tampil) -->
            <div class="relative overflow-hidden border-b-3 border-on-background transition-colors duration-500" style="height: 180px; background-color: {{ $skyColorHex }};">
                <!-- Awan-awan (Bergerak lambat) -->
                @if($status !== 'kering')
                    <div class="absolute top-4 left-6 text-white/70 animate-cloud-1">
                        <svg class="w-12 h-8 fill-current" viewBox="0 0 100 100"><path d="M20,50 C20,35 40,30 50,40 C55,30 75,35 75,50 C85,50 85,65 75,70 C70,80 30,80 25,70 C15,65 15,50 20,50 Z"/></svg>
                    </div>
                    <div class="absolute top-8 right-12 text-white/50 animate-cloud-2">
                        <svg class="w-16 h-10 fill-current" viewBox="0 0 100 100"><path d="M20,50 C20,35 40,30 50,40 C55,30 75,35 75,50 C85,50 85,65 75,70 C70,80 30,80 25,70 C15,65 15,50 20,50 Z"/></svg>
                    </div>
                @else
                    <!-- Awan Mendung / Abu-abu -->
                    <div class="absolute top-4 left-6 text-gray-400/80 animate-cloud-1">
                        <svg class="w-14 h-9 fill-current" viewBox="0 0 100 100"><path d="M20,50 C20,35 40,30 50,40 C55,30 75,35 75,50 C85,50 85,65 75,70 C70,80 30,80 25,70 C15,65 15,50 20,50 Z"/></svg>
                    </div>
                @endif

                <!-- Matahari -->
                <div class="absolute top-4 right-6 w-12 h-12 {{ $sunClass }} transition-transform duration-700">
                    <svg class="w-full h-full fill-current stroke-black stroke-[3px] {{ $status === 'subur_sekali' ? 'animate-spin-slow' : '' }}" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="22" />
                        @if($status === 'subur_sekali' || $status === 'subur')
                            <path d="M50,15 L50,5 M50,85 L50,95 M15,50 L5,50 M85,50 L95,50 M25,25 L18,18 M75,75 L82,82 M25,75 L18,82 M75,25 L82,18" stroke="#000" stroke-width="4" stroke-linecap="round" />
                        @endif
                    </svg>
                </div>

                <!-- Gambar Kebun SVG (Pohon Organik Detil Neobrutalisme) -->
                <svg viewBox="0 0 500 200" preserveAspectRatio="none" style="width: 100%; height: 100%; position: absolute; bottom: 0; left: 0;">
                    <!-- Bukit Belakang (Shadow) -->
                    <path d="M-20,155 Q150,105 320,145 T520,125 L520,220 L-20,220 Z" fill="#047857" opacity="0.35" class="stroke-black" stroke-width="4" />

                    <!-- Bukit Depan (Tanah/Gundukan rumput utama) -->
                    <path d="M-20,165 Q120,140 250,160 T520,145 L520,220 L-20,220 Z" fill="{{ $soilColorHex }}" class="stroke-black" stroke-width="4" />

                    <!-- Pagar Kayu Neobrutalist Kiri -->
                    <g transform="translate(20, 135)">
                        <rect x="0" y="5" width="6" height="28" fill="#fef08a" stroke="black" stroke-width="2.5"/>
                        <rect x="15" y="2" width="6" height="31" fill="#fef08a" stroke="black" stroke-width="2.5"/>
                        <rect x="30" y="5" width="6" height="28" fill="#fef08a" stroke="black" stroke-width="2.5"/>
                        <line x1="-5" y1="12" x2="40" y2="12" stroke="black" stroke-width="3"/>
                        <line x1="-5" y1="22" x2="40" y2="22" stroke="black" stroke-width="3"/>
                    </g>

                    <!-- Pagar Kayu Neobrutalist Kanan -->
                    <g transform="translate(430, 125)">
                        <rect x="0" y="5" width="6" height="28" fill="#fef08a" stroke="black" stroke-width="2.5"/>
                        <rect x="15" y="2" width="6" height="31" fill="#fef08a" stroke="black" stroke-width="2.5"/>
                        <rect x="30" y="5" width="6" height="28" fill="#fef08a" stroke="black" stroke-width="2.5"/>
                        <line x1="-5" y1="12" x2="40" y2="12" stroke="black" stroke-width="3"/>
                        <line x1="-5" y1="22" x2="40" y2="22" stroke="black" stroke-width="3"/>
                    </g>

                    <!-- Tanaman Hias & Bunga Neobrutalist -->
                    @if($status === 'subur_sekali' || $status === 'subur')
                        <!-- Bunga Merah Mekar Kiri -->
                        <g transform="translate(85, 142)">
                            <path d="M0,25 Q-3,10 0,0" stroke="black" stroke-width="3.5" fill="none" />
                            <path d="M0,15 Q-10,12 -8,5 Z" fill="#22c55e" stroke="black" stroke-width="2" />
                            <circle cx="0" cy="0" r="8" fill="#fde047" stroke="black" stroke-width="2.5" />
                            <circle cx="-9" cy="-4" r="6" fill="#f43f5e" stroke="black" stroke-width="2" />
                            <circle cx="9" cy="-4" r="6" fill="#f43f5e" stroke="black" stroke-width="2" />
                            <circle cx="0" cy="-10" r="6" fill="#f43f5e" stroke="black" stroke-width="2" />
                            <circle cx="-6" cy="7" r="6" fill="#f43f5e" stroke="black" stroke-width="2" />
                            <circle cx="6" cy="7" r="6" fill="#f43f5e" stroke="black" stroke-width="2" />
                        </g>

                        <!-- Bunga Ungu Mekar Kanan -->
                        <g transform="translate(385, 138)">
                            <path d="M0,28 Q4,12 0,0" stroke="black" stroke-width="3.5" fill="none" />
                            <path d="M0,18 Q10,14 8,7 Z" fill="#22c55e" stroke="black" stroke-width="2" />
                            <circle cx="0" cy="0" r="7" fill="#fde047" stroke="black" stroke-width="2.5" />
                            <circle cx="-8" cy="-5" r="5.5" fill="#a855f7" stroke="black" stroke-width="2" />
                            <circle cx="8" cy="-5" r="5.5" fill="#a855f7" stroke="black" stroke-width="2" />
                            <circle cx="0" cy="-9" r="5.5" fill="#a855f7" stroke="black" stroke-width="2" />
                            <circle cx="-5" cy="6" r="5.5" fill="#a855f7" stroke="black" stroke-width="2" />
                            <circle cx="5" cy="6" r="5.5" fill="#a855f7" stroke="black" stroke-width="2" />
                        </g>
                    @endif

                    @if($status === 'subur_sekali')
                        <!-- Bunga Oranye Kiri Tambahan -->
                        <g transform="translate(145, 148)">
                            <path d="M0,18 L0,0" stroke="black" stroke-width="2.5" />
                            <circle cx="0" cy="0" r="6" fill="#fb923c" stroke="black" stroke-width="2" />
                        </g>
                        <!-- Bunga Kuning Kanan Tambahan -->
                        <g transform="translate(335, 145)">
                            <path d="M0,20 L0,0" stroke="black" stroke-width="2.5" />
                            <circle cx="0" cy="0" r="7" fill="#facc15" stroke="black" stroke-width="2" />
                        </g>
                    @endif

                    <!-- POHON UTAMA ORGANIK DETIL NEOBRUTALISME -->
                    <g transform="translate(250, 175)">
                        <g class="animate-sway">
                            <!-- Batang Utama Berakar & Bertekstur -->
                            <!-- Akar & Dasar Batang -->
                            <path d="M-18,0 C-22,-20 -14,-40 -12,-70 Q-10,-95 -4,-115 Q4,-95 10,-70 C12,-40 20,-20 18,0 Z" fill="#8B4513" stroke="black" stroke-width="4" />
                            <!-- Serat Kayu Batang -->
                            <path d="M-5,-20 Q-8,-45 -4,-70 M3,-15 Q6,-40 2,-65" stroke="#5c2c06" stroke-width="2.5" stroke-linecap="round" fill="none" />

                            <!-- Dahan/Cabang Organik Kiri & Kanan -->
                            <path d="M-8,-65 Q-25,-80 -38,-95 M-25,-80 Q-35,-65 -45,-75" stroke="#8B4513" stroke-width="5" stroke-linecap="round" fill="none" />
                            <path d="M-8,-65 Q-25,-80 -38,-95 M-25,-80 Q-35,-65 -45,-75" stroke="black" stroke-width="5.5" stroke-linecap="round" fill="none" class="opacity-30" />
                            <path d="M6,-75 Q28,-90 42,-105 M22,-88 Q32,-75 45,-82" stroke="#8B4513" stroke-width="5" stroke-linecap="round" fill="none" />

                            <!-- CANOPY DEDAUNAN ORGANIK BERLAYAR (Bukan sekadar lingkaran kaku) -->
                            @if($status === 'subur_sekali')
                                <!-- Layer 1: Daun Belakang (Gelap) -->
                                <path d="M-60,-130 C-85,-155 -60,-195 -25,-195 C0,-215 45,-205 60,-180 C80,-180 90,-145 70,-130 C85,-105 55,-85 30,-95 C10,-80 -35,-90 -45,-110 Z" fill="#047857" stroke="black" stroke-width="4.5" />
                                
                                <!-- Layer 2: Daun Tengah (Hijau Segar) -->
                                <path d="M-50,-135 C-70,-155 -45,-185 -15,-185 C5,-200 40,-195 50,-170 C68,-170 75,-140 58,-125 C70,-105 45,-90 22,-98 C5,-85 -30,-95 -40,-115 Z" fill="#10B981" stroke="black" stroke-width="4" />
                                
                                <!-- Layer 3: Daun Depan (Terang Highlight) -->
                                <path d="M-35,-140 C-50,-155 -30,-175 -5,-175 C10,-188 32,-182 40,-162 C55,-162 60,-138 46,-125 C55,-110 35,-98 18,-105 C5,-92 -20,-102 -28,-118 Z" fill="#34D399" stroke="black" stroke-width="3.5" />

                                <!-- Buah Apel Merah & Buah Emas Kartun -->
                                <g transform="translate(-32, -150)">
                                    <circle cx="0" cy="0" r="7.5" fill="#EF4444" stroke="black" stroke-width="2" />
                                    <path d="M0,-7 Q2,-10 4,-11" stroke="black" stroke-width="1.5" />
                                </g>
                                <g transform="translate(25, -165)">
                                    <circle cx="0" cy="0" r="7.5" fill="#EF4444" stroke="black" stroke-width="2" />
                                    <path d="M0,-7 Q2,-10 4,-11" stroke="black" stroke-width="1.5" />
                                </g>
                                <g transform="translate(45, -128)">
                                    <circle cx="0" cy="0" r="7" fill="#FACC15" stroke="black" stroke-width="2" />
                                    <path d="M0,-6 Q2,-9 4,-10" stroke="black" stroke-width="1.5" />
                                </g>
                                <g transform="translate(-40, -118)">
                                    <circle cx="0" cy="0" r="7" fill="#FACC15" stroke="black" stroke-width="2" />
                                    <path d="M0,-6 Q2,-9 4,-10" stroke="black" stroke-width="1.5" />
                                </g>
                                <g transform="translate(0, -125)">
                                    <circle cx="0" cy="0" r="8" fill="#EF4444" stroke="black" stroke-width="2" />
                                    <path d="M0,-7 Q2,-10 4,-11" stroke="black" stroke-width="1.5" />
                                </g>

                            @elseif($status === 'subur')
                                <!-- Layer 1: Daun Belakang -->
                                <path d="M-52,-120 C-72,-142 -50,-175 -20,-175 C0,-192 38,-185 50,-162 C68,-162 76,-132 58,-118 C70,-98 42,-80 20,-88 C2,-75 -32,-85 -40,-102 Z" fill="#059669" stroke="black" stroke-width="4.5" />
                                
                                <!-- Layer 2: Daun Depan -->
                                <path d="M-40,-125 C-58,-142 -35,-168 -10,-168 C8,-182 32,-175 42,-155 C56,-155 62,-130 48,-118 C58,-102 34,-88 15,-95 C0,-82 -25,-92 -32,-108 Z" fill="#10B981" stroke="black" stroke-width="3.5" />

                                <!-- Buah Apel Merah -->
                                <g transform="translate(-20, -140)">
                                    <circle cx="0" cy="0" r="7" fill="#EF4444" stroke="black" stroke-width="2" />
                                    <path d="M0,-6 Q2,-9 4,-10" stroke="black" stroke-width="1.5" />
                                </g>
                                <g transform="translate(22, -125)">
                                    <circle cx="0" cy="0" r="7" fill="#EF4444" stroke="black" stroke-width="2" />
                                    <path d="M0,-6 Q2,-9 4,-10" stroke="black" stroke-width="1.5" />
                                </g>

                            @elseif($status === 'biasa')
                                <!-- Daun Sedang -->
                                <path d="M-40,-110 C-55,-128 -35,-150 -8,-150 C8,-162 28,-156 38,-138 C50,-138 55,-115 42,-105 C50,-90 30,-78 12,-84 C0,-72 -22,-80 -28,-95 Z" fill="#84CC16" stroke="black" stroke-width="4" />

                            @else
                                <!-- Kering / Layu (Pohon Ranting Tanpa Daun / Daun Kecokelatan) -->
                                <path d="M-25,-95 C-35,-110 -20,-125 -5,-125 C5,-135 20,-130 28,-115 C38,-115 40,-98 30,-90 Z" fill="#D97706" stroke="black" stroke-width="3.5" />
                            @endif
                        </g>
                    </g>

                    <!-- Animasi Daun Berguguran (Khusus status Layu/Kering/Biasa) -->
                    @if($status === 'kering' || $status === 'biasa')
                        <g class="animate-leaf-1" transform="translate(230, 80)">
                            <path d="M0,0 Q10,-10 20,0 Q10,10 0,0" fill="#D97706" stroke="black" stroke-width="1.5"/>
                        </g>
                        <g class="animate-leaf-2" transform="translate(260, 95)">
                            <path d="M0,0 Q10,-10 20,0 Q10,10 0,0" fill="#B45309" stroke="black" stroke-width="1.5"/>
                        </g>
                    @endif
                </svg>
            </div>

            <!-- Papan Motivasi (Neobrutalist Board) -->
            <div class="p-4 bg-yellow-50 dark:bg-yellow-950/20 border-t-3 border-on-background flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-start gap-3">
                    <span class="text-2xl shrink-0 select-none">💬</span>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Pesan Pengasuh & Admin</p>
                        <p class="text-xs font-bold text-black dark:text-white leading-relaxed mt-0.5">
                            "{{ $message }}"
                        </p>
                    </div>
                </div>
            </div>
        </section>

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

            <!-- Mitsur Duo Widget -->
            <div class="md:col-span-5 bg-secondary-container border-3 border-on-background neobrutal-shadow p-6 rounded-xl">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-symbols-outlined text-on-secondary-container text-3xl p-2 bg-white border-2 border-on-background rounded-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">diversity_3</span>
                    <h3 class="font-headline-md text-headline-md text-on-secondary-container">Mitsur Duo</h3>
                </div>
                <a href="{{ route('mitsur') }}" class="flex items-center gap-4 bg-white border-3 border-on-background p-4 rounded-lg neobrutal-shadow-sm mt-6 hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-all">
                    <div class="w-14 h-14 rounded-lg border-2 border-on-background overflow-hidden flex items-center justify-center bg-surface-variant">
                        <span class="material-symbols-outlined text-4xl text-on-surface-variant">person_search</span>
                    </div>
                    <div>
                        <div class="font-headline-md text-[18px] font-bold text-on-surface leading-tight">Cari Partner</div>
                        <div class="text-xs font-bold text-on-surface-variant mt-1">Mulai Muroja'ah!</div>
                    </div>
                </a>
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

        <!-- Tanya Ustadz AI Section -->
        <section class="mt-8 bg-amber-50 dark:bg-yellow-950/10 border-3 border-on-background rounded-xl p-6 neobrutal-shadow">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-amber-600 text-3xl p-2 bg-white dark:bg-zinc-800 border-2 border-on-background rounded-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">psychology</span>
                <div>
                    <h3 class="font-headline-md text-headline-md text-primary font-black">Tanya Ustadz AI</h3>
                    <p class="text-xs text-on-surface-variant font-semibold mt-0.5">Asisten rohani virtual untuk menjawab seputar ibadah, ilmu, dan nasihat bijak.</p>
                </div>
            </div>

            <!-- Avatar & Speech Bubble Layout -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <!-- Cartoon Avatar Backdrop -->
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-2xl border-3 border-on-background bg-gradient-to-b from-sky-300 via-sky-200 to-amber-100 dark:from-indigo-950 dark:via-purple-900 dark:to-indigo-900 shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] relative overflow-hidden flex items-center justify-center shrink-0">
                    <!-- Spinning Sun -->
                    <svg class="absolute top-2 right-2 w-8 h-8 text-amber-400 dark:text-amber-300 animate-spin-slow pointer-events-none" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="12" cy="12" r="5" />
                        <path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.31 11.31l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41m14.14-14.14l-1.41 1.41" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <!-- Drifting Clouds -->
                    <svg class="absolute top-6 left-2 w-12 h-8 text-white opacity-85 dark:opacity-40 animate-drift-slow pointer-events-none" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/>
                    </svg>
                    <svg class="absolute top-10 right-4 w-8 h-6 text-white opacity-60 dark:opacity-30 animate-drift-slow pointer-events-none" style="animation-delay: -3s; animation-duration: 12s;" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/>
                    </svg>
                    <!-- Hills -->
                    <div class="absolute bottom-0 left-0 right-0 h-6 bg-emerald-400 dark:bg-emerald-800 rounded-b-xl border-t-2 border-on-background"></div>
                    <!-- Ustadz Micah Avatar -->
                    <img id="ustadz-ai-avatar" onclick="openAIChat('tanya')" src="https://api.dicebear.com/9.x/micah/svg?seed=UstadzAI&hair=turban&facialHair=beard&facialHairProbability=100&eyebrows=up&eyes=smiling&mouth=smile&backgroundColor=transparent" class="w-24 h-24 object-contain relative z-10 drop-shadow-[2px_2px_0px_rgba(0,0,0,1)] transition-transform duration-300 cursor-pointer hover:scale-105" alt="Ustadz AI" title="Klik untuk mengobrol langsung" />
                </div>

                <!-- Speech Bubble Container -->
                <div class="relative bg-white dark:bg-zinc-800 border-3 border-on-background p-5 rounded-2xl shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] flex-grow flex flex-col justify-between w-full">
                    <!-- Triangle Arrow pointers -->
                    <!-- Mobile top arrow (visible on mobile, hidden on desktop) -->
                    <div class="absolute -top-[11px] left-12 w-5 h-5 bg-white dark:bg-zinc-800 border-t-3 border-l-3 border-on-background rotate-45 md:hidden z-20"></div>
                    <!-- Desktop left arrow (hidden on mobile, visible on desktop) -->
                    <div class="absolute top-8 -left-[11px] w-5 h-5 bg-white dark:bg-zinc-800 border-b-3 border-l-3 border-on-background rotate-45 hidden md:block z-20"></div>

                    <!-- Conversation Message Bubble -->
                    <div class="min-w-0 mb-4">
                        <p class="font-body-md text-sm text-on-background leading-relaxed font-bold">Wa'alaikumussalam. Selamat datang di Tanya Ustadz AI! Silakan tanyakan apa saja seputar ibadah, ilmu syar'i, adab, presensi, atau curhat spiritual langsung di bawah ini:</p>
                    </div>

                    <!-- Unified Input Form -->
                    <form onsubmit="handleUnifiedAISubmit(event)" class="w-full flex flex-col sm:flex-row gap-3">
                        <input type="text" id="unified-ai-input" placeholder="Tulis pertanyaan Anda di sini..." class="flex-grow border-3 border-on-background p-3 rounded-xl font-bold text-sm focus:outline-none focus:bg-yellow-50 text-black dark:text-white placeholder-gray-500 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] dark:shadow-[3px_3px_0px_0px_rgba(255,255,255,1)] focus:shadow-none transition-all bg-white dark:bg-zinc-800" required>
                        <button type="submit" class="bg-primary text-on-primary font-black px-6 py-3 rounded-xl border-3 border-on-background shadow-[3px_3px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all cursor-pointer text-sm uppercase flex items-center justify-center gap-2">
                            Tanyakan <span class="material-symbols-outlined text-sm font-black">send</span>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Refleksi Harian Section -->
        <section class="mt-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl text-primary" style="font-variation-settings: 'FILL' 1;">psychology</span>
                    Refleksi Harian Santri
                </h3>
                <a href="{{ route('refleksi') }}" class="bg-primary text-on-primary border-3 border-on-background px-4 py-2 rounded-lg font-bold shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-xs md:text-sm flex items-center gap-1.5">
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($reflections as $reflection)
                    <div class="relative overflow-hidden border-3 border-on-background rounded-xl p-5 neobrutal-shadow-sm flex flex-col justify-between min-h-[220px] transition-all hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] {{ $bgClasses[$loop->index % 6] }}">
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
                            <!-- Text -->
                            <p class="font-body-md text-sm text-on-background leading-relaxed whitespace-pre-wrap line-clamp-4">"{{ $reflection->content }}"</p>
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

    // Helper function for changing Ustadz avatar states
    function setUstadzState(state) {
        const avatarEl = document.getElementById('ustadz-ai-avatar');
        if (!avatarEl) return;
        
        if (state === 'thinking') {
            avatarEl.src = "https://api.dicebear.com/9.x/micah/svg?seed=UstadzAI&hair=turban&facialHair=beard&facialHairProbability=100&eyebrows=down&eyes=eyes&mouth=nervous&backgroundColor=transparent";
            avatarEl.classList.add('animate-bounce');
        } else if (state === 'smiling') {
            avatarEl.src = "https://api.dicebear.com/9.x/micah/svg?seed=UstadzAI&hair=turban&facialHair=beard&facialHairProbability=100&eyebrows=up&eyes=smiling&mouth=smile&backgroundColor=transparent";
            avatarEl.classList.remove('animate-bounce');
        } else if (state === 'talking') {
            avatarEl.src = "https://api.dicebear.com/9.x/micah/svg?seed=UstadzAI&hair=turban&facialHair=beard&facialHairProbability=100&eyebrows=up&eyes=smiling&mouth=laughing&backgroundColor=transparent";
            avatarEl.classList.remove('animate-bounce');
        }
    }

    // Typewriter effect to display answers character-by-character
    function typeWriter(text, elementId, callback) {
        const element = document.getElementById(elementId);
        if (!element) return;
        
        element.innerHTML = '';
        let i = 0;
        const speed = 15; // ms per character
        let currentText = '';
        
        function type() {
            if (i < text.length) {
                currentText += text.charAt(i);
                element.innerText = currentText;
                i++;
                setTimeout(type, speed);
            } else {
                // Parse markdown bold (* or **) and newlines
                let formatted = currentText
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\*(.*?)\*/g, '<em>$1</em>')
                    .replace(/\n/g, '<br>');
                element.innerHTML = formatted;
                if (callback) callback();
            }
        }
        type();
    }

    // New Interactive Ustadz AI Chat functions
    let currentChatTopic = '';

    function getAIChatElements() {
        return {
            modal: document.getElementById('ai-chat-modal'),
            messagesPane: document.getElementById('chat-messages-pane'),
            messageInput: document.getElementById('chat-message-input'),
            sendBtn: document.getElementById('chat-send-btn'),
            title: document.getElementById('chat-modal-title'),
            icon: document.getElementById('chat-modal-icon'),
            header: document.getElementById('chat-modal-header'),
            backdrop: document.getElementById('ai-chat-modal-backdrop')
        };
    }

    const topicConfigs = {
        tanya: {
            title: 'Tanya Ustadz AI',
            icon: '💬',
            bgClass: 'bg-amber-200 text-amber-900',
            welcome: 'Assalamualaikum. Selamat datang di Tanya Ustadz AI! Silakan tanyakan apa saja seputar ibadah, ilmu syar\'i, adab pesantren, motivasi belajar, presensi kehadiran, atau keluh kesah harianmu.'
        },
        materi: {
            title: 'Tanya Materi Kajian',
            icon: '📖',
            bgClass: 'bg-cyan-200 text-cyan-900',
            welcome: 'Marhaban! Silakan tanyakan materi kajian, hukum fiqih, tafsir, atau syarah hadits yang ingin kamu pelajari hari ini.'
        },
        spiritual: {
            title: 'Konsultasi Spiritual',
            icon: '🌱',
            bgClass: 'bg-rose-200 text-rose-900',
            welcome: 'Assalamualaikum. Ustadz di sini siap mendengarkan keluh kesahmu. Jika kamu merasa futur, lelah, jenuh, atau butuh teman cerita, jangan sungkan berbagi.'
        },
        istiqomah: {
            title: 'Tips Istiqomah',
            icon: '🏅',
            bgClass: 'bg-amber-200 text-amber-900',
            welcome: 'Ahlan wa sahlan! Bagaimana Ustadz bisa membantumu hari ini? Mari diskusikan kiat agar kamu tetap istiqomah menuntut ilmu dan beribadah.'
        },
        adab: {
            title: 'Adab & Akhlak',
            icon: '📿',
            bgClass: 'bg-emerald-200 text-emerald-900',
            welcome: 'MasyaAllah. Mari kita pelajari bersama tentang adab menuntut ilmu dan akhlak mulia penuntut ilmu di dalam kehidupan pesantren.'
        },
        absen: {
            title: 'Presensi & Perizinan',
            icon: '📋',
            bgClass: 'bg-violet-200 text-violet-900',
            welcome: 'Assalamualaikum. Ustadz AI khusus absensi siap membantumu. Kamu bisa mengecek status kehadiran/alpha-mu, bertanya tentang sisa izin, atau mengajukan permohonan izin/sakit/cuti baru dengan mengobrol langsung di sini.'
        }
    };

    function handleUnifiedAISubmit(event) {
        event.preventDefault();
        const input = document.getElementById('unified-ai-input');
        if (!input) return;
        const msg = input.value.trim();
        if (!msg) return;
        input.value = '';
        openAIChat('tanya', msg);
    }

    function openAIChat(topic, initialMessage = '') {
        currentChatTopic = topic;
        const config = topicConfigs[topic];
        const els = getAIChatElements();
        
        if (!els.modal) return;
        
        els.title.innerText = config.title;
        els.icon.innerText = config.icon;
        
        // Remove existing theme bg classes and apply new one
        els.header.className = `p-4 border-b-3 border-on-background flex justify-between items-center text-black ${config.bgClass}`;
        
        els.modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Load History
        els.messagesPane.innerHTML = `
            <div class="flex items-center justify-center py-12 flex-col gap-2">
                <span class="material-symbols-outlined text-3xl animate-spin text-primary">sync</span>
                <span class="text-xs font-bold text-on-surface-variant">Memuat riwayat obrolan...</span>
            </div>
        `;
        
        setUstadzState('smiling');
        
        fetch(`/ai/history?topic=${topic}`)
            .then(res => res.json())
            .then(data => {
                els.messagesPane.innerHTML = '';
                
                // Add Welcome Message first
                appendMessageBubble('assistant', config.welcome);
                
                if (data.success && data.history.length > 0) {
                    data.history.forEach(msg => {
                        appendMessageBubble(msg.role, msg.message);
                    });
                }
                
                scrollChatToBottom();

                if (initialMessage) {
                    els.messageInput.value = initialMessage;
                    sendAIChatMessage();
                }
            })
            .catch(err => {
                els.messagesPane.innerHTML = '';
                appendMessageBubble('assistant', config.welcome);
                appendMessageBubble('assistant', 'Gagal memuat riwayat chat dari server. Namun kamu tetap bisa mengirim pesan baru.');
                scrollChatToBottom();
                if (initialMessage) {
                    els.messageInput.value = initialMessage;
                    sendAIChatMessage();
                }
            });
    }

    function closeAIChat() {
        const els = getAIChatElements();
        if (els.modal) els.modal.classList.add('hidden');
        document.body.style.overflow = '';
        currentChatTopic = '';
        setUstadzState('smiling');
    }

    function appendMessageBubble(role, message) {
        const els = getAIChatElements();
        if (!els.messagesPane) return;
        
        const bubble = document.createElement('div');
        bubble.className = `flex gap-3 max-w-[85%] ${role === 'user' ? 'self-end flex-row-reverse' : 'self-start'}`;
        
        const avatarUrl = role === 'user' 
            ? "{{ auth()->user()->avatar ? 'https://api.dicebear.com/9.x/micah/svg?seed=' . auth()->user()->avatar . '&backgroundColor=transparent' : '' }}"
            : "https://api.dicebear.com/9.x/micah/svg?seed=UstadzAI&hair=turban&facialHair=beard&facialHairProbability=100&eyebrows=up&eyes=smiling&mouth=smile&backgroundColor=transparent";
            
        const avatarFallback = role === 'user' 
            ? "{{ substr(auth()->user()->name, 0, 1) }}"
            : "U";
            
        const avatarHtml = avatarUrl 
            ? `<img src="${avatarUrl}" class="w-8 h-8 rounded-full border-2 border-on-background object-cover bg-secondary-container" alt="Avatar"/>`
            : `<div class="w-8 h-8 rounded-full border-2 border-on-background flex items-center justify-center bg-secondary-container text-xs font-bold">${avatarFallback}</div>`;

        // Extract reasoning/thinking if present
        let thinkingHtml = '';
        if (message.includes('<thinking>') && message.includes('</thinking>')) {
            const startIdx = message.indexOf('<thinking>') + 10;
            const endIdx = message.indexOf('</thinking>');
            const thinkingText = message.substring(startIdx, endIdx).trim();
            message = message.substring(endIdx + 11).trim();

            if (thinkingText) {
                let formattedThinking = thinkingText
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\*(.*?)\*/g, '<em>$1</em>')
                    .replace(/\n/g, '<br>');

                thinkingHtml = `
                    <details class="mb-3 border-2 border-black rounded-lg overflow-hidden bg-zinc-50 dark:bg-zinc-900 group">
                        <summary class="flex justify-between items-center px-3 py-2 text-[10px] font-black uppercase bg-zinc-200 dark:bg-zinc-800 cursor-pointer select-none border-b-2 border-black">
                            <span class="flex items-center gap-1.5 text-zinc-600 dark:text-zinc-400">
                                <span class="material-symbols-outlined text-xs animate-pulse">psychology</span>
                                Analisis Pemikiran AI
                            </span>
                            <span class="material-symbols-outlined text-xs transition-transform duration-200 group-open:rotate-180">expand_more</span>
                        </summary>
                        <div class="p-3 text-[10px] text-zinc-500 dark:text-zinc-400 leading-relaxed font-mono max-h-40 overflow-y-auto select-text break-words">
                            ${formattedThinking}
                        </div>
                    </details>
                `;
            }
        }

        // Format code / markdown newlines
        let formattedText = message
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/\n/g, '<br>');

        const contentClass = role === 'user'
            ? 'bg-secondary text-white border-2 border-on-background rounded-2xl rounded-tr-none px-3.5 py-2 text-sm font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]'
            : 'bg-white dark:bg-zinc-800 text-on-background border-2 border-on-background rounded-2xl rounded-tl-none px-3.5 py-2 text-sm font-bold shadow-[2px_2px_0px_0px_rgba(var(--neobrutal-shadow-color),1)]';

        bubble.innerHTML = `
            <div class="shrink-0 flex items-start">
                ${avatarHtml}
            </div>
            <div class="${contentClass} min-w-0">
                ${thinkingHtml}
                <p class="leading-relaxed text-xs md:text-sm text-left break-words font-bold select-text">${formattedText}</p>
            </div>
        `;
        
        els.messagesPane.appendChild(bubble);
    }

    function scrollChatToBottom() {
        const els = getAIChatElements();
        if (els.messagesPane) {
            els.messagesPane.scrollTop = els.messagesPane.scrollHeight;
        }
    }

    function sendAIChatMessage() {
        const els = getAIChatElements();
        if (!els.modal || !currentChatTopic) return;

        const msg = els.messageInput.value.trim();
        if (!msg) return;
        
        // Clear input and disable elements
        els.messageInput.value = '';
        els.messageInput.disabled = true;
        els.sendBtn.disabled = true;
        
        // Append user bubble
        appendMessageBubble('user', msg);
        scrollChatToBottom();
        
        // Append placeholder typing indicator
        const typingIndicator = document.createElement('div');
        typingIndicator.id = 'ai-typing-indicator';
        typingIndicator.className = 'flex gap-3 max-w-[85%] self-start';
        typingIndicator.innerHTML = `
            <div class="shrink-0">
                <img src="https://api.dicebear.com/9.x/micah/svg?seed=UstadzAI&hair=turban&facialHair=beard&facialHairProbability=100&eyebrows=up&eyes=smiling&mouth=smile&backgroundColor=transparent" class="w-8 h-8 rounded-full border-2 border-on-background object-cover bg-secondary-container" alt="Avatar"/>
            </div>
            <div class="bg-white dark:bg-zinc-800 text-on-background border-2 border-on-background rounded-2xl rounded-tl-none px-3.5 py-2 text-sm font-bold shadow-[2px_2px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] animate-pulse">
                <span>Memikirkan jawaban...</span>
            </div>
        `;
        els.messagesPane.appendChild(typingIndicator);
        scrollChatToBottom();
        
        setUstadzState('thinking');
        
        fetch('/ai/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                topic: currentChatTopic,
                message: msg
            })
        })
        .then(res => res.json())
        .then(data => {
            // Remove typing indicator
            const indicator = document.getElementById('ai-typing-indicator');
            if (indicator) indicator.remove();
            
            els.messageInput.disabled = false;
            els.sendBtn.disabled = false;
            els.messageInput.focus();
            
            setUstadzState('talking');
            
            if (data.success) {
                appendMessageBubble('assistant', data.message);
                setTimeout(() => setUstadzState('smiling'), 1000);
            } else {
                appendMessageBubble('assistant', 'Terjadi kesalahan sistem. Silakan coba kirim ulang pesan Anda.');
                setUstadzState('smiling');
            }
            scrollChatToBottom();
        })
        .catch(err => {
            const indicator = document.getElementById('ai-typing-indicator');
            if (indicator) indicator.remove();
            
            els.messageInput.disabled = false;
            els.sendBtn.disabled = false;
            
            setUstadzState('smiling');
            
            appendMessageBubble('assistant', 'Koneksi gagal. Periksa jaringan internet Anda.');
            scrollChatToBottom();
        });
    }

    // Speech Recognition for Student AI Chat
    let studentRecognition = null;
    let isStudentListening = false;

    function initStudentSpeechRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) {
            console.warn('Speech recognition not supported in this browser.');
            const micBtn = document.getElementById('student-mic-btn');
            if (micBtn) micBtn.style.display = 'none';
            return null;
        }

        const rec = new SpeechRecognition();
        rec.lang = 'id-ID';
        rec.continuous = false;
        rec.interimResults = false;

        rec.onstart = function() {
            isStudentListening = true;
            const micIcon = document.getElementById('student-mic-icon');
            const micBtn = document.getElementById('student-mic-btn');
            if (micIcon) micIcon.innerText = 'settings_voice';
            if (micBtn) {
                micBtn.classList.remove('bg-yellow-300');
                micBtn.classList.add('bg-red-400', 'animate-pulse');
            }
            const els = getAIChatElements();
            if (els.messageInput) els.messageInput.placeholder = 'Mendengarkan suara Anda...';
        };

        rec.onend = function() {
            isStudentListening = false;
            const micIcon = document.getElementById('student-mic-icon');
            const micBtn = document.getElementById('student-mic-btn');
            if (micIcon) micIcon.innerText = 'mic';
            if (micBtn) {
                micBtn.classList.remove('bg-red-400', 'animate-pulse');
                micBtn.classList.add('bg-yellow-300');
            }
            const els = getAIChatElements();
            if (els.messageInput) els.messageInput.placeholder = 'Ketik pesan Anda di sini...';
        };

        rec.onresult = function(event) {
            const text = event.results[0][0].transcript.trim();
            const els = getAIChatElements();
            if (els.messageInput && text) {
                els.messageInput.value = text;
                sendAIChatMessage();
            }
        };

        rec.onerror = function(event) {
            console.error('Speech recognition error:', event.error);
        };

        return rec;
    }

    function toggleStudentSpeechRecognition() {
        if (!studentRecognition) {
            studentRecognition = initStudentSpeechRecognition();
        }
        if (!studentRecognition) return;

        if (isStudentListening) {
            studentRecognition.stop();
        } else {
            try {
                studentRecognition.start();
            } catch (e) {
                console.error(e);
            }
        }
    }

    // Initialize listeners when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const els = getAIChatElements();
        
        if (els.messageInput) {
            els.messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendAIChatMessage();
                }
            });
        }
        
        if (els.backdrop) {
            els.backdrop.addEventListener('click', closeAIChat);
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const els = getAIChatElements();
            if (els.modal && !els.modal.classList.contains('hidden')) {
                closeAIChat();
            }
        }
    });</script>

<!-- Interactive Ustadz AI Chat Modal -->
<div id="ai-chat-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden" aria-labelledby="chat-modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div id="ai-chat-modal-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Content -->
    <div class="bg-white dark:bg-zinc-900 border-3 border-on-background rounded-xl neobrutal-shadow max-w-lg w-full mx-4 overflow-hidden relative z-50 max-h-[85vh] flex flex-col transition-all">
        <!-- Modal Header -->
        <div id="chat-modal-header" class="p-4 border-b-3 border-on-background flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span id="chat-modal-icon" class="text-2xl select-none">📖</span>
                <h3 class="font-headline-md text-lg font-black" id="chat-modal-title">
                    Tanya Ustadz AI
                </h3>
            </div>
            <button onclick="closeAIChat()" class="w-8 h-8 border-2 border-on-background rounded-lg flex items-center justify-center bg-white dark:bg-zinc-800 hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] cursor-pointer">
                <span class="material-symbols-outlined text-lg font-black text-on-background">close</span>
            </button>
        </div>

        <!-- Message Pane -->
        <div id="chat-messages-pane" class="flex-1 overflow-y-auto p-4 space-y-4 max-h-[400px] min-h-[300px] bg-background dark:bg-zinc-950 flex flex-col">
            <!-- Dynamic Messages Loaded Here -->
        </div>

        <!-- Input Area -->
        <div class="p-4 border-t-3 border-on-background bg-surface dark:bg-zinc-900 flex gap-3 items-end">
            <div class="flex-grow">
                <textarea id="chat-message-input" rows="1" class="w-full bg-white dark:bg-zinc-800 border-3 border-on-background px-4 py-2.5 rounded-lg focus:outline-none focus:ring-0 text-sm font-bold resize-none text-black dark:text-white" placeholder="Ketik pesan Anda di sini..."></textarea>
            </div>
            <button id="student-mic-btn" onclick="toggleStudentSpeechRecognition()" class="bg-yellow-300 text-black border-3 border-on-background p-2.5 rounded-lg font-bold shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all flex items-center justify-center cursor-pointer shrink-0 h-[46px]" title="Input Suara (Speech to Text)">
                <span id="student-mic-icon" class="material-symbols-outlined text-xl">mic</span>
            </button>
            <button id="chat-send-btn" onclick="sendAIChatMessage()" class="bg-primary text-on-primary border-3 border-on-background px-4 py-2.5 rounded-lg font-bold shadow-[3px_3px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all flex items-center justify-center gap-1.5 h-[46px] shrink-0">
                <span class="material-symbols-outlined text-lg">send</span>
            </button>
        </div>
    </div>
</div>

<x-calendar-modal />


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
    const publicKey = '{{ env("VAPID_PUBLIC_KEY") }}';
    if (!publicKey) {
        console.warn('[PWA Push] VAPID public key not found in env.');
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

