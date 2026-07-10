<!DOCTYPE html>
<html class="light" lang="id">
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
    <title>Profil - Daaru Hiraa</title>
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
        .neobrutal-button-active:active {
            transform: translate(6px, 6px);
            box-shadow: 0px 0px 0px 0px rgba(var(--neobrutal-shadow-color),1);
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
        
        .dark textarea, .dark select, .dark input {
            background-color: var(--surface-container-lowest) !important;
            color: var(--on-surface) !important;
            border-color: var(--outline-variant) !important;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background font-body-md selection:bg-secondary-container">

<!-- TopAppBar -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 md:px-margin-desktop py-4 bg-surface border-b-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
    <a href="{{ url('/') }}" class="font-headline-md text-headline-md font-black text-primary tracking-tighter hover:opacity-80">Daaru Hiraa</a>
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

        <div class="flex items-center gap-4">
            <div class="hidden md:block relative">
                <input class="bg-secondary-container border-3 border-on-background px-4 py-2 rounded-lg w-64 focus:outline-none focus:ring-0" placeholder="Cari kajian..." type="text"/>
            </div>
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
    </div>
</header>

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-[55] hidden opacity-0 transition-opacity duration-300 md:hidden"></div>

    <x-sidebar active="profile" />

<!-- Main Content -->
<main class="pt-[100px] md:pl-72 px-4 md:px-margin-desktop pb-24">
    
    <!-- Profile Header -->
    <section class="bg-surface-container-lowest border-3 border-on-background rounded-xl p-8 neobrutal-shadow mb-8 flex flex-col md:flex-row items-center md:items-start gap-8">
        <div class="relative group">
            <div id="profile-avatar-display" class="w-40 h-40 rounded-xl border-3 border-on-background overflow-hidden neobrutal-shadow-sm transition-transform group-hover:-translate-y-1 bg-secondary-container flex items-center justify-center text-7xl font-black text-on-secondary-container">
                @if(auth()->user()->avatar)
                    <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ auth()->user()->avatar }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="User Avatar" />
                @else
                    {{ substr(auth()->user()->name, 0, 1) }}
                @endif
            </div>
            <button type="button" onclick="openAvatarModal()" class="absolute -bottom-2 -right-2 bg-tertiary-fixed text-on-tertiary-fixed p-2 rounded-lg border-3 border-on-background neobrutal-shadow-sm hover:-translate-y-1 transition-transform">
                <span class="material-symbols-outlined text-sm">photo_camera</span>
            </button>
        </div>
        
        <div class="flex-grow text-center md:text-left">
            <div class="flex flex-col md:flex-row md:items-center gap-3 mb-2 justify-center md:justify-start">
                <h1 class="font-headline-lg text-headline-lg text-primary">{{ auth()->user()->name }}</h1>
                <span class="bg-secondary-container text-on-secondary-container px-4 py-1 rounded-full border-2 border-on-background font-label-sm inline-block">Aktif</span>
            </div>
            <p class="font-body-lg text-on-surface-variant mb-6">Role: {{ auth()->user()->title ?? 'Santri' }}</p>
            
            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                <button class="bg-surface-container-high text-on-surface font-label-sm px-6 py-3 rounded-lg border-3 border-on-background neobrutal-shadow-sm hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all neobrutal-button-active flex items-center gap-2">
                    <span class="material-symbols-outlined">badge</span>
                    Cetak Kartu Santri
                </button>
            </div>
        </div>
    </section>

    <!-- Bento Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        
        <!-- Personal Info (6 cols) -->
        <div class="lg:col-span-7 bg-surface-container-lowest border-3 border-on-background rounded-xl p-6 neobrutal-shadow flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-6 border-b-3 border-on-background pb-3">
                    <span class="material-symbols-outlined text-primary">person</span>
                    <h2 class="font-headline-md text-headline-md">Informasi Pribadi</h2>
                </div>
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="font-label-sm text-on-surface-variant block mb-1">Nama Lengkap</label>
                            <p class="font-body-md font-bold text-on-surface">{{ auth()->user()->name }}</p>
                        </div>
                        <div>
                            <label class="font-label-sm text-on-surface-variant block mb-1">Username</label>
                            <p class="font-body-md font-bold text-on-surface">{{ auth()->user()->username ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="font-label-sm text-on-surface-variant block mb-1">Hak Akses</label>
                            <p class="font-body-md font-bold text-on-surface">{{ auth()->user()->title ?? 'Santri' }}</p>
                        </div>
                        <div>
                            <label class="font-label-sm text-on-surface-variant block mb-1">Status</label>
                            <p class="font-body-md font-bold text-on-surface">{{ auth()->user()->status_aktif ?? 'Aktif' }}</p>
                        </div>
                        <div>
                            <label class="font-label-sm text-on-surface-variant block mb-1">🏛️ Universitas</label>
                            <p class="font-body-md font-bold text-on-surface">{{ auth()->user()->universitas ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="font-label-sm text-on-surface-variant block mb-1">🎓 Angkatan Kuliah</label>
                            <p class="font-body-md font-bold text-on-surface">{{ auth()->user()->angkatan ? auth()->user()->angkatan : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-secondary-container p-4 rounded-lg border-3 border-on-background mt-6">
                <label class="font-label-sm text-on-secondary-container block mb-1">Catatan Akun</label>
                <p class="font-body-md text-on-secondary-container font-medium">Akun Anda terverifikasi sebagai bagian dari ekosistem Daaru Hiraa. Tetap istiqomah dalam mencari ilmu!</p>
            </div>
        </div>

        <!-- Academic Progress (5 cols) -->
        <div class="lg:col-span-5 flex flex-col gap-gutter">
            <div class="bg-primary-container text-on-primary-container border-3 border-on-background rounded-xl p-6 neobrutal-shadow flex-grow">
                <div class="flex justify-between items-start mb-6">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined">menu_book</span>
                        <h2 class="font-headline-md text-headline-md text-on-primary-container">Statistik Kajian</h2>
                    </div>
                    <div class="text-right">
                        <span class="block font-label-sm opacity-80">Total Sesi</span>
                        <span class="text-4xl font-black">{{ auth()->user()->total_attendance ?? 0 }}</span>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between font-label-sm mb-1">
                            <span>Kajian Streak (Hari Tanpa Putus)</span>
                            <span>{{ auth()->user()->current_streak ?? 0 }} Hari</span>
                        </div>
                        @php
                            $targetStreak = 30;
                            $current = auth()->user()->current_streak ?? 0;
                            $pct = $targetStreak > 0 ? min(100, round(($current / $targetStreak) * 100)) : 0;
                        @endphp
                        <div class="h-4 bg-on-primary-container/20 rounded-full border-2 border-on-background overflow-hidden">
                            <div class="h-full bg-secondary-fixed shadow-[2px_0_0_0_rgba(0,0,0,1)]" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="font-label-sm block mb-2 opacity-80">Aktivitas Terbaru:</label>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-primary text-on-primary px-3 py-1 rounded-full border-2 border-on-background text-xs">Kehadiran ({{ date('d M') }})</span>
                            <span class="bg-primary text-on-primary px-3 py-1 rounded-full border-2 border-on-background text-xs">Tasbih Digital</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Lencana Kehormatan Santri Section -->
    <section class="bg-surface-container-lowest border-3 border-on-background rounded-xl p-8 neobrutal-shadow mt-8">
        <div class="flex items-center gap-3 mb-6 border-b-3 border-on-background pb-3">
            <span class="material-symbols-outlined text-primary text-3xl">workspace_premium</span>
            <h2 class="font-headline-md text-headline-md">Lencana Kehormatan Santri</h2>
        </div>
        <p class="text-sm font-bold text-on-surface-variant mb-6">Lencana dinamis yang diberikan otomatis berdasarkan keaktifan kehadiran, amalan dzikir, dan muhasabah harian Anda.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(auth()->user()->badges as $badge)
                <div class="relative bg-white border-3 border-on-background p-6 rounded-xl neobrutal-shadow-sm flex flex-col justify-between overflow-hidden {{ $badge['unlocked'] ? 'hover:translate-x-[-3px] hover:translate-y-[-3px] hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]' : 'opacity-70' }} transition-all">
                    
                    @if(!$badge['unlocked'])
                        <div class="absolute inset-0 bg-slate-100/10 dark:bg-zinc-900/10 backdrop-blur-[0.5px] pointer-events-none z-10"></div>
                    @endif

                    <div class="flex items-start gap-4 relative z-20">
                        <!-- Badge Circle with gradient -->
                        <div class="w-20 h-20 rounded-xl border-3 border-on-background flex-shrink-0 flex items-center justify-center text-5xl shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] bg-gradient-to-br {{ $badge['bg_class'] }} transition-transform hover:rotate-12">
                            {{ $badge['icon'] }}
                        </div>
                        
                        <div>
                            <span class="text-[9px] font-black tracking-widest uppercase {{ $badge['unlocked'] ? 'text-secondary' : 'text-on-surface-variant' }}">
                                {{ $badge['unlocked'] ? 'TERBUKA' : 'LENCANA TERKUNCI' }}
                            </span>
                            <h3 class="font-black text-lg leading-tight mt-1 text-primary">{{ $badge['name'] }}</h3>
                            <p class="text-xs text-on-surface-variant font-bold mt-2 leading-relaxed">{{ $badge['description'] }}</p>
                        </div>
                    </div>

                    <!-- Progress bar -->
                    <div class="mt-8 pt-4 border-t-2 border-dashed border-outline-variant relative z-20">
                        <div class="flex justify-between text-xs font-black text-on-surface-variant mb-2">
                            <span>Status Progres</span>
                            <span>{{ $badge['progress_text'] }} ({{ $badge['progress'] }}%)</span>
                        </div>
                        <div class="h-4 bg-surface border-3 border-on-background rounded-full overflow-hidden">
                            <div class="h-full bg-secondary transition-all" style="width: {{ $badge['progress'] }}%"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

        <!-- Avatar Selection Modal -->
        <div id="avatar-modal" class="fixed inset-0 z-[100] hidden bg-on-background/50 flex items-center justify-center p-4">
            <div class="bg-surface-container-lowest border-3 border-on-background rounded-xl p-6 neobrutal-shadow max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
                <button type="button" onclick="closeAvatarModal()" class="absolute top-4 right-4 bg-error text-on-error p-1 rounded border-2 border-on-background hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined">close</span>
                </button>
                <div class="flex items-center gap-3 mb-6 border-b-3 border-on-background pb-3">
                    <span class="material-symbols-outlined text-primary">face</span>
                    <h2 class="font-headline-md text-headline-md">Pilih Avatar Kartun Anda</h2>
                </div>
                
                @php
                    // 64 Islamic Cartoon Avatars (32 Male + 32 Female)
                    $avatarList = [
                        // --- 32 Islamic Male Avatars ---
                        // Turban (Sorban) & Beard / Scruff
                        'Ahmad&hair=turban&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=smiling',
                        'Muhammad&hair=turban&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=eyes',
                        'Yusuf&hair=turban&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100',
                        'Ibrahim&hair=turban&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=round',
                        'Omar&hair=turban&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyes=smiling',
                        'Ali&hair=turban&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100',
                        'Usman&hair=turban&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=smiling',
                        'Hamzah&hair=turban&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down',
                        
                        // Bald (Clean/Gundul) & Beard / Scruff
                        'AbuBakr&hair=mrClean&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=smiling',
                        'Bilal&hair=mrClean&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=round',
                        'Khalid&hair=mrClean&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=eyes',
                        'Tariq&hair=mrClean&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100',
                        'Salman&hair=mrClean&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up',
                        'Saad&hair=mrClean&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyes=smiling',
                        'Luqman&hair=mrClean&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100',
                        'Yahya&hair=mrClean&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down',

                        // Short Hair & Beard / Scruff
                        'Zakaria&hair=dannyPhantom&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=smiling',
                        'Hassan&hair=dougFunny&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=eyes',
                        'Hussein&hair=fonze&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=round',
                        'Mustafa&hair=full&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100',
                        'Farhan&hair=dannyPhantom&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=up',
                        'Zayd&hair=dougFunny&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyes=smiling',
                        'Abdullah&hair=fonze&facialHair=scruff&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100',
                        'Fatih&hair=full&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down',

                        // Custom combinations
                        'Hanif&hair=turban&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=smiling&shirt=collared',
                        'Imran&hair=mrClean&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=eyes&shirt=collared',
                        'Irfan&hair=dannyPhantom&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=round&shirt=collared',
                        'Rasyid&hair=dougFunny&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100&shirt=collared',
                        'Hamdan&hair=turban&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=up&shirt=crew',
                        'Azhar&hair=mrClean&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyes=smiling&shirt=crew',
                        'Yasir&hair=dannyPhantom&facialHair=scruff&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100&shirt=crew',
                        'Anas&hair=dougFunny&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down&shirt=crew',

                        // --- 48 New Islamic Male Avatars ---
                        'Abdurrahman&hair=turban&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=smiling&shirt=collared',
                        'Thariq&hair=mrClean&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=eyes&shirt=crew',
                        'Zain&hair=dannyPhantom&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100&shirt=collared',
                        'Faruq&hair=dougFunny&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=round&shirt=crew',
                        'Hafiz&hair=fonze&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyes=smiling&shirt=collared',
                        'Naufal&hair=full&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100&shirt=crew',
                        'Ridho&hair=turban&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=smiling&shirt=collared',
                        'Zuhdi&hair=mrClean&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=eyes&shirt=crew',
                        'Zidan&hair=dannyPhantom&facialHair=scruff&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100&shirt=collared',
                        'Malik&hair=dougFunny&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=round&shirt=crew',
                        'Rafi&hair=fonze&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyes=smiling&shirt=collared',
                        'Faris&hair=full&facialHair=scruff&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100&shirt=crew',
                        'Ayyub&hair=turban&facialHairProbability=0&earringsProbability=0&eyebrows=up&eyes=smiling&shirt=collared',
                        'Harun&hair=mrClean&facialHairProbability=0&earringsProbability=0&eyebrows=down&eyes=eyes&shirt=crew',
                        'Musa&hair=dannyPhantom&facialHairProbability=0&earringsProbability=0&glasses=round&glassesProbability=100&shirt=collared',
                        'Isa&hair=dougFunny&facialHairProbability=0&earringsProbability=0&eyebrows=up&eyes=round&shirt=crew',
                        'Sulaiman&hair=fonze&facialHairProbability=0&earringsProbability=0&eyes=smiling&shirt=collared',
                        'Daud&hair=full&facialHairProbability=0&earringsProbability=0&glasses=square&glassesProbability=100&shirt=crew',
                        'Nuh&hair=turban&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=smiling&shirt=collared',
                        'Luth&hair=mrClean&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=eyes&shirt=crew',
                        'Shaleh&hair=dannyPhantom&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100&shirt=collared',
                        'Hud&hair=dougFunny&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=round&shirt=crew',
                        'Idris&hair=fonze&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyes=smiling&shirt=collared',
                        'Adam&hair=full&facialHair=scruff&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100&shirt=crew',
                        'Ziyad&hair=turban&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=smiling&shirt=collared',
                        'Zakir&hair=mrClean&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=eyes&shirt=crew',
                        'Habib&hair=dannyPhantom&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100&shirt=collared',
                        'Zaki&hair=dougFunny&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=round&shirt=crew',
                        'Ghazali&hair=fonze&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyes=smiling&shirt=collared',
                        'Syafiq&hair=full&facialHair=scruff&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100&shirt=crew',
                        'Akmal&hair=turban&facialHairProbability=0&earringsProbability=0&eyebrows=down&eyes=smiling&shirt=collared',
                        'Ikram&hair=mrClean&facialHairProbability=0&earringsProbability=0&eyebrows=up&eyes=eyes&shirt=crew',
                        'Rayyan&hair=dannyPhantom&facialHairProbability=0&earringsProbability=0&glasses=round&glassesProbability=100&shirt=collared',
                        'Fadhl&hair=dougFunny&facialHairProbability=0&earringsProbability=0&eyebrows=down&eyes=round&shirt=crew',
                        'Syakir&hair=fonze&facialHairProbability=0&earringsProbability=0&eyes=smiling&shirt=collared',
                        'Taufiq&hair=full&facialHairProbability=0&earringsProbability=0&glasses=square&glassesProbability=100&shirt=crew',
                        'Basim&hair=turban&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=smiling&shirt=collared',
                        'Adil&hair=mrClean&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=eyes&shirt=crew',
                        'Majid&hair=dannyPhantom&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100&shirt=collared',
                        'Rauf&hair=dougFunny&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=round&shirt=crew',
                        'Wafi&hair=fonze&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyes=smiling&shirt=collared',
                        'Nabil&hair=full&facialHair=scruff&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100&shirt=crew',
                        'Rizal&hair=turban&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=smiling&shirt=collared',
                        'Fajar&hair=mrClean&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyebrows=up&eyes=eyes&shirt=crew',
                        'Soleh&hair=dannyPhantom&facialHair=beard&facialHairProbability=100&earringsProbability=0&glasses=round&glassesProbability=100&shirt=collared',
                        'Fuad&hair=dougFunny&facialHair=scruff&facialHairProbability=100&earringsProbability=0&eyebrows=down&eyes=round&shirt=crew',
                        'Arif&hair=fonze&facialHair=beard&facialHairProbability=100&earringsProbability=0&eyes=smiling&shirt=collared',
                        'Wahyu&hair=full&facialHair=scruff&facialHairProbability=100&earringsProbability=0&glasses=square&glassesProbability=100&shirt=crew',
                    ];
                @endphp
                <div class="grid grid-cols-4 sm:grid-cols-5 gap-4">
                    @foreach($avatarList as $seed)
                    <button type="button" onclick="selectAvatar('{{ $seed }}')" class="group relative bg-secondary-container/30 border-3 border-on-background rounded-xl aspect-square overflow-hidden hover:scale-105 hover:bg-secondary-container transition-all neobrutal-shadow-sm {{ auth()->user()->avatar === $seed ? 'ring-4 ring-primary' : '' }}">
                        <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $seed }}&backgroundColor=transparent" alt="Avatar {{ $seed }}" class="w-full h-full object-cover p-2" />
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Account Settings / Forms (12 cols) -->
        <div class="lg:col-span-12 bg-surface-container-lowest border-3 border-on-background rounded-xl p-6 neobrutal-shadow">
            @php
                $jsonPath = database_path('data/indonesian_universities.json');
                $jsonUniversities = [];
                if (file_exists($jsonPath)) {
                    $jsonUniversities = json_decode(file_get_contents($jsonPath), true) ?: [];
                }

                $dbUniversities = \App\Models\Student::whereNotNull('universitas')
                    ->where('universitas', '!=', '')
                    ->distinct()
                    ->pluck('universitas')
                    ->toArray();

                $allUniversities = collect(array_merge($jsonUniversities, $dbUniversities))
                    ->unique()
                    ->sort()
                    ->values();
            @endphp
            <datalist id="existing-universities">
                @foreach($allUniversities as $uni)
                    <option value="{{ $uni }}"></option>
                @endforeach
            </datalist>
            <div class="flex items-center gap-3 mb-6 border-b-3 border-on-background pb-3">
                <span class="material-symbols-outlined text-primary">manage_accounts</span>
                <h2 class="font-headline-md text-headline-md">Pengaturan Akun</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                
                <!-- Form Update Profil -->
                <form method="post" action="{{ route('profile.update') }}" class="space-y-4 border-b-3 md:border-b-0 md:border-r-3 border-on-background/20 pb-8 md:pb-0 md:pr-10">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="avatar" id="avatar-input" value="{{ auth()->user()->avatar }}">
                    
                    <h3 class="font-label-sm text-primary uppercase tracking-widest font-black mb-4">Ubah Informasi Pribadi</h3>
                    
                    @if (session('status') === 'profile-updated')
                        <div class="bg-secondary-container text-on-secondary-container p-3 rounded-lg border-2 border-on-background mb-4 text-sm font-bold">
                            Profil berhasil diperbarui.
                        </div>
                    @endif

                    <div>
                        <label class="font-label-sm text-on-surface-variant block mb-1">Nama Lengkap</label>
                        <input name="name" value="{{ old('name', auth()->user()->name) }}" required autofocus autocomplete="name" class="w-full bg-surface-container border-3 {{ $errors->has('name') ? 'border-error' : 'border-on-background' }} px-4 py-2 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors" type="text"/>
                        @error('name')<span class="text-error text-xs font-bold">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="font-label-sm text-on-surface-variant block mb-1">Username</label>
                        <input name="username" value="{{ old('username', auth()->user()->username) }}" class="w-full bg-surface-container border-3 {{ $errors->has('username') ? 'border-error' : 'border-on-background' }} px-4 py-2 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors" type="text"/>
                        @error('username')<span class="text-error text-xs font-bold">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="font-label-sm text-on-surface-variant block mb-1">🏛️ Universitas</label>
                        <input name="universitas" value="{{ old('universitas', auth()->user()->universitas) }}" list="existing-universities" placeholder="Contoh: Universitas Indonesia" class="w-full bg-surface-container border-3 {{ $errors->has('universitas') ? 'border-error' : 'border-on-background' }} px-4 py-2 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors" type="text"/>
                        @error('universitas')<span class="text-error text-xs font-bold">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="font-label-sm text-on-surface-variant block mb-1">🎓 Angkatan Kuliah (Tahun)</label>
                        <input name="angkatan" value="{{ old('angkatan', auth()->user()->angkatan) }}" placeholder="Contoh: 2022" class="w-full bg-surface-container border-3 {{ $errors->has('angkatan') ? 'border-error' : 'border-on-background' }} px-4 py-2 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors" type="number" min="2000" max="2099"/>
                        @error('angkatan')<span class="text-error text-xs font-bold">{{ $message }}</span>@enderror
                    </div>
                    <div class="pt-2">
                        <button id="save-profile-btn" class="bg-primary text-on-primary w-full font-label-sm px-6 py-3 rounded-lg border-3 border-on-background neobrutal-shadow-sm hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all neobrutal-button-active flex justify-center items-center gap-2" type="submit">
                            <span class="material-symbols-outlined">save</span>
                            Simpan Profil
                        </button>
                    </div>
                </form>

                <!-- Form Update Password -->
                <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    @method('put')
                    <h3 class="font-label-sm text-primary uppercase tracking-widest font-black mb-4">Ubah Kata Sandi</h3>
                    
                    @if (session('status') === 'password-updated')
                        <div class="bg-secondary-container text-on-secondary-container p-3 rounded-lg border-2 border-on-background mb-4 text-sm font-bold">
                            Kata sandi berhasil diperbarui.
                        </div>
                    @endif

                    <div>
                        <label class="font-label-sm text-on-surface-variant block mb-1">Kata Sandi Saat Ini</label>
                        <input name="current_password" required autocomplete="current-password" class="w-full bg-surface-container border-3 {{ $errors->updatePassword->has('current_password') ? 'border-error' : 'border-on-background' }} px-4 py-2 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors" placeholder="••••••••" type="password"/>
                        @if($errors->updatePassword->has('current_password'))
                            <span class="text-error text-xs font-bold">{{ $errors->updatePassword->first('current_password') }}</span>
                        @endif
                    </div>
                    <div>
                        <label class="font-label-sm text-on-surface-variant block mb-1">Kata Sandi Baru</label>
                        <input name="password" required autocomplete="new-password" class="w-full bg-surface-container border-3 {{ $errors->updatePassword->has('password') ? 'border-error' : 'border-on-background' }} px-4 py-2 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors" placeholder="••••••••" type="password"/>
                        @if($errors->updatePassword->has('password'))
                            <span class="text-error text-xs font-bold">{{ $errors->updatePassword->first('password') }}</span>
                        @endif
                    </div>
                    <div>
                        <label class="font-label-sm text-on-surface-variant block mb-1">Konfirmasi Kata Sandi Baru</label>
                        <input name="password_confirmation" required autocomplete="new-password" class="w-full bg-surface-container border-3 border-on-background px-4 py-2 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors" placeholder="••••••••" type="password"/>
                    </div>
                    <div class="pt-2">
                        <button class="bg-primary-container text-on-primary-container w-full font-label-sm px-6 py-3 rounded-lg border-3 border-on-background neobrutal-shadow-sm hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all neobrutal-button-active flex justify-center items-center gap-2" type="submit">
                            <span class="material-symbols-outlined">lock_reset</span>
                            Ubah Kata Sandi
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</main>

<!-- BottomNavBar Removed -->

<!-- Floating Action Button (FAB) -->
<a href="{{ route('attendance.scan') }}" class="fixed bottom-24 right-6 md:bottom-8 md:right-8 w-14 h-14 bg-primary text-on-primary border-3 border-on-background rounded-full neobrutal-shadow flex items-center justify-center hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all z-40">
    <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
</a>

<script>
    function openAvatarModal() {
        document.getElementById('avatar-modal').classList.remove('hidden');
    }
    
    function closeAvatarModal() {
        document.getElementById('avatar-modal').classList.add('hidden');
    }
    
    function selectAvatar(seed) {
        document.getElementById('avatar-input').value = seed;
        
        // Update display visually
        const display = document.getElementById('profile-avatar-display');
        display.innerHTML = `<img src="https://api.dicebear.com/9.x/micah/svg?seed=${seed}&backgroundColor=transparent" class="w-full h-full object-cover" />`;
        
        closeAvatarModal();
        
        // Highlight form button to remind user to save
        const saveBtn = document.getElementById('save-profile-btn');
        if(saveBtn) {
            saveBtn.classList.add('ring-4', 'ring-primary-fixed', 'animate-pulse');
        }
    }

    // Theme toggle logic
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

</body>
</html>
