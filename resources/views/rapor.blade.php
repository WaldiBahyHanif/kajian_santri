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
    <title>Rapor Santri - Daaru Hiraa</title>
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

        @media print {
            body { background: white !important; color: black !important; }
            header, aside, footer, .fab-btn, .no-print { display: none !important; }
            main { padding: 0 !important; margin: 0 !important; }
            .neobrutal-shadow, .neobrutal-shadow-sm { box-shadow: none !important; }
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

    <x-sidebar active="rapor" />

<!-- Main Content Canvas -->
<main class="pt-24 pb-24 md:pl-72 md:pr-10 px-4">
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Header Section -->
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary tracking-tight">📚 Rapor Santri</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">Rekap kehadiran dan pencapaian belajar Anda.</p>
            </div>
            <button onclick="window.print()" class="no-print bg-primary text-on-primary border-3 border-on-background px-6 py-3 rounded-lg font-bold neobrutal-shadow neobrutal-shadow-active transition-all flex items-center gap-2">
                <span class="material-symbols-outlined">print</span>
                Cetak Rapor
            </button>
        </section>

        <!-- Student Info & Overview -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Profile Block -->
            <div class="md:col-span-8 bg-white border-3 border-on-background p-8 rounded-xl neobrutal-shadow flex items-center gap-6">
                <div class="w-20 h-20 bg-primary-container border-3 border-on-background rounded-xl flex items-center justify-center text-4xl font-black text-on-primary-container flex-shrink-0">
                    @if($user->avatar)
                        <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $user->avatar }}&backgroundColor=transparent" class="w-full h-full object-cover rounded-lg" alt="User Avatar" />
                    @else
                        {{ substr($user->name, 0, 1) }}
                    @endif
                </div>
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-primary">{{ $user->name }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">ID: SANTRI-{{ $user->id }} | Role: {{ $user->title }}</p>
                </div>
            </div>

            <!-- Overall Grade -->
            <div class="md:col-span-4 bg-tertiary-fixed border-3 border-on-background p-8 rounded-xl neobrutal-shadow flex flex-col justify-center items-center">
                <h3 class="font-label-sm text-label-sm text-on-tertiary-fixed-variant uppercase tracking-widest mb-2 text-center">Overall Grade</h3>
                <div class="text-6xl font-black text-on-tertiary-fixed-variant">{{ $overallGrade }}</div>
                <p class="font-bold mt-2 bg-primary text-on-primary px-3 py-1 rounded-lg border-2 border-on-background text-sm">{{ $overallLabel }}</p>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-secondary-container border-3 border-on-background p-6 rounded-xl neobrutal-shadow-sm text-center">
                <h4 class="font-label-sm text-label-sm text-on-secondary-container uppercase mb-2">Total Hadir</h4>
                <span class="text-4xl font-black text-on-secondary-container">{{ $totalH }}</span>
            </div>
            <div class="bg-primary-fixed border-3 border-on-background p-6 rounded-xl neobrutal-shadow-sm text-center">
                <h4 class="font-label-sm text-label-sm text-on-primary-fixed uppercase mb-2">Total Izin</h4>
                <span class="text-4xl font-black text-on-primary-fixed">{{ $totalI }}</span>
            </div>
            <div class="bg-error-container border-3 border-on-background p-6 rounded-xl neobrutal-shadow-sm text-center">
                <h4 class="font-label-sm text-label-sm text-on-error-container uppercase mb-2">Total Alpha</h4>
                <span class="text-4xl font-black text-on-error-container">{{ $totalA }}</span>
            </div>
            <div class="bg-white border-3 border-on-background p-6 rounded-xl neobrutal-shadow-sm text-center">
                <h4 class="font-label-sm text-label-sm text-on-surface-variant uppercase mb-2">Kehadiran</h4>
                <span class="text-4xl font-black text-primary">{{ $attendanceRate }}%</span>
            </div>
        </div>

        <!-- Subject Breakdowns -->
        <div class="bg-white border-3 border-on-background rounded-xl neobrutal-shadow overflow-hidden">
            <div class="bg-primary-container p-4 border-b-3 border-on-background flex justify-between items-center">
                <h2 class="font-headline-md text-headline-md text-on-primary-container">Detail Presensi per Sesi</h2>
                <span class="material-symbols-outlined text-on-primary-container">table_chart</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-3 border-on-background bg-surface-container">
                            <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase border-r-3 border-on-background">Sesi (Mata Pelajaran)</th>
                            <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase border-r-3 border-on-background text-center">Hadir / Izin</th>
                            <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase border-r-3 border-on-background text-center">Total Sesi</th>
                            <th class="p-4 font-label-sm text-label-sm text-on-surface-variant uppercase text-center">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sessionStats as $stat)
                            @php
                                $pct = $stat->total_count > 0 ? round(($stat->hadir_count / $stat->total_count) * 100) : 0;
                            @endphp
                            <tr class="border-b-2 border-on-background/20 hover:bg-surface-container-low transition-colors">
                                <td class="p-4 font-bold border-r-3 border-on-background/20 uppercase text-on-surface">{{ $stat->session_type }}</td>
                                <td class="p-4 font-bold border-r-3 border-on-background/20 text-center text-on-surface">{{ $stat->hadir_count }}</td>
                                <td class="p-4 font-bold border-r-3 border-on-background/20 text-center text-on-surface">{{ $stat->total_count }}</td>
                                <td class="p-4 font-bold text-center">
                                    <span class="px-3 py-1 border-2 border-on-background rounded-full font-label-sm text-label-sm {{ $pct >= 80 ? 'bg-secondary-container text-on-secondary-container' : ($pct >= 50 ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : 'bg-error-container text-on-error-container') }}">
                                        {{ $pct }}%
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-on-surface-variant italic">
                                    <span class="material-symbols-outlined text-4xl text-outline-variant block mb-2">analytics</span>
                                    Belum ada data rapor absensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<!-- BottomNavBar Removed -->

<!-- Floating Action Button (FAB) -->
<a href="{{ route('attendance.scan') }}" class="fab-btn fixed bottom-24 right-6 md:bottom-8 md:right-8 w-14 h-14 bg-primary text-on-primary border-3 border-on-background rounded-full neobrutal-shadow flex items-center justify-center hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all z-40">
    <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
</a>

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

</body>
</html>
