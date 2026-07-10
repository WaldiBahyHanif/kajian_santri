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
    <title>Jadwal & RSVP Kajian - Daaru Hiraa</title>
                        <style>
        [x-cloak] { display: none !important; }
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
        .tab-active {
            background-color: var(--primary) !important;
            color: var(--on-primary) !important;
            border-color: var(--neobrutal-border-color) !important;
        }
        .dark .tab-active {
            background-color: var(--primary) !important;
            color: var(--on-primary) !important;
            border-color: var(--neobrutal-border-color) !important;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background font-body-md min-h-screen" x-data="{ activeTab: 'jadwal', sidebarOpen: false, modalOpen: false, activeKajian: {} }">

<!-- TopAppBar Shell -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 md:px-margin-desktop py-4 bg-surface border-b-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
    <div class="flex items-center gap-2">
        <a href="{{ url('/') }}" class="font-headline-md text-headline-md font-black text-primary tracking-tighter hover:opacity-80">Daaru Hiraa</a>
    </div>
    <div class="flex items-center gap-3">
        <!-- Calendar Button -->
        <a href="{{ route('kalender.index') }}" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer text-primary" aria-label="Open Calendar">
            <span class="material-symbols-outlined text-2xl">calendar_month</span>
        </a>

        <!-- Theme Toggle -->
        <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer text-on-background" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-2xl block dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-2xl hidden dark:block">light_mode</span>
        </button>

        <!-- Hamburger Button -->
        <button id="hamburger-toggle" @click="sidebarOpen = true" class="flex md:hidden flex-col items-center justify-center w-12 h-12 bg-secondary text-on-secondary border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer" aria-label="Menu">
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
<div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-black/60 z-[55] transition-opacity duration-300 md:hidden"></div>

    <x-sidebar active="kajian" alpine="true" />

<!-- Main Content Canvas -->
<main class="pt-24 pb-24 md:pl-72 md:pr-10 px-4">
    <div class="max-w-5xl mx-auto space-y-8">
        
        <!-- Welcome Section -->
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary tracking-tight">📅 Jadwal & RSVP Kajian</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant flex items-center gap-2 mt-2">
                    Daftar kehadiran kajian mendatang atau pelajari rangkuman kajian yang sudah lewat.
                </p>
            </div>
        </section>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="bg-[#39FF14] border-3 border-black p-4 font-black shadow-[4px_4px_0_0_#000] rounded-lg text-black flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-400 border-3 border-black p-4 font-black shadow-[4px_4px_0_0_#000] rounded-lg text-black flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">error</span>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif
        @if(session('warning'))
            <div class="bg-yellow-300 border-3 border-black p-4 font-black shadow-[4px_4px_0_0_#000] rounded-lg text-black flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">warning</span>
                    <span>{{ session('warning') }}</span>
                </div>
            </div>
        @endif

        <!-- Tabs Navigation -->
        <div class="flex flex-wrap gap-3 border-b-3 border-black pb-2">
            <button @click="activeTab = 'jadwal'" :class="activeTab === 'jadwal' ? 'tab-active' : ''" class="bg-white border-3 border-on-background px-6 py-3 rounded-lg font-black neobrutal-shadow-sm transition-all hover:translate-y-[-2px] cursor-pointer">
                📅 Kajian Mendatang
            </button>
            <button @click="activeTab = 'riwayat'" :class="activeTab === 'riwayat' ? 'tab-active' : ''" class="bg-white border-3 border-on-background px-6 py-3 rounded-lg font-black neobrutal-shadow-sm transition-all hover:translate-y-[-2px] cursor-pointer">
                📝 Ringkasan Kajian
            </button>
            <button @click="activeTab = 'pustaka'" :class="activeTab === 'pustaka' ? 'tab-active' : ''" class="bg-white border-3 border-on-background px-6 py-3 rounded-lg font-black neobrutal-shadow-sm transition-all hover:translate-y-[-2px] cursor-pointer">
                📚 Pustaka Materi
            </button>
        </div>

        <!-- Tab Content 1: Jadwal Kajian -->
        <div x-show="activeTab === 'jadwal'" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($upcomingKajian as $k)
                    <div class="bg-white p-5 border-3 border-black rounded-lg shadow-[6px_6px_0_0_#000] flex flex-col justify-between hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[8px_8px_0_0_#000] transition-all">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex gap-2">
                                    @if($k->is_routine)
                                        <span class="text-[10px] font-black uppercase bg-[#FFDE00] text-black border-2 border-black px-2 py-0.5 rounded shadow-[1px_1px_0_0_#000]">
                                            🔁 Kajian Tetap
                                        </span>
                                    @else
                                        <span class="text-[10px] font-black uppercase bg-[#00E5FF] text-black border-2 border-black px-2 py-0.5 rounded shadow-[1px_1px_0_0_#000]">
                                            📣 Kajian Event
                                        </span>
                                    @endif

                                    @if($k->program)
                                        <span class="text-[10px] font-black uppercase bg-purple-100 text-purple-700 border-2 border-black px-2 py-0.5 rounded">
                                            {{ $k->program->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <h3 class="text-xl font-black uppercase text-black mb-2">{{ $k->title }}</h3>

                            <div class="inline-flex items-center gap-2 mb-4 bg-yellow-50 border-2 border-black px-2.5 py-1 rounded text-xs font-bold text-black">
                                <span class="material-symbols-outlined text-sm">person</span>
                                <span>Ustadz: {{ $k->asatiz?->name ?? 'Belum ditentukan' }}</span>
                            </div>

                            <div class="space-y-2 text-sm text-gray-700 font-bold mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base text-primary">calendar_today</span>
                                    <span>{{ $k->date->translatedFormat('dddd, d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base text-primary">schedule</span>
                                    <span>{{ substr($k->time, 0, 5) }} WIB</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base text-primary">location_on</span>
                                    <span>{{ $k->location }}</span>
                                </div>
                                @if($k->description)
                                    <p class="text-xs text-gray-500 mt-2 font-normal italic leading-relaxed border-t-2 border-dashed border-gray-100 pt-2">{{ $k->description }}</p>
                                @endif

                                <!-- Notification Alert -->
                                @if($k->is_incoming_soon)
                                    <div class="mt-3 bg-rose-100 border-2 border-rose-500 text-rose-700 px-3 py-2 rounded-lg text-xs font-black flex items-center gap-1.5 animate-pulse">
                                        <span class="material-symbols-outlined text-base">alarm</span>
                                        <span>MULAI DALAM {{ $k->diff_in_minutes }} MENIT! BERSIAPLAH.</span>
                                    </div>
                                @endif
                                @if($k->is_ongoing)
                                    <div class="mt-3 bg-emerald-100 border-2 border-emerald-500 text-emerald-700 px-3 py-2 rounded-lg text-xs font-black flex items-center gap-1.5 animate-pulse">
                                        <span class="material-symbols-outlined text-base">radio_button_checked</span>
                                        <span>🔴 SEDANG BERLANGSUNG</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 bg-white border-3 border-black p-8 rounded-lg text-center text-gray-400 font-bold shadow-[4px_4px_0_0_#000] italic">
                        Belum ada kajian mendatang yang dijadwalkan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Tab Content 2: Riwayat & Dokumentasi -->
        <div x-show="activeTab === 'riwayat'" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($pastKajian as $k)
                    <div class="bg-white p-5 border-3 border-black rounded-lg shadow-[6px_6px_0_0_#000] flex flex-col justify-between hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[8px_8px_0_0_#000] transition-all">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex gap-2">
                                    <span class="text-[10px] font-black uppercase bg-gray-200 text-gray-500 border-2 border-black px-2 py-0.5 rounded">
                                        SELESAI
                                    </span>
                                    @if($k->program)
                                        <span class="text-[10px] font-black uppercase bg-purple-100 text-purple-700 border-2 border-black px-2 py-0.5 rounded">
                                            {{ $k->program->name }}
                                        </span>
                                    @endif
                                </div>
                                <span class="text-xs font-bold text-gray-400">
                                    {{ $k->date->translatedFormat('d M Y') }}
                                </span>
                            </div>

                            <h3 class="text-xl font-black uppercase text-black mb-1 line-clamp-1">{{ $k->title }}</h3>
                            <p class="text-xs text-gray-500 font-bold mb-4">Ustadz: {{ $k->asatiz?->name }}</p>

                            <!-- Mini documentation indicators -->
                            <div class="flex gap-1.5 mb-4">
                                <span class="w-2.5 h-2.5 rounded-full border border-black {{ $k->summary ? 'bg-green-400' : 'bg-gray-100' }}" title="Ringkasan"></span>
                                <span class="w-2.5 h-2.5 rounded-full border border-black {{ $k->youtube_link ? 'bg-red-500' : 'bg-gray-100' }}" title="YouTube"></span>
                                <span class="w-2.5 h-2.5 rounded-full border border-black {{ $k->spotify_link ? 'bg-emerald-500' : 'bg-gray-100' }}" title="Spotify"></span>
                                <span class="w-2.5 h-2.5 rounded-full border border-black {{ $k->material_link ? 'bg-blue-400' : 'bg-gray-100' }}" title="Materi"></span>
                            </div>
                        </div>

                        <!-- Open Detail Modal -->
                        <div class="pt-4 border-t-2 border-black">
                            <button @click="activeKajian = { 
                                title: '{{ addslashes($k->title) }}', 
                                ustadz: '{{ addslashes($k->asatiz?->name) }}',
                                date: '{{ $k->date->translatedFormat('dddd, d F Y') }}',
                                time: '{{ substr($k->time, 0, 5) }} WIB',
                                location: '{{ addslashes($k->location) }}',
                                summary: '{{ addslashes($k->summary) }}',
                                youtube: '{{ $k->youtube_link }}',
                                spotify: '{{ $k->spotify_link }}',
                                material: '{{ $k->material_link }}'
                            }; modalOpen = true" class="w-full bg-[#FFDE00] text-black px-4 py-2.5 border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none active:translate-y-1 transition-all rounded text-center cursor-pointer">
                                LIHAT RINGKASAN & MATERI
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 bg-white border-3 border-black p-8 rounded-lg text-center text-gray-400 font-bold shadow-[4px_4px_0_0_#000] italic">
                        Belum ada riwayat kajian yang tersedia.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Tab Content 3: Pustaka Materi -->
        <div x-show="activeTab === 'pustaka'" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($materials as $material)
                    <div class="bg-white p-5 border-3 border-black rounded-lg shadow-[6px_6px_0_0_#000] flex flex-col justify-between hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[8px_8px_0_0_#000] transition-all">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-[10px] font-black uppercase bg-[#39FF14] text-black border-2 border-black px-2 py-0.5 rounded">
                                    Pustaka Umum
                                </span>
                            </div>

                            <h3 class="text-xl font-black uppercase text-black mb-4">{{ $material->title }}</h3>
                        </div>

                        <div class="pt-4 border-t-2 border-black">
                            <a href="{{ $material->link_url }}" target="_blank" class="w-full bg-[#00E5FF] text-black px-4 py-2.5 border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none active:translate-y-1 transition-all rounded text-center block">
                                🔗 BUKA / DOWNLOAD MATERI
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 bg-white border-3 border-black p-8 rounded-lg text-center text-gray-400 font-bold shadow-[4px_4px_0_0_#000] italic">
                        Belum ada materi pustaka umum yang diunggah oleh admin.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</main>

<!-- Detail Modal (Alpine.js) -->
<div x-show="modalOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
    <div @click.away="modalOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-2xl shadow-[8px_8px_0_0_#000] relative max-h-[90vh] overflow-y-auto">
        
        <!-- Close button -->
        <button @click="modalOpen = false" class="absolute top-4 right-4 bg-red-400 border-3 border-black w-8 h-8 rounded-full font-black text-sm hover:bg-red-500 cursor-pointer">X</button>
        
        <!-- Modal Header -->
        <div class="border-b-4 border-black pb-4 mb-4 pr-6">
            <span class="text-[10px] font-black uppercase bg-gray-200 text-gray-600 border-2 border-black px-2 py-0.5 rounded">Arsip Dokumentasi</span>
            <h2 class="text-2xl font-black uppercase text-black mt-2" x-text="activeKajian.title"></h2>
            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1 text-xs font-bold text-gray-500">
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">person</span>
                    <span x-text="activeKajian.ustadz"></span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                    <span x-text="activeKajian.date"></span>
                </div>
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">schedule</span>
                    <span x-text="activeKajian.time"></span>
                </div>
            </div>
        </div>

        <!-- Modal Content Grid -->
        <div class="space-y-4">
            
            <!-- Quick Links -->
            <div>
                <label class="block text-xs font-black uppercase text-gray-400 mb-2">Link Dokumentasi & Download</label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    
                    <!-- YouTube -->
                    <template x-if="activeKajian.youtube">
                        <a :href="activeKajian.youtube" target="_blank" class="bg-red-500 text-white font-black p-3 rounded-lg border-3 border-black shadow-[3px_3px_0_0_#000] hover:translate-y-0.5 hover:shadow-none transition-all text-xs flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">play_circle</span> TONTON DI YOUTUBE
                        </a>
                    </template>
                    <template x-if="!activeKajian.youtube">
                        <div class="bg-gray-100 text-gray-400 font-black p-3 rounded-lg border-3 border-dashed border-gray-300 text-xs flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">videocam_off</span> NO VIDEO RECORDING
                        </div>
                    </template>

                    <!-- Spotify -->
                    <template x-if="activeKajian.spotify">
                        <a :href="activeKajian.spotify" target="_blank" class="bg-emerald-500 text-white font-black p-3 rounded-lg border-3 border-black shadow-[3px_3px_0_0_#000] hover:translate-y-0.5 hover:shadow-none transition-all text-xs flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">audio_file</span> DENGAR DI SPOTIFY
                        </a>
                    </template>
                    <template x-if="!activeKajian.spotify">
                        <div class="bg-gray-100 text-gray-400 font-black p-3 rounded-lg border-3 border-dashed border-gray-300 text-xs flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">volume_off</span> NO AUDIO RECORDING
                        </div>
                    </template>

                    <!-- Slides / PDF -->
                    <template x-if="activeKajian.material">
                        <a :href="activeKajian.material" target="_blank" class="bg-blue-400 text-black font-black p-3 rounded-lg border-3 border-black shadow-[3px_3px_0_0_#000] hover:translate-y-0.5 hover:shadow-none transition-all text-xs flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">download</span> DOWNLOAD MATERI
                        </a>
                    </template>
                    <template x-if="!activeKajian.material">
                        <div class="bg-gray-100 text-gray-400 font-black p-3 rounded-lg border-3 border-dashed border-gray-300 text-xs flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">folder_off</span> NO SLIDES/FILE
                        </div>
                    </template>
                </div>
            </div>

            <!-- Summary / Ringkasan -->
            <div class="pt-4 border-t-2 border-gray-200">
                <label class="block text-xs font-black uppercase text-gray-400 mb-2">Ringkasan Materi</label>
                <div class="bg-yellow-50 border-3 border-black p-4 rounded-xl shadow-[4px_4px_0_0_#000] text-black">
                    <template x-if="activeKajian.summary">
                        <p class="text-sm font-bold leading-relaxed whitespace-pre-wrap" x-text="activeKajian.summary"></p>
                    </template>
                    <template x-if="!activeKajian.summary">
                        <p class="text-sm text-gray-500 font-bold italic text-center">Belum ada ringkasan materi untuk kajian ini.</p>
                    </template>
                </div>
            </div>

        </div>
    </div>
</div>

<x-calendar-modal />

<script>
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

    // Mobile Sidebar Drawer Toggle
    const hamburgerToggle = document.getElementById('hamburger-toggle');
    const sidebarClose = document.getElementById('sidebar-close');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const sidebarMenu = document.querySelector('aside');

    if (hamburgerToggle) {
        hamburgerToggle.addEventListener('click', () => {
            if (sidebarOverlay) sidebarOverlay.classList.remove('hidden');
            if (sidebarMenu) sidebarMenu.classList.remove('-translate-x-full');
        });
    }
</script>

</body>
</html>
