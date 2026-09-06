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
    <title>Rekap Kehadiran Santri - Daaru Hiraa</title>
    <style>
        :root {
            --primary-container: #064e3b;
            --surface-container-lowest: #ffffff;
            --on-secondary: #ffffff;
            --on-primary: #ffffff;
            --on-tertiary: #ffffff;
            --surface-tint: #2b6954;
            --tertiary-fixed: #ffdf9f;
            --surface-container: #f3f4f6;
            --surface-container-highest: #e5e7eb;
            --tertiary-container: #584000;
            --on-tertiary-container: #e0a800;
            --outline: #707974;
            --on-error: #ffffff;
            --secondary-fixed: #a6f2cf;
            --outline-variant: #bfc9c3;
            --on-surface-variant: #4b5563;
            --surface: #f9fafb;
            --surface-container-high: #e5e7eb;
            --inverse-surface: #303030;
            --on-secondary-container: #064e3b;
            --background: #f9fafb;
            --primary: #003527;
            --on-primary-container: #80bea6;
            --secondary: #1b6b4f;
            --surface-variant: #e2e2e2;
            --surface-dim: #dadada;
            --inverse-primary: #95d3ba;
            --error: #ba1a1a;
            --surface-container-low: #f3f3f3;
            --surface-bright: #f9f9f9;
            --on-background: #111827;
            --on-surface: #111827;
            --secondary-container: #a6f2cf;
            --primary-fixed: #b0f0d6;
            --error-container: #ffdad6;
            --inverse-on-surface: #f1f1f1;
            --tertiary: #3c2b00;
        }

        .dark {
            --primary-container: #065f46;
            --surface-container-lowest: #18181b;
            --on-secondary: #002115;
            --on-primary: #ffffff;
            --on-tertiary: #261a00;
            --surface-tint: #4ade80;
            --tertiary-fixed: #584000;
            --surface-container: #27272a;
            --surface-container-highest: #3f3f46;
            --tertiary-container: #ffdf9f;
            --on-tertiary-container: #ffdf9f;
            --outline: #94a3b8;
            --on-error: #601410;
            --secondary-fixed: #003527;
            --outline-variant: #4a5568;
            --on-surface-variant: #9ca3af;
            --surface: #121212;
            --surface-container-high: #27272a;
            --inverse-surface: #f1f1f1;
            --on-secondary-container: #a6f2cf;
            --background: #09090b;
            --primary: #4ade80;
            --on-primary-container: #a6f2cf;
            --secondary: #22c55e;
            --surface-variant: #2d2d2d;
            --surface-dim: #151515;
            --inverse-primary: #003527;
            --error: #f87171;
            --surface-container-low: #222222;
            --surface-bright: #1e1e1e;
            --on-background: #f4f4f5;
            --on-surface: #f4f4f5;
            --secondary-container: #064e3b;
            --primary-fixed: #1b6b4f;
            --error-container: #8c1d18;
            --inverse-on-surface: #121212;
            --tertiary: #ffdf9f;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* Animated Soft Neobrutalism Background */
        .bg-rekap-animated {
            background: linear-gradient(-45deg, #e0f2fe, #d1fae5, #fef3c7, #e0fdf4);
            background-size: 400% 400%;
            animation: gradient-shift 18s ease infinite;
        }
        .dark .bg-rekap-animated {
            background: linear-gradient(-45deg, #09090b, #052e16, #0c1a16, #09090b);
            background-size: 400% 400%;
        }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Soft Neobrutalist Elements */
        .neo-card {
            border: 3.5px solid #000;
            border-radius: 1.5rem;
            box-shadow: 6px 6px 0px 0px #000;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .dark .neo-card {
            border-color: #fff;
            box-shadow: 6px 6px 0px 0px #fff;
        }

        .neo-btn {
            border: 3px solid #000;
            border-radius: 1rem;
            box-shadow: 4px 4px 0px 0px #000;
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
            user-select: none;
        }
        .neo-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #000;
        }
        .neo-btn:active {
            transform: translate(0px, 0px);
            box-shadow: 2px 2px 0px 0px #000;
        }
        .dark .neo-btn {
            border-color: #fff;
            box-shadow: 4px 4px 0px 0px #fff;
        }
        .dark .neo-btn:hover { box-shadow: 6px 6px 0px 0px #fff; }
        .dark .neo-btn:active { box-shadow: 2px 2px 0px 0px #fff; }

        .neo-nav-card {
            border: 3.5px solid #000;
            border-radius: 1.25rem;
            box-shadow: 5px 5px 0px 0px #000;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
        }
        .neo-nav-card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 8px 8px 0px 0px #000;
        }
        .neo-nav-card:active {
            transform: translate(0, 0);
            box-shadow: 4px 4px 0px 0px #000;
        }
        .dark .neo-nav-card {
            border-color: #fff;
            box-shadow: 5px 5px 0px 0px #fff;
        }
        .dark .neo-nav-card:hover { box-shadow: 8px 8px 0px 0px #fff; }
        .dark .neo-nav-card:active { box-shadow: 4px 4px 0px 0px #fff; }

        /* Keyframes */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes barGrow {
            from { width: 0%; }
        }
        @keyframes sparkle {
            0%, 100% { transform: scale(0.6) rotate(0deg); opacity: 0.3; }
            50% { transform: scale(1.1) rotate(45deg); opacity: 0.9; }
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .animate-fade-up {
            opacity: 0;
            animation: fadeInUp 0.45s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        .animate-fade-up-d1 { animation-delay: 0.08s; }
        .animate-fade-up-d2 { animation-delay: 0.16s; }
        .animate-fade-up-d3 { animation-delay: 0.24s; }
        .animate-fade-up-d4 { animation-delay: 0.32s; }
        
        .bar-animated {
            animation: barGrow 0.9s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        .ring-chart {
            transition: stroke-dasharray 1s ease-out;
        }
        .animate-sparkle-1 { animation: sparkle 4s ease-in-out infinite; }
        .animate-sparkle-2 { animation: sparkle 5s ease-in-out infinite 1.5s; }
        .animate-float-slow { animation: floatSlow 5s ease-in-out infinite; }

        /* Dark mode selects */
        .dark select, .dark input {
            background-color: var(--surface-container-lowest) !important;
            color: var(--on-surface) !important;
            border-color: #fff !important;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-rekap-animated text-on-surface font-body min-h-screen relative selection:bg-emerald-300 selection:text-black">

    <!-- Background Sparkles -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
        <svg class="absolute text-yellow-400/40 dark:text-yellow-300/30 fill-current animate-sparkle-1" style="top: 8%; right: 10%; height: 24px; width: 24px;" viewBox="0 0 24 24">
            <path d="M12,0 L15,9 L24,12 L15,15 L12,24 L9,15 L0,12 L9,9 Z" />
        </svg>
        <svg class="absolute text-emerald-400/30 dark:text-emerald-300/20 fill-current animate-sparkle-2" style="top: 55%; left: 6%; height: 20px; width: 20px;" viewBox="0 0 24 24">
            <path d="M12,0 L15,9 L24,12 L15,15 L12,24 L9,15 L0,12 L9,9 Z" />
        </svg>
        <svg class="absolute text-yellow-400/30 dark:text-yellow-200/40 fill-current animate-float-slow" style="top: 4%; left: 18%; height: 42px; width: 42px;" viewBox="0 0 24 24">
            <path d="M12.1,22 C17.6,22 22,17.6 22,12.1 C22,11.5 21.9,10.9 21.8,10.3 C20.3,11.8 18.2,12.8 15.9,12.8 C11.3,12.8 7.6,9.1 7.6,4.5 C7.6,3 8.1,1.7 8.9,0.6 C4,1.8 0.5,6.3 0.5,11.6 C0.5,17.3 5.2,22 12.1,22 Z" />
        </svg>
    </div>

    <!-- Floating Theme Toggle -->
    <div class="fixed top-4 right-4 z-50">
        <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-white dark:bg-zinc-800 text-black dark:text-white border-3 border-black dark:border-white rounded-2xl shadow-[4px_4px_0px_0px_#000] dark:shadow-[4px_4px_0px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_#000] dark:hover:shadow-[6px_6px_0px_0px_#fff] active:translate-x-0 active:translate-y-0 transition-all cursor-pointer" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-xl block dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-xl hidden dark:block">light_mode</span>
        </button>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 md:px-8 py-8 pb-16">

        @php
            $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            $totalSantri = count($studentStats);
            $avgAttendance = $totalSantri > 0 ? round(collect($studentStats)->avg('percentage')) : 0;
            // Sort top 3 for leaderboard podium
            $topPerformers = collect($studentStats)->sortByDesc('percentage')->take(3)->values();
        @endphp

        <!-- Header & Hero Section -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8 animate-fade-up">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-200 dark:bg-emerald-950 text-emerald-900 dark:text-emerald-300 font-cartoon font-bold text-xs rounded-full border-2 border-black dark:border-white shadow-[2px_2px_0_0_#000] dark:shadow-[2px_2px_0_0_#fff] mb-2">
                    <span>📊 PUSAT STATISTIK</span>
                    <span>•</span>
                    <span>{{ $monthNames[$month] }} {{ $year }}</span>
                </div>
                <h1 class="font-cartoon text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                    Rekap Kehadiran
                    <span class="inline-block transform hover:rotate-12 transition-transform cursor-pointer">📈</span>
                </h1>
                <p class="font-body text-slate-600 dark:text-slate-300 mt-1 text-sm md:text-base font-medium">
                    Analisis lengkap tingkat kedisiplinan dan persentase kehadiran seluruh santri.
                </p>
            </div>
            <div class="flex items-center gap-3 self-stretch sm:self-auto">
                <a href="{{ route('dashboard') }}" class="neo-btn bg-white dark:bg-zinc-800 text-slate-900 dark:text-white font-cartoon font-bold px-5 py-2.5 flex items-center justify-center gap-2 text-sm no-underline w-full sm:w-auto">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    Dashboard
                </a>
            </div>
        </div>

        <!-- Filter Panel & Quick Stats Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 animate-fade-up animate-fade-up-d1">
            <!-- Filter Form Card -->
            <div class="lg:col-span-2 neo-card bg-white dark:bg-zinc-900 p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-cartoon text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400">tune</span>
                            Filter Periode Laporan
                        </h3>
                        <span class="px-2.5 py-0.5 bg-emerald-100 dark:bg-emerald-900/60 text-emerald-800 dark:text-emerald-300 font-cartoon font-bold text-xs rounded-lg border border-black/20 dark:border-white/20">
                            Live Data
                        </span>
                    </div>

                    <form method="GET" action="{{ route('rekap') }}" class="flex flex-wrap items-end gap-3 sm:gap-4">
                        <div class="flex-1 min-w-[140px]">
                            <label class="font-cartoon font-bold text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5 block">Pilih Bulan</label>
                            <div class="relative">
                                <select name="month" class="w-full neo-btn bg-emerald-50 dark:bg-zinc-800 text-slate-900 dark:text-white font-cartoon font-bold px-4 py-2.5 text-sm appearance-none pr-8">
                                    @php
                                        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                    @endphp
                                    @foreach($months as $i => $name)
                                        <option value="{{ $i + 1 }}" {{ $month == $i + 1 ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-600 dark:text-slate-300 text-lg">unfold_more</span>
                            </div>
                        </div>

                        <div class="w-28">
                            <label class="font-cartoon font-bold text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5 block">Tahun</label>
                            <div class="relative">
                                <select name="year" class="w-full neo-btn bg-emerald-50 dark:bg-zinc-800 text-slate-900 dark:text-white font-cartoon font-bold px-4 py-2.5 text-sm appearance-none pr-8">
                                    @for($y = now()->year; $y >= now()->year - 2; $y--)
                                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-600 dark:text-slate-300 text-lg">unfold_more</span>
                            </div>
                        </div>

                        <button type="submit" class="neo-btn bg-emerald-400 dark:bg-emerald-600 text-slate-900 dark:text-white font-cartoon font-bold px-6 py-2.5 text-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">search</span>
                            Tampilkan
                        </button>
                    </form>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-200 dark:border-zinc-800 flex items-center justify-between text-xs font-body font-semibold text-slate-500 dark:text-slate-400">
                    <span>📅 Periode: {{ $monthNames[$month] }} {{ $year }}</span>
                    <span>📌 Total KBM: <strong class="text-slate-800 dark:text-slate-200 font-cartoon">{{ $totalKBMDays }} Hari</strong></span>
                </div>
            </div>

            <!-- Quick Summary Widget Card -->
            <div class="neo-card bg-emerald-400 dark:bg-emerald-950 p-6 flex flex-col justify-between text-slate-900 dark:text-emerald-100 relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 text-emerald-300/30 dark:text-emerald-800/30 font-cartoon text-9xl font-black select-none pointer-events-none">
                    %
                </div>
                <div>
                    <span class="font-cartoon font-extrabold text-xs uppercase tracking-wider px-2.5 py-1 bg-black text-white dark:bg-white dark:text-black rounded-md border border-black/10 inline-block mb-3">
                        Rata-Rata Kehadiran
                    </span>
                    <div class="flex items-baseline gap-2">
                        <span class="font-cartoon text-5xl font-black tracking-tight drop-shadow-sm">{{ $avgAttendance }}%</span>
                        <span class="font-body text-xs font-bold text-slate-800 dark:text-emerald-300">Seluruh Santri</span>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-black/10 dark:border-white/10 flex items-center justify-between text-xs font-body font-bold">
                    <span>👥 Total Santri: {{ $totalSantri }} Orang</span>
                    <span class="px-2 py-0.5 bg-white/80 dark:bg-black/40 rounded text-[11px] font-cartoon">
                        {{ $avgAttendance >= 75 ? '🔥 Sangat Baik' : ($avgAttendance >= 50 ? '⚠️ Cukup' : '🚨 Perlu Perhatian') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Leaderboard Podium Card (Top 3 Santri Ter-Istiqomah) -->
        @if($topPerformers->count() > 0 && $avgAttendance > 0)
            <div class="neo-card bg-amber-100 dark:bg-zinc-900 p-6 mb-8 animate-fade-up animate-fade-up-d2">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="font-cartoon text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>🏆</span>
                            Santri Ter-Istiqomah Bulanan
                        </h2>
                        <p class="text-xs font-body text-slate-600 dark:text-slate-400 mt-0.5">3 Santri dengan persentase kehadiran tertinggi di bulan {{ $monthNames[$month] }}.</p>
                    </div>
                    <span class="hidden sm:inline-block px-3 py-1 bg-amber-300 dark:bg-amber-900 text-amber-900 dark:text-amber-200 font-cartoon font-bold text-xs rounded-full border-2 border-black dark:border-white">
                        Podium Kehadiran
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @php
                        $medals = ['🥇', '🥈', '🥉'];
                        $podiumBgs = [
                            'bg-yellow-300 dark:bg-amber-950 border-yellow-500',
                            'bg-slate-200 dark:bg-zinc-800 border-slate-400',
                            'bg-amber-200 dark:bg-stone-900 border-amber-600'
                        ];
                    @endphp
                    @foreach($topPerformers as $rank => $top)
                        <div class="neo-btn {{ $podiumBgs[$rank] ?? 'bg-white' }} p-4 flex items-center gap-3">
                            <div class="text-3xl shrink-0">{{ $medals[$rank] ?? '🎖️' }}</div>
                            <div class="min-w-0 flex-1">
                                <div class="font-cartoon font-bold text-sm text-slate-900 dark:text-white truncate" title="{{ $top['name'] }}">
                                    {{ $top['name'] }}
                                </div>
                                <div class="text-xs font-body font-semibold text-slate-600 dark:text-slate-400 flex items-center justify-between mt-1">
                                    <span>{{ $top['hadir'] }}/{{ $top['kbm'] }} Hari</span>
                                    <span class="font-cartoon font-bold text-sm text-emerald-700 dark:text-emerald-400">{{ $top['percentage'] }}%</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Main Bar Chart Card: Kehadiran Seluruh Santri -->
        <div class="neo-card bg-white dark:bg-zinc-900 p-6 mb-8 animate-fade-up animate-fade-up-d2">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                <div>
                    <h2 class="font-cartoon text-xl md:text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span>📊</span>
                        Grafik Kehadiran Santri — {{ $monthNames[$month] }} {{ $year }}
                    </h2>
                    <p class="text-xs font-body text-slate-500 dark:text-slate-400 mt-0.5">Persentase dihitung dari total KBM aktif ({{ $totalKBMDays }} hari).</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="neo-btn bg-emerald-200 dark:bg-emerald-900/60 text-emerald-900 dark:text-emerald-200 px-3 py-1 text-xs font-cartoon font-bold cursor-default">
                        Total: {{ count($studentStats) }} Santri
                    </span>
                </div>
            </div>

            @if(count($studentStats) === 0)
                <div class="text-center py-12 text-slate-500 dark:text-slate-400">
                    <span class="text-5xl block mb-3 animate-bounce">📭</span>
                    <p class="font-cartoon text-lg font-bold text-slate-800 dark:text-slate-200">Belum Ada Data Kehadiran</p>
                    <p class="text-xs font-body mt-1">Silakan pilih bulan atau tahun lain di panel filter.</p>
                </div>
            @else
                <div class="space-y-3.5 max-h-[550px] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($studentStats as $i => $stat)
                        @php
                            $pct = $stat['percentage'];
                            $barColor = $pct >= 75 ? 'bg-emerald-400 dark:bg-emerald-500' : ($pct >= 50 ? 'bg-amber-400 dark:bg-amber-500' : 'bg-rose-400 dark:bg-rose-500');
                            $textColor = $pct >= 75 ? 'text-emerald-700 dark:text-emerald-400' : ($pct >= 50 ? 'text-amber-700 dark:text-amber-400' : 'text-rose-700 dark:text-rose-400');
                            $delay = min($i * 0.04, 1.2);
                        @endphp
                        <div class="flex items-center gap-3 group" style="animation: fadeInUp 0.4s ease forwards; animation-delay: {{ $delay }}s; opacity: 0;">
                            <!-- Rank badge -->
                            <div class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-zinc-800 border-2 border-black dark:border-white font-cartoon font-bold text-xs flex items-center justify-center shrink-0">
                                {{ $i + 1 }}
                            </div>

                            <!-- Name -->
                            <div class="w-32 sm:w-44 md:w-56 text-xs sm:text-sm font-body font-bold text-slate-800 dark:text-slate-100 truncate shrink-0" title="{{ $stat['name'] }}">
                                {{ $stat['name'] }}
                            </div>

                            <!-- Progress Bar Container -->
                            <div class="flex-1 bg-slate-100 dark:bg-zinc-800 rounded-xl h-8 relative overflow-hidden border-2 border-black dark:border-white p-0.5">
                                <div class="bar-animated {{ $barColor }} h-full rounded-lg flex items-center justify-end pr-2.5 transition-all shadow-sm" style="width: {{ max($pct, 4) }}%; animation-delay: {{ $delay + 0.15 }}s;">
                                    @if($pct >= 20)
                                        <span class="text-[11px] font-cartoon font-bold text-slate-900 dark:text-white drop-shadow-sm">
                                            {{ $stat['hadir'] }}/{{ $stat['kbm'] }} Hari
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Percentage -->
                            <div class="w-14 text-right font-cartoon font-extrabold text-sm sm:text-base {{ $textColor }} shrink-0">
                                {{ $pct }}%
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Session Ring Charts Section -->
        <h2 class="font-cartoon text-2xl font-bold text-slate-900 dark:text-white mb-4 animate-fade-up animate-fade-up-d3 flex items-center gap-2">
            <span>📚</span>
            Kehadiran Per Sesi Kegiatan
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            @php
                $sessionColors = [
                    'Kajian' => [
                        'stroke' => '#10b981',
                        'bg' => 'bg-emerald-50 dark:bg-zinc-900',
                        'badgeBg' => 'bg-emerald-300 dark:bg-emerald-950 text-emerald-950 dark:text-emerald-200',
                        'text' => 'text-emerald-700 dark:text-emerald-400',
                        'icon' => '📖',
                        'desc' => 'Kajian Rutin Santri'
                    ],
                    'Subuh' => [
                        'stroke' => '#f59e0b',
                        'bg' => 'bg-amber-50 dark:bg-zinc-900',
                        'badgeBg' => 'bg-amber-300 dark:bg-amber-950 text-amber-950 dark:text-amber-200',
                        'text' => 'text-amber-700 dark:text-amber-400',
                        'icon' => '🌅',
                        'desc' => 'Shalat & Dzikir Subuh'
                    ],
                    'Tahsin' => [
                        'stroke' => '#6366f1',
                        'bg' => 'bg-indigo-50 dark:bg-zinc-900',
                        'badgeBg' => 'bg-indigo-300 dark:bg-indigo-950 text-indigo-950 dark:text-indigo-200',
                        'text' => 'text-indigo-700 dark:text-indigo-400',
                        'icon' => '📿',
                        'desc' => 'Tahsin & Setoran Quran'
                    ],
                ];
            @endphp

            @foreach($sessionStats as $type => $stat)
                @php
                    $color = $sessionColors[$type] ?? [
                        'stroke' => '#64748b',
                        'bg' => 'bg-slate-50 dark:bg-zinc-900',
                        'badgeBg' => 'bg-slate-200 dark:bg-zinc-800 text-slate-800 dark:text-slate-200',
                        'text' => 'text-slate-700 dark:text-slate-300',
                        'icon' => '📋',
                        'desc' => 'Kegiatan Santri'
                    ];
                    $circumference = 2 * 3.14159 * 42;
                    $dashArray = ($stat['percentage'] / 100) * $circumference;
                    $dashOffset = $circumference - $dashArray;
                @endphp
                <div class="neo-card {{ $color['bg'] }} p-6 text-center animate-fade-up animate-fade-up-d3 flex flex-col justify-between items-center group">
                    <div class="w-full">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 font-cartoon font-bold text-xs rounded-full border-2 border-black dark:border-white {{ $color['badgeBg'] }} mb-3">
                            <span>{{ $color['icon'] }}</span>
                            <span>{{ strtoupper($type) }}</span>
                        </div>
                        <h3 class="font-cartoon text-lg font-bold text-slate-900 dark:text-white">{{ $type }}</h3>
                        <p class="text-xs font-body text-slate-500 dark:text-slate-400 mb-4">{{ $color['desc'] }}</p>
                    </div>

                    <!-- SVG Ring Chart -->
                    <div class="relative inline-block my-2 transform group-hover:scale-105 transition-transform">
                        <svg width="130" height="130" viewBox="0 0 100 100" class="transform -rotate-90">
                            <circle cx="50" cy="50" r="42" fill="none" stroke-width="10" class="stroke-slate-200 dark:stroke-zinc-800" />
                            <circle cx="50" cy="50" r="42" fill="none" stroke-width="10" stroke="{{ $color['stroke'] }}"
                                    stroke-linecap="round"
                                    stroke-dasharray="{{ $dashArray }} {{ $dashOffset }}"
                                    class="ring-chart" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="font-cartoon text-2xl font-black {{ $color['text'] }}">{{ $stat['percentage'] }}%</span>
                            <span class="text-[10px] font-cartoon font-bold text-slate-400 uppercase">Hadir</span>
                        </div>
                    </div>

                    <div class="w-full mt-4 pt-3 border-t border-black/10 dark:border-white/10 flex justify-around text-xs font-body font-bold text-slate-700 dark:text-slate-300">
                        <span class="flex items-center gap-1">✅ {{ $stat['hadir'] }} Hadir</span>
                        <span>•</span>
                        <span class="flex items-center gap-1">📊 {{ $stat['total'] }} Absensi</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Cards: Rekap Detail -->
        <h2 class="font-cartoon text-2xl font-bold text-slate-900 dark:text-white mb-4 animate-fade-up animate-fade-up-d3 flex items-center gap-2">
            <span>📂</span>
            Pilih Tampilan Rekap Detail
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Rekap Bulanan Nav Card -->
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'bulanan']) }}" class="neo-nav-card bg-emerald-100 dark:bg-zinc-900 p-6 flex flex-col items-center gap-4 text-center animate-fade-up animate-fade-up-d3 no-underline group">
                <div class="w-16 h-16 bg-emerald-400 dark:bg-emerald-600 rounded-2xl flex items-center justify-center text-3xl border-3 border-black dark:border-white shadow-[3px_3px_0_0_#000] dark:shadow-[3px_3px_0_0_#fff] group-hover:scale-110 transition-transform">
                    📅
                </div>
                <div>
                    <h3 class="font-cartoon text-lg font-bold text-slate-900 dark:text-white mb-1">Rekap Bulanan</h3>
                    <p class="text-xs font-body text-slate-600 dark:text-slate-400">Tabel matriks kehadiran santri per tanggal (1-31) dalam sebulan.</p>
                </div>
                <span class="mt-auto neo-btn bg-white dark:bg-zinc-800 text-slate-900 dark:text-white font-cartoon font-bold px-4 py-1.5 text-xs flex items-center gap-1">
                    Buka Tabel Bulanan
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </a>

            <!-- Rekap Mingguan Nav Card -->
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'mingguan']) }}" class="neo-nav-card bg-amber-100 dark:bg-zinc-900 p-6 flex flex-col items-center gap-4 text-center animate-fade-up animate-fade-up-d3 no-underline group">
                <div class="w-16 h-16 bg-amber-400 dark:bg-amber-600 rounded-2xl flex items-center justify-center text-3xl border-3 border-black dark:border-white shadow-[3px_3px_0_0_#000] dark:shadow-[3px_3px_0_0_#fff] group-hover:scale-110 transition-transform">
                    📋
                </div>
                <div>
                    <h3 class="font-cartoon text-lg font-bold text-slate-900 dark:text-white mb-1">Rekap Mingguan</h3>
                    <p class="text-xs font-body text-slate-600 dark:text-slate-400">Detail status absensi (H/I/A/S) per hari dalam 1 minggu.</p>
                </div>
                <span class="mt-auto neo-btn bg-white dark:bg-zinc-800 text-slate-900 dark:text-white font-cartoon font-bold px-4 py-1.5 text-xs flex items-center gap-1">
                    Buka Tabel Mingguan
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </a>

            <!-- Rekap Tahunan Nav Card -->
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'tahunan']) }}" class="neo-nav-card bg-indigo-100 dark:bg-zinc-900 p-6 flex flex-col items-center gap-4 text-center animate-fade-up animate-fade-up-d4 no-underline group">
                <div class="w-16 h-16 bg-indigo-400 dark:bg-indigo-600 rounded-2xl flex items-center justify-center text-3xl border-3 border-black dark:border-white shadow-[3px_3px_0_0_#000] dark:shadow-[3px_3px_0_0_#fff] group-hover:scale-110 transition-transform">
                    🌐
                </div>
                <div>
                    <h3 class="font-cartoon text-lg font-bold text-slate-900 dark:text-white mb-1">Rekap Tahunan</h3>
                    <p class="text-xs font-body text-slate-600 dark:text-slate-400">Ringkasan akumulasi kehadiran santri selama 12 bulan.</p>
                </div>
                <span class="mt-auto neo-btn bg-white dark:bg-zinc-800 text-slate-900 dark:text-white font-cartoon font-bold px-4 py-1.5 text-xs flex items-center gap-1">
                    Buka Tabel Tahunan
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </a>
        </div>
    </div>

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
    </script>
</body>
</html>

