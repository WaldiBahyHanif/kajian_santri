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
    <title>Alumni & Mahasantri - Daaru Hiraa</title>
    <meta name="description" content="Direktori Alumni dan Mahasantri Daaru Hiraa. Temukan santri berdasarkan angkatan dan universitas."/>
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
        .dark .border-black { border-color: var(--neobrutal-border-color) !important; }
        .dark .bg-white { background-color: var(--surface-container-lowest) !important; }
        .dark .text-black { color: var(--on-surface) !important; }
        .dark .shadow-\[6px_6px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 6px 6px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark .shadow-\[4px_4px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 4px 4px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark textarea, .dark select, .dark input {
            background-color: var(--surface-container-lowest) !important;
            color: var(--on-surface) !important;
            border-color: var(--outline-variant) !important;
        }

        /* Card hover animation */
        .santri-card {
            transition: transform 0.18s cubic-bezier(.34,1.56,.64,1), box-shadow 0.18s ease;
        }
        .santri-card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 8px 8px 0px 0px rgba(var(--neobrutal-shadow-color),1);
        }

        /* Badge angkatan */
        .angkatan-badge {
            background: linear-gradient(135deg, #003527 0%, #1b6b4f 100%);
            color: #fff;
        }
        .dark .angkatan-badge {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: #002117;
        }

        /* Skeleton loader */
        @keyframes shimmer {
            0% { background-position: -468px 0; }
            100% { background-position: 468px 0; }
        }

        /* Filter bar: relative on mobile (so search doesn't cover santri cards), sticky on desktop */
        .filter-bar {
            position: relative;
            top: 0;
            z-index: 10;
        }
        @media (min-width: 768px) {
            .filter-bar {
                position: sticky;
                top: 76px;
                z-index: 30;
                backdrop-filter: blur(12px);
                background: rgba(var(--surface-container-lowest), 0.92);
            }
        }

        /* Empty state animation */
        @keyframes floatUp {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .float-anim { animation: floatUp 3s ease-in-out infinite; }
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
        <a href="{{ route('kalender.index') }}" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 transition-all cursor-pointer text-primary" aria-label="Open Calendar">
            <span class="material-symbols-outlined text-2xl">calendar_month</span>
        </a>
        <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 transition-all cursor-pointer" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-2xl block dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-2xl hidden dark:block">light_mode</span>
        </button>
        <button id="hamburger-toggle" class="flex md:hidden flex-col items-center justify-center w-12 h-12 bg-secondary text-on-secondary border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 transition-all cursor-pointer" aria-label="Menu">
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

    <x-sidebar active="alumni.index" />

<!-- Main Content -->
<main class="pt-[100px] md:pl-72 px-4 md:px-margin-desktop pb-24">

    <!-- Page Header -->
    <section class="bg-primary text-on-primary border-3 border-on-background rounded-xl p-8 neobrutal-shadow mb-8 relative overflow-hidden">
        <!-- Decorative dots -->
        <div class="absolute top-4 right-4 flex flex-col gap-2 opacity-20">
            @for($i=0; $i<4; $i++)
                <div class="flex gap-2">
                    @for($j=0; $j<4; $j++)
                        <div class="w-2 h-2 rounded-full bg-on-primary"></div>
                    @endfor
                </div>
            @endfor
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-6">
            <div class="w-20 h-20 rounded-xl border-3 border-on-primary bg-on-primary/10 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-5xl text-on-primary">info</span>
            </div>
            <div>
                <h1 class="font-headline-lg text-4xl font-black text-on-primary mb-1">Info Santri & Alumni</h1>
                <p class="text-on-primary/80 font-body-lg">Direktori santri berdasarkan universitas, angkatan, dan status keaktifan</p>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <div class="bg-on-primary/10 border-2 border-on-primary/30 rounded-xl p-4 text-center backdrop-blur-sm">
                <div class="text-3xl font-black text-on-primary">{{ $totalSantri }}</div>
                <div class="text-xs font-bold text-on-primary/80 mt-1 uppercase tracking-wide">Total Santri</div>
            </div>
            <div class="bg-on-primary/10 border-2 border-on-primary/30 rounded-xl p-4 text-center backdrop-blur-sm">
                <div class="text-3xl font-black text-on-primary">{{ $totalDenganUni }}</div>
                <div class="text-xs font-bold text-on-primary/80 mt-1 uppercase tracking-wide">Terdaftar di Kampus</div>
            </div>
            <div class="bg-on-primary/10 border-2 border-on-primary/30 rounded-xl p-4 text-center backdrop-blur-sm">
                <div class="text-3xl font-black text-on-primary">{{ $totalAngkatan }}</div>
                <div class="text-xs font-bold text-on-primary/80 mt-1 uppercase tracking-wide">Angkatan</div>
            </div>
            <div class="bg-on-primary/10 border-2 border-on-primary/30 rounded-xl p-4 text-center backdrop-blur-sm">
                <div class="text-3xl font-black text-on-primary">{{ $totalUni }}</div>
                <div class="text-xs font-bold text-on-primary/80 mt-1 uppercase tracking-wide">Universitas</div>
            </div>
        </div>
    </section>

    <!-- Filter Bar -->
    <div class="filter-bar bg-surface-container-lowest border-3 border-on-background rounded-xl p-4 neobrutal-shadow mb-8">
        <form id="filter-form" method="GET" action="{{ route('alumni.index') }}" class="flex flex-col md:flex-row gap-4 items-stretch md:items-end">
            <!-- Search -->
            <div class="flex-1">
                <label class="block font-label-sm text-on-surface-variant mb-1 text-xs uppercase tracking-widest font-black">Cari Nama</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">search</span>
                    <input
                        id="search-input"
                        name="search"
                        type="text"
                        value="{{ request('search') }}"
                        placeholder="Ketik nama santri..."
                        class="w-full bg-surface-container border-3 border-on-background pl-10 pr-4 py-2.5 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors font-body-md"
                    />
                </div>
            </div>

            <!-- Filter Status -->
            <div class="w-full md:w-44">
                <label class="block font-label-sm text-on-surface-variant mb-1 text-xs uppercase tracking-widest font-black">Status</label>
                <select name="status" id="filter-status" onchange="document.getElementById('filter-form').submit()" class="w-full bg-surface-container border-3 border-on-background px-4 py-2.5 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors font-body-md cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Masih Santri</option>
                    <option value="Lulus" {{ request('status') == 'Lulus' ? 'selected' : '' }}>Alumni</option>
                </select>
            </div>

            <!-- Filter Angkatan -->
            <div class="w-full md:w-44">
                <label class="block font-label-sm text-on-surface-variant mb-1 text-xs uppercase tracking-widest font-black">Angkatan</label>
                <select name="angkatan" id="filter-angkatan" onchange="document.getElementById('filter-form').submit()" class="w-full bg-surface-container border-3 border-on-background px-4 py-2.5 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors font-body-md cursor-pointer">
                    <option value="">Semua Angkatan</option>
                    @foreach($angkatanList as $ang)
                        <option value="{{ $ang }}" {{ request('angkatan') == $ang ? 'selected' : '' }}>
                            Angkatan {{ $ang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Universitas -->
            <div class="w-full md:w-48">
                <label class="block font-label-sm text-on-surface-variant mb-1 text-xs uppercase tracking-widest font-black">Universitas</label>
                <select name="universitas" id="filter-universitas" onchange="document.getElementById('filter-form').submit()" class="w-full bg-surface-container border-3 border-on-background px-4 py-2.5 rounded-lg focus:outline-none focus:bg-surface-container-lowest transition-colors font-body-md cursor-pointer">
                    <option value="">Semua Universitas</option>
                    @foreach($universitasList as $uni)
                        <option value="{{ $uni }}" {{ request('universitas') == $uni ? 'selected' : '' }}>
                            {{ Str::limit($uni, 30) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit / Reset -->
            <div class="flex gap-2">
                <button type="submit" class="bg-primary text-on-primary border-3 border-on-background px-5 py-2.5 rounded-lg neobrutal-shadow-sm hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all neobrutal-button-active font-bold flex items-center gap-2 whitespace-nowrap">
                    <span class="material-symbols-outlined text-sm">filter_list</span>
                    Filter
                </button>
                @if(request()->hasAny(['search', 'status', 'angkatan', 'universitas']))
                <a href="{{ route('alumni.index') }}" class="bg-error-container text-on-error-container border-3 border-on-background px-4 py-2.5 rounded-lg neobrutal-shadow-sm hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all font-bold flex items-center gap-2 whitespace-nowrap">
                    <span class="material-symbols-outlined text-sm">close</span>
                    Reset
                </a>
                @endif
            </div>
        </form>

        <!-- Active Filters Display -->
        @if(request()->hasAny(['search', 'status', 'angkatan', 'universitas']))
        <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t-2 border-dashed border-outline-variant">
            <span class="text-xs font-black text-on-surface-variant uppercase tracking-widest">Filter aktif:</span>
            @if(request('search'))
                <span class="bg-primary text-on-primary px-3 py-1 rounded-full border-2 border-on-background text-xs font-bold">
                    Nama: "{{ request('search') }}"
                </span>
            @endif
            @if(request('status'))
                <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full border-2 border-on-background text-xs font-bold">
                    Status: {{ request('status') == 'Aktif' ? 'Masih Santri' : 'Alumni' }}
                </span>
            @endif
            @if(request('angkatan'))
                <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full border-2 border-on-background text-xs font-bold">
                    Angkatan {{ request('angkatan') }}
                </span>
            @endif
            @if(request('universitas'))
                <span class="bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full border-2 border-on-background text-xs font-bold">
                    {{ request('universitas') }}
                </span>
            @endif
            <span class="text-xs font-bold text-on-surface-variant">
                ({{ $students->count() }} santri ditemukan)
            </span>
        </div>
        @endif
    </div>

    <!-- Students Grid -->
    @if($students->isEmpty())
    <!-- Empty State -->
    <div class="flex flex-col items-center justify-center py-24 text-center">
        <div class="float-anim text-8xl mb-6">🔍</div>
        <h2 class="font-headline-md text-2xl font-black text-on-surface mb-3">Tidak ada santri ditemukan</h2>
        <p class="text-on-surface-variant font-body-md mb-6 max-w-md">
            @if(request()->hasAny(['search', 'angkatan', 'universitas']))
                Coba ubah atau reset filter pencarian Anda.
            @else
                Belum ada santri yang terdaftar di sistem.
            @endif
        </p>
        @if(request()->hasAny(['search', 'angkatan', 'universitas']))
        <a href="{{ route('alumni.index') }}" class="bg-primary text-on-primary border-3 border-on-background px-6 py-3 rounded-lg neobrutal-shadow-sm hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all font-bold flex items-center gap-2">
            <span class="material-symbols-outlined">refresh</span>
            Tampilkan Semua Santri
        </a>
        @endif
    </div>
    @else

    <!-- Group by Angkatan -->
    @php
        $grouped = $students->groupBy(function($s) {
            return $s->angkatan ?? 'Tidak Ada Angkatan';
        });
        // Sort: numeric descending, then 'Tidak Ada Angkatan' last
        $grouped = $grouped->sortByDesc(function($items, $key) {
            return is_numeric($key) ? (int)$key : 0;
        });
    @endphp

    @foreach($grouped as $angkatan => $group)
    <div class="mb-10">
        <!-- Angkatan Header -->
        <div class="flex items-center gap-4 mb-6">
            <div class="angkatan-badge px-6 py-2 rounded-lg border-3 border-on-background neobrutal-shadow-sm font-black text-lg">
                @if(is_numeric($angkatan))
                    🎓 Angkatan {{ $angkatan }}
                @else
                    📋 {{ $angkatan }}
                @endif
            </div>
            <div class="flex-1 h-[3px] bg-on-background/20 rounded"></div>
            <span class="text-sm font-black text-on-surface-variant bg-surface-container border-2 border-on-background px-3 py-1 rounded-full">
                {{ $group->count() }} santri
            </span>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($group as $santri)
            <div class="santri-card bg-surface-container-lowest border-3 border-on-background rounded-xl neobrutal-shadow overflow-hidden flex flex-col">

                <!-- Card Top: Avatar + Name -->
                <div class="p-5 flex items-center gap-4 border-b-3 border-on-background bg-secondary-container/20">
                    <div class="w-16 h-16 rounded-xl border-3 border-on-background overflow-hidden flex-shrink-0 bg-secondary-container flex items-center justify-center font-black text-2xl text-on-secondary-container shadow-[3px_3px_0px_0px_rgba(var(--neobrutal-shadow-color),1)]">
                        @if($santri->avatar)
                            <img
                                src="https://api.dicebear.com/9.x/micah/svg?seed={{ $santri->avatar }}&backgroundColor=transparent"
                                alt="{{ $santri->name }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                            />
                        @else
                            {{ strtoupper(substr($santri->name, 0, 1)) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-black text-base text-on-surface leading-tight truncate" title="{{ $santri->name }}">{{ $santri->name }}</h3>
                        <div class="flex flex-wrap items-center gap-1.5 mt-1">
                            <span class="text-[10px] font-bold text-on-surface-variant bg-surface-container px-1.5 py-0.5 rounded border border-on-background/20">{{ $santri->title ?? 'Santri' }}</span>
                            @if($santri->status_aktif === 'Lulus')
                                <span class="bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-300 text-[10px] font-black px-1.5 py-0.5 rounded border border-amber-300 uppercase tracking-wider">Alumni</span>
                            @else
                                <span class="bg-green-100 text-green-800 dark:bg-green-950/40 dark:text-green-300 text-[10px] font-black px-1.5 py-0.5 rounded border border-green-300 uppercase tracking-wider">Aktif</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card Body: Info -->
                <div class="p-4 flex-1 space-y-3">
                    <!-- Universitas -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-primary text-base flex-shrink-0 mt-0.5">account_balance</span>
                        <div class="min-w-0">
                            <div class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest">Universitas</div>
                            <div class="text-sm font-bold text-on-surface leading-tight">{{ $santri->universitas ?: '-' }}</div>
                        </div>
                    </div>

                    <!-- Angkatan -->
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-secondary text-base flex-shrink-0 mt-0.5">school</span>
                        <div>
                            <div class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest">Angkatan</div>
                            <div class="text-sm font-bold text-on-surface">{{ $santri->angkatan ?: '-' }}</div>
                        </div>
                    </div>

                    <!-- Generasi Pesantren -->
                    @if($santri->generation)
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-on-tertiary-container text-base flex-shrink-0 mt-0.5">groups</span>
                        <div>
                            <div class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest">Generasi Pesantren</div>
                            <div class="text-sm font-bold text-on-surface">{{ $santri->generation }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Card Footer: Stats -->
                <div class="px-4 py-3 border-t-3 border-on-background bg-surface-container flex items-center justify-between">
                    <div class="text-center">
                        <div class="text-xl font-black text-primary">{{ $santri->total_attendance ?? 0 }}</div>
                        <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest">Kehadiran</div>
                    </div>
                    <div class="w-px h-8 bg-on-background/20"></div>
                    <div class="text-center">
                        <div class="text-xl font-black text-secondary">{{ $santri->current_streak ?? 0 }}</div>
                        <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest">Streak</div>
                    </div>
                    <div class="w-px h-8 bg-on-background/20"></div>
                    <div class="text-center">
                        <div class="text-xl font-black text-on-tertiary-container">{{ $santri->total_zikir ?? 0 }}</div>
                        <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest">Zikir</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

    @endif

</main>

<!-- FAB: Scan Absensi -->
<a href="{{ route('attendance.scan') }}" class="fixed bottom-24 right-6 md:bottom-8 md:right-8 w-14 h-14 bg-primary text-on-primary border-3 border-on-background rounded-full neobrutal-shadow flex items-center justify-center hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all z-40">
    <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
</a>

<script>
    // Theme toggle
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
            setTimeout(() => { sidebarOverlay.classList.add('hidden'); }, 300);
        }
        if (sidebarMenu) {
            sidebarMenu.classList.remove('translate-x-0');
            sidebarMenu.classList.add('-translate-x-full');
        }
    }

    if (hamburgerToggle) hamburgerToggle.addEventListener('click', openSidebar);
    if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

    // Live search with debounce
    let searchTimeout;
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filter-form').submit();
            }, 600);
        });
    }
</script>

<x-calendar-modal />

</body>
</html>
