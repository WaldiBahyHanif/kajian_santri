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
    <title>Mitsur Duo - Daaru Hiraa</title>
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

    <x-sidebar active="mitsur" />

<!-- Main Content Canvas -->
<main class="pt-24 pb-24 md:pl-72 md:pr-10 px-4">
    <div class="max-w-5xl mx-auto space-y-8">

        @if(session('success'))
            <div class="bg-secondary-container text-on-secondary-container border-3 border-on-background p-4 rounded-xl neobrutal-shadow-sm font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-2xl">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-error-container text-on-error-container border-3 border-on-background p-4 rounded-xl neobrutal-shadow-sm font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-2xl">error</span>
                {{ session('error') }}
            </div>
        @endif

        <!-- Header Hero -->
        <section>
            <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary tracking-tight mb-2">Mitsur Duo</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Bangun istiqomah bersama Partner Surga-mu. Saling mengawasi, saling mengingatkan, saling mengejar rida Allah.</p>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Partner & Streak -->
            <div class="lg:col-span-4 flex flex-col gap-8">
                <!-- Partner Card -->
                <section class="bg-white border-3 border-on-background neobrutal-shadow p-6 rounded-xl">
                    @if($partner)
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-20 h-20 bg-primary-fixed border-3 border-on-background flex-shrink-0 rounded-xl overflow-hidden flex items-center justify-center font-black text-3xl text-on-primary-fixed">
                            @if($partner->avatar)
                                <img alt="Partner Avatar" class="w-full h-full object-cover" src="https://api.dicebear.com/9.x/micah/svg?seed={{ $partner->avatar }}&backgroundColor=transparent">
                            @else
                                {{ substr($partner->name, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <span class="bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-sm text-[10px] px-2 py-0.5 border-2 border-on-background mb-1 inline-block rounded">PARTNER SURGA</span>
                            <h2 class="font-headline-md text-headline-md text-primary">{{ collect(explode(' ', $partner->name))->first() }}</h2>
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Kelas {{ $partner->generation }}</p>
                        </div>
                    </div>
                    
                    @php
                        $partnerLatestMood = \App\Models\DailyMood::where('student_id', $partner->id)
                            ->whereDate('created_at', now()->toDateString())
                            ->first();
                    @endphp
                    @if($partnerLatestMood && in_array($partnerLatestMood->mood_type, ['Futur', 'Butuh Cerita']))
                        <div class="bg-error-container text-on-error-container border-2 border-on-background p-3 rounded-lg mb-4 text-xs font-bold flex items-center gap-2 animate-bounce-subtle">
                            <span class="material-symbols-outlined text-sm">warning</span>
                            <span>Partner Anda sedang <strong>{{ $partnerLatestMood->mood_type == 'Futur' ? 'Futur / Lelah' : 'Butuh Teman Cerita' }}</strong> hari ini. Yuk sapa dia!</span>
                        </div>
                    @endif

                    <div class="flex gap-2">
                        <button id="btn-open-chat" class="flex-grow bg-secondary-container text-on-secondary-container border-3 border-on-background neobrutal-shadow-sm py-2 font-bold flex items-center justify-center gap-2 rounded-lg neobrutal-shadow-active transition-all">
                            <span class="material-symbols-outlined text-sm">chat</span>
                            Message
                        </button>
                        <button class="bg-surface border-3 border-on-background neobrutal-shadow-sm py-2 px-3 font-bold rounded-lg neobrutal-shadow-active transition-all">
                            <span class="material-symbols-outlined">more_vert</span>
                        </button>
                    </div>
                    @else
                    <div class="text-center py-6">
                        <h2 class="font-headline-md text-headline-md text-primary mb-2">Belum Ada Partner</h2>
                        <p class="font-label-sm text-label-sm text-on-surface-variant mb-4">Cari partner hijrahmu sekarang juga!</p>
                        <button class="w-full bg-primary text-on-primary border-3 border-on-background neobrutal-shadow-sm py-2 font-bold flex items-center justify-center gap-2 rounded-lg neobrutal-shadow-active transition-all">
                            <span class="material-symbols-outlined text-sm">person_add</span>
                            Cari Partner
                        </button>
                    </div>
                    @endif
                </section>

                <!-- Shared Streak Widget -->
                <section class="bg-primary-container border-3 border-on-background neobrutal-shadow p-6 rounded-xl text-on-primary-container relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-headline-md text-headline-md font-bold text-primary-fixed">Shared Streak</h3>
                            <span class="material-symbols-outlined text-3xl text-tertiary-fixed-dim" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                        </div>
                        <div class="flex items-baseline gap-2 mb-4">
                            <span class="text-6xl font-black tracking-tighter">{{ $pair ? $pair->current_pair_streak : 0 }}</span>
                            <span class="font-headline-md text-headline-md">HARI</span>
                        </div>
                        @php $progress = min(100, (($pair ? $pair->current_pair_streak : 0) / 30) * 100); @endphp
                        <div class="w-full h-8 border-3 border-on-background bg-primary rounded-lg p-1 overflow-hidden">
                            <div class="h-full bg-secondary-fixed rounded shadow-[inset_0_2px_0_0_rgba(255,255,255,0.3)]" style="width: {{ $progress }}%;"></div>
                        </div>
                        <p class="mt-3 font-label-sm text-label-sm text-primary-fixed-dim">Target: 30 Hari Tanpa Putus (Level 2)</p>
                    </div>
                </section>

                <!-- Encouragement Quote -->
                <section class="bg-tertiary-fixed border-3 border-on-background neobrutal-shadow-sm p-6 rounded-xl">
                    <span class="material-symbols-outlined text-tertiary text-4xl mb-2">format_quote</span>
                    <p class="font-headline-md text-headline-md italic text-tertiary leading-tight">"Mukmin yang kuat lebih dicintai Allah daripada mukmin yang lemah."</p>
                    <p class="mt-4 font-label-sm text-label-sm text-on-tertiary-fixed-variant font-bold">— HR. Muslim</p>
                </section>
            </div>

            <!-- Right Column: Accountability & Leaderboard -->
            <div class="lg:col-span-8 flex flex-col gap-8">
                <!-- Accountability Checklist -->
                <section class="bg-white border-3 border-on-background neobrutal-shadow rounded-xl overflow-hidden">
                    <div class="bg-secondary-container p-4 border-b-3 border-on-background flex justify-between items-center">
                        <h3 class="font-headline-md text-headline-md font-bold text-on-secondary-container">Checklist Akuntabilitas</h3>
                        <span class="font-label-sm text-label-sm text-on-secondary-container">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="p-6">
                        <form id="checklist-form" method="POST" action="{{ route('mitsur.update') }}">
                            @csrf
                            <div class="space-y-4">
                                <!-- Task 1: Subuh -->
                                <div onclick="toggleChecklist('subuh')" class="flex items-center justify-between p-4 bg-surface border-3 border-on-background rounded-lg hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all cursor-pointer select-none">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-primary-fixed border-3 border-on-background flex items-center justify-center rounded-lg">
                                            <span class="material-symbols-outlined text-on-primary-fixed">wb_sunny</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-on-surface">Saling Ingatkan Subuh</h4>
                                            <p class="font-label-sm text-label-sm text-on-surface-variant">Pastikan partner sudah bangun 15 menit sebelum adzan.</p>
                                        </div>
                                    </div>
                                    <input type="checkbox" name="items[]" value="subuh" id="input-subuh" class="hidden" {{ in_array('subuh', $checkedItems) ? 'checked' : '' }}>
                                    <div id="check-subuh" class="w-8 h-8 border-3 border-on-background {{ in_array('subuh', $checkedItems) ? 'bg-secondary' : 'bg-surface' }} shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center rounded">
                                        <span class="material-symbols-outlined text-white font-bold {{ in_array('subuh', $checkedItems) ? '' : 'hidden' }}">check</span>
                                    </div>
                                </div>

                                <!-- Task 2: Tilawah -->
                                <div onclick="toggleChecklist('tilawah')" class="flex items-center justify-between p-4 bg-surface border-3 border-on-background rounded-lg hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all cursor-pointer select-none">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-tertiary-fixed border-3 border-on-background flex items-center justify-center rounded-lg">
                                            <span class="material-symbols-outlined text-on-tertiary-fixed">menu_book</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-on-surface">Saling Audit Tilawah</h4>
                                            <p class="font-label-sm text-label-sm text-on-surface-variant">Laporan target 1 Juz hari ini.</p>
                                        </div>
                                    </div>
                                    <input type="checkbox" name="items[]" value="tilawah" id="input-tilawah" class="hidden" {{ in_array('tilawah', $checkedItems) ? 'checked' : '' }}>
                                    <div id="check-tilawah" class="w-8 h-8 border-3 border-on-background {{ in_array('tilawah', $checkedItems) ? 'bg-secondary' : 'bg-surface' }} shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center rounded">
                                        <span class="material-symbols-outlined text-white font-bold {{ in_array('tilawah', $checkedItems) ? '' : 'hidden' }}">check</span>
                                    </div>
                                </div>

                                <!-- Task 3: Dzikir -->
                                <div onclick="toggleChecklist('dzikir')" class="flex items-center justify-between p-4 bg-surface border-3 border-on-background rounded-lg hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all cursor-pointer select-none">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-secondary-fixed border-3 border-on-background flex items-center justify-center rounded-lg">
                                            <span class="material-symbols-outlined text-on-secondary-fixed">task_alt</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-on-surface">Dzikir Pagi &amp; Petang</h4>
                                            <p class="font-label-sm text-label-sm text-on-surface-variant">Selesaikan wirid bersama-sama.</p>
                                        </div>
                                    </div>
                                    <input type="checkbox" name="items[]" value="dzikir" id="input-dzikir" class="hidden" {{ in_array('dzikir', $checkedItems) ? 'checked' : '' }}>
                                    <div id="check-dzikir" class="w-8 h-8 border-3 border-on-background {{ in_array('dzikir', $checkedItems) ? 'bg-secondary' : 'bg-surface' }} shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center rounded">
                                        <span class="material-symbols-outlined text-white font-bold {{ in_array('dzikir', $checkedItems) ? '' : 'hidden' }}">check</span>
                                    </div>
                                </div>

                                <!-- Task 4: Hadir Kajian -->
                                <div onclick="toggleChecklist('kajian')" class="flex items-center justify-between p-4 bg-surface border-3 border-on-background rounded-lg hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all cursor-pointer select-none">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-primary-fixed-dim border-3 border-on-background flex items-center justify-center rounded-lg">
                                            <span class="material-symbols-outlined text-on-primary-fixed-variant">school</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-on-surface">Hadir Kajian</h4>
                                            <p class="font-label-sm text-label-sm text-on-surface-variant">Hadir dalam kajian harian/pekanan tepat waktu.</p>
                                        </div>
                                    </div>
                                    <input type="checkbox" name="items[]" value="kajian" id="input-kajian" class="hidden" {{ in_array('kajian', $checkedItems) ? 'checked' : '' }}>
                                    <div id="check-kajian" class="w-8 h-8 border-3 border-on-background {{ in_array('kajian', $checkedItems) ? 'bg-secondary' : 'bg-surface' }} shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center rounded">
                                        <span class="material-symbols-outlined text-white font-bold {{ in_array('kajian', $checkedItems) ? '' : 'hidden' }}">check</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="w-full mt-6 bg-primary text-on-primary border-3 border-on-background neobrutal-shadow neobrutal-shadow-active py-4 font-bold rounded-lg text-center transition-all cursor-pointer">Update Laporan Harian</button>
                        </form>
                    </div>
                </section>

                <!-- Leaderboard -->
                <section class="bg-white border-3 border-on-background neobrutal-shadow rounded-xl overflow-hidden">
                    <div class="bg-tertiary-fixed-dim p-4 border-b-3 border-on-background flex justify-between items-center">
                        <h3 class="font-headline-md text-headline-md font-bold text-on-tertiary-fixed">Duo Terbaik Ma'had</h3>
                        <span class="material-symbols-outlined text-on-tertiary-fixed" style="font-variation-settings: 'FILL' 1;">trophy</span>
                    </div>
                    <div class="p-2">
                        <table class="w-full border-separate border-spacing-2">
                            <thead>
                                <tr class="text-left">
                                    <th class="p-2 font-label-sm text-label-sm text-on-surface-variant">Rank</th>
                                    <th class="p-2 font-label-sm text-label-sm text-on-surface-variant">Nama Duo</th>
                                    <th class="p-2 font-label-sm text-label-sm text-on-surface-variant text-right">Streak</th>
                                    <th class="p-2 font-label-sm text-label-sm text-on-surface-variant text-right">Skor</th>
                                </tr>
                            </thead>
                            <tbody class="space-y-2">
                                @foreach(array_slice($leaderboard, 0, 3) as $index => $board)
                                <tr class="border-2 rounded-lg {{ $board['is_current_user'] ? 'bg-primary-fixed/20 border-on-background' : ($index == 0 ? 'bg-secondary-fixed/30 border-on-background' : 'border-transparent') }}">
                                    <td class="p-3 font-bold {{ $index == 0 ? 'text-primary' : ($board['is_current_user'] ? 'text-primary' : 'text-on-surface-variant') }}">#{{ $index + 1 }}</td>
                                    <td class="p-3">
                                        <div class="flex items-center gap-2">
                                            <div class="flex -space-x-2 flex-shrink-0">
                                                <div class="w-8 h-8 rounded-full border-2 border-on-background bg-secondary-container overflow-hidden flex items-center justify-center">
                                                    <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $board['avatar_1'] }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="Avatar 1" />
                                                </div>
                                                <div class="w-8 h-8 rounded-full border-2 border-on-background bg-primary-fixed-dim overflow-hidden flex items-center justify-center">
                                                    <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $board['avatar_2'] }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="Avatar 2" />
                                                </div>
                                            </div>
                                            <span class="font-bold">{{ $board['name_1'] }} &amp; {{ $board['name_2'] }} {{ $board['is_current_user'] ? '(You)' : '' }}</span>
                                        </div>
                                    </td>
                                    <td class="p-3 text-right font-bold text-error">{{ $board['streak'] }} 🔥</td>
                                    <td class="p-3 text-right font-black">{{ $board['score'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="p-4 text-center">
                            <button id="btn-lihat-semua-peringkat" class="text-primary font-bold underline decoration-4 underline-offset-4 hover:text-secondary transition-colors cursor-pointer bg-transparent border-0 p-0">Lihat Semua Peringkat</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>
</main>

<!-- BottomNavBar Removed -->

<!-- Floating Action Button (FAB) -->
<a href="{{ route('attendance.scan') }}" class="fixed bottom-24 right-6 md:bottom-8 md:right-8 w-14 h-14 bg-primary text-on-primary border-3 border-on-background rounded-full neobrutal-shadow flex items-center justify-center hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all z-40">
    <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
</a>

<!-- Leaderboard Modal Popup -->
<div id="leaderboard-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div id="leaderboard-modal-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Content -->
    <div class="bg-white border-3 border-on-background rounded-xl neobrutal-shadow max-w-lg w-full mx-4 overflow-hidden relative z-50 max-h-[80vh] flex flex-col transition-all">
        <!-- Modal Header -->
        <div class="p-5 border-b-3 border-on-background bg-tertiary-fixed flex justify-between items-center">
            <h3 class="font-headline-md text-[20px] font-black text-on-tertiary-fixed flex items-center gap-2" id="modal-title">
                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">trophy</span>
                Peringkat Duo Terbaik Ma'had
            </h3>
            <button id="btn-close-leaderboard-modal" class="w-8 h-8 border-2 border-on-background rounded-lg flex items-center justify-center bg-white hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] cursor-pointer">
                <span class="material-symbols-outlined text-lg font-black text-on-background">close</span>
            </button>
        </div>

        <!-- Modal Body (Scrollable Table) -->
        <div class="p-4 overflow-y-auto flex-grow bg-background dark:bg-surface-container">
            <table class="w-full border-separate border-spacing-2">
                <thead>
                    <tr class="text-left">
                        <th class="p-2 font-label-sm text-label-sm text-on-surface-variant">Rank</th>
                        <th class="p-2 font-label-sm text-label-sm text-on-surface-variant">Nama Duo</th>
                        <th class="p-2 font-label-sm text-label-sm text-on-surface-variant text-right">Streak</th>
                        <th class="p-2 font-label-sm text-label-sm text-on-surface-variant text-right">Skor</th>
                    </tr>
                </thead>
                <tbody class="space-y-2">
                    @foreach($leaderboard as $index => $board)
                    <tr class="border-2 rounded-lg {{ $board['is_current_user'] ? 'bg-primary-fixed/20 border-on-background' : ($index == 0 ? 'bg-secondary-fixed/30 border-on-background' : 'border-transparent') }}">
                        <td class="p-3 font-bold {{ $index == 0 ? 'text-primary' : ($board['is_current_user'] ? 'text-primary' : 'text-on-surface-variant') }}">#{{ $index + 1 }}</td>
                        <td class="p-3">
                            <div class="flex items-center gap-2">
                                <div class="flex -space-x-2 flex-shrink-0">
                                    <div class="w-8 h-8 rounded-full border-2 border-on-background bg-secondary-container overflow-hidden flex items-center justify-center">
                                        <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $board['avatar_1'] }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="Avatar 1" />
                                    </div>
                                    <div class="w-8 h-8 rounded-full border-2 border-on-background bg-primary-fixed-dim overflow-hidden flex items-center justify-center">
                                        <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $board['avatar_2'] }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="Avatar 2" />
                                    </div>
                                </div>
                                <span class="font-bold">{{ $board['name_1'] }} &amp; {{ $board['name_2'] }} {{ $board['is_current_user'] ? '(You)' : '' }}</span>
                            </div>
                        </td>
                        <td class="p-3 text-right font-bold text-error">{{ $board['streak'] }} 🔥</td>
                        <td class="p-3 text-right font-black">{{ $board['score'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Mitsur Chat Modal Popup -->
<div id="chat-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden" aria-labelledby="chat-modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div id="chat-modal-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Content -->
    <div class="bg-white border-3 border-on-background rounded-xl neobrutal-shadow max-w-lg w-full mx-4 overflow-hidden relative z-50 max-h-[85vh] h-[600px] flex flex-col transition-all">
        <!-- Modal Header -->
        <div class="p-4 border-b-3 border-on-background bg-secondary-container flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg border-2 border-on-background bg-primary-fixed overflow-hidden flex items-center justify-center">
                    @if($partner && $partner->avatar)
                        <img id="chat-partner-avatar" alt="Partner Avatar" class="w-full h-full object-cover" src="https://api.dicebear.com/9.x/micah/svg?seed={{ $partner->avatar }}&backgroundColor=transparent">
                    @elseif($partner)
                        <div id="chat-partner-initial" class="font-bold text-lg text-on-primary-fixed">{{ substr($partner->name, 0, 1) }}</div>
                    @endif
                </div>
                <div>
                    <h3 class="font-headline-md text-[18px] font-black text-on-secondary-container leading-tight" id="chat-modal-title">
                        {{ $partner ? explode(' ', $partner->name)[0] : 'Partner Chat' }}
                    </h3>
                    <p class="text-[10px] font-bold text-on-secondary-container/80 flex items-center gap-1">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500 border border-on-background animate-pulse"></span>
                        Aktif Bulan Ini (Auto-Cleanup)
                    </p>
                </div>
            </div>
            <button id="btn-close-chat-modal" class="w-8 h-8 border-2 border-on-background rounded-lg flex items-center justify-center bg-white hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] cursor-pointer">
                <span class="material-symbols-outlined text-lg font-black text-on-background">close</span>
            </button>
        </div>

        <!-- Chat Messages Area (Scrollable) -->
        <div id="chat-messages-container" class="p-4 overflow-y-auto flex-grow space-y-4 bg-background dark:bg-surface-container flex flex-col">
            <!-- Messages loaded dynamically -->
            <div id="chat-loading-placeholder" class="text-center py-8 text-on-surface-variant font-bold flex flex-col items-center gap-2">
                <span class="material-symbols-outlined animate-spin text-3xl">sync</span>
                Memuat percakapan...
            </div>
        </div>

        <!-- Modal Footer (Input Form) -->
        <div class="p-4 border-t-3 border-on-background bg-surface">
            <form id="chat-send-form" class="flex gap-3 m-0 p-0" onsubmit="event.preventDefault(); sendChatMessage();">
                <input type="text" id="chat-input-message" class="flex-grow bg-white border-3 border-on-background px-4 py-2.5 rounded-lg focus:outline-none focus:ring-0 text-sm font-bold shadow-[inset_0px_2px_4px_rgba(0,0,0,0.05)] text-black" placeholder="Tulis pesan untuk partner..." autocomplete="off" required>
                <button type="submit" class="bg-primary text-on-primary border-3 border-on-background neobrutal-shadow-sm px-4 rounded-lg font-bold flex items-center justify-center neobrutal-shadow-active transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-lg leading-none">send</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleChecklist(itemId) {
        const checkbox = document.getElementById('input-' + itemId);
        const box = document.getElementById('check-' + itemId);
        
        if (!checkbox || !box) return;
        
        const checkIcon = box.querySelector('span');
        
        if (checkbox.checked) {
            checkbox.checked = false;
            box.classList.remove('bg-secondary');
            box.classList.add('bg-surface');
            if (checkIcon) checkIcon.classList.add('hidden');
        } else {
            checkbox.checked = true;
            box.classList.add('bg-secondary');
            box.classList.remove('bg-surface');
            if (checkIcon) checkIcon.classList.remove('hidden');
        }
    }

    const leaderboardModal = document.getElementById('leaderboard-modal');
    const btnLihatSemuaPeringkat = document.getElementById('btn-lihat-semua-peringkat');
    const btnCloseLeaderboardModal = document.getElementById('btn-close-leaderboard-modal');
    const leaderboardModalBackdrop = document.getElementById('leaderboard-modal-backdrop');

    if (leaderboardModal && btnLihatSemuaPeringkat && btnCloseLeaderboardModal && leaderboardModalBackdrop) {
        btnLihatSemuaPeringkat.addEventListener('click', function() {
            leaderboardModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        const hideLeaderboardModal = function() {
            leaderboardModal.classList.add('hidden');
            document.body.style.overflow = '';
        };

        btnCloseLeaderboardModal.addEventListener('click', hideLeaderboardModal);
        leaderboardModalBackdrop.addEventListener('click', hideLeaderboardModal);
        
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !leaderboardModal.classList.contains('hidden')) {
                hideLeaderboardModal();
            }
        });
    }

    // Chat functionality
    const chatModal = document.getElementById('chat-modal');
    const btnOpenChat = document.getElementById('btn-open-chat');
    const btnCloseChatModal = document.getElementById('btn-close-chat-modal');
    const chatModalBackdrop = document.getElementById('chat-modal-backdrop');
    const chatMessagesContainer = document.getElementById('chat-messages-container');
    const chatInputMessage = document.getElementById('chat-input-message');
    let chatPollInterval = null;
    let lastMessageCount = -1;

    if (chatModal && btnOpenChat && btnCloseChatModal && chatModalBackdrop) {
        btnOpenChat.addEventListener('click', function() {
            chatModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            loadChatMessages(true);
            
            chatPollInterval = setInterval(function() {
                loadChatMessages(false);
            }, 3000);
        });

        const hideChatModal = function() {
            chatModal.classList.add('hidden');
            document.body.style.overflow = '';
            if (chatPollInterval) {
                clearInterval(chatPollInterval);
                chatPollInterval = null;
            }
            lastMessageCount = -1;
        };

        btnCloseChatModal.addEventListener('click', hideChatModal);
        chatModalBackdrop.addEventListener('click', hideChatModal);
        
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !chatModal.classList.contains('hidden')) {
                hideChatModal();
            }
        });
    }

    function loadChatMessages(forceScroll = false) {
        fetch("{{ route('mitsur.messages') }}")
            .then(response => response.json())
            .then(data => {
                const loadingPlaceholder = document.getElementById('chat-loading-placeholder');
                if (loadingPlaceholder) {
                    loadingPlaceholder.remove();
                }

                if (!data.messages || data.messages.length === 0) {
                    chatMessagesContainer.innerHTML = `
                        <div id="chat-empty-placeholder" class="text-center py-12 text-on-surface-variant font-bold">
                            <span class="material-symbols-outlined text-4xl block mb-2 opacity-50">forum</span>
                            Belum ada pesan bulan ini. Mulai obrolan dengan partner Anda!
                        </div>
                    `;
                    lastMessageCount = 0;
                    return;
                }

                if (data.messages.length !== lastMessageCount || forceScroll) {
                    const emptyPlaceholder = document.getElementById('chat-empty-placeholder');
                    if (emptyPlaceholder) {
                        emptyPlaceholder.remove();
                    }

                    let html = '';
                    data.messages.forEach(msg => {
                        if (msg.is_own) {
                            html += `
                                <div class="max-w-[80%] ml-auto p-3 bg-secondary text-white border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] rounded-lg rounded-tr-none flex flex-col items-end my-1">
                                    <p class="font-bold text-sm text-right break-words w-full">${escapeHtml(msg.message)}</p>
                                    <span class="text-[9px] font-bold text-white/80 mt-1">${msg.time}</span>
                                </div>
                            `;
                        } else {
                            html += `
                                <div class="max-w-[80%] mr-auto p-3 bg-white text-on-background border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] rounded-lg rounded-tl-none flex flex-col items-start my-1 text-black">
                                    <span class="text-[10px] font-black text-primary mb-1">${escapeHtml(msg.sender_name)}</span>
                                    <p class="font-bold text-sm text-left break-words w-full">${escapeHtml(msg.message)}</p>
                                    <span class="text-[9px] font-bold text-on-surface-variant mt-1 w-full text-right">${msg.time}</span>
                                </div>
                            `;
                        }
                    });

                    chatMessagesContainer.innerHTML = html;
                    lastMessageCount = data.messages.length;
                    
                    chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
                }
            })
            .catch(err => console.error('Error fetching chat:', err));
    }

    function sendChatMessage() {
        const message = chatInputMessage.value.trim();
        if (!message) return;

        chatInputMessage.value = '';

        fetch("{{ route('mitsur.send') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadChatMessages(true);
            }
        })
        .catch(err => console.error('Error sending message:', err));
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

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
