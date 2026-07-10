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
    <title>Rekap Santri - Daaru Hiraa</title>
                <style>
        :root {
            --primary-container: #064e3b;
            --surface-container-lowest: #ffffff;
            --on-secondary: #ffffff;
            --on-primary: #ffffff;
            --on-tertiary: #ffffff;
            --surface-tint: #2b6954;
            --tertiary-fixed: #ffdf9f;
            --surface-container: #eeeeee;
            --surface-container-highest: #e2e2e2;
            --tertiary-container: #584000;
            --on-tertiary-container: #e0a800;
            --outline: #707974;
            --on-error: #ffffff;
            --secondary-fixed: #a6f2cf;
            --outline-variant: #bfc9c3;
            --on-surface-variant: #404944;
            --surface: #f9f9f9;
            --surface-container-high: #e8e8e8;
            --inverse-surface: #303030;
            --on-secondary-container: #247155;
            --background: #f9f9f9;
            --primary: #003527;
            --on-primary-container: #80bea6;
            --secondary: #1b6b4f;
            --surface-variant: #e2e2e2;
            --surface-dim: #dadada;
            --inverse-primary: #95d3ba;
            --error: #ba1a1a;
            --surface-container-low: #f3f3f3;
            --surface-bright: #f9f9f9;
            --on-background: #1b1b1b;
            --on-surface: #1b1b1b;
            --secondary-container: #a6f2cf;
            --primary-fixed: #b0f0d6;
            --error-container: #ffdad6;
            --inverse-on-surface: #f1f1f1;
            --tertiary: #3c2b00;
        }

        .dark {
            --primary-container: #004d38;
            --surface-container-lowest: #1a1a1a;
            --on-secondary: #002115;
            --on-primary: #002117;
            --on-tertiary: #261a00;
            --surface-tint: #4ade80;
            --tertiary-fixed: #584000;
            --surface-container: #242424;
            --surface-container-highest: #3e3e3e;
            --tertiary-container: #ffdf9f;
            --on-tertiary-container: #ffdf9f;
            --outline: #94a3b8;
            --on-error: #601410;
            --secondary-fixed: #003527;
            --outline-variant: #4a5568;
            --on-surface-variant: #cbd5e1;
            --surface: #1e1e1e;
            --surface-container-high: #2d2d2d;
            --inverse-surface: #f1f1f1;
            --on-secondary-container: #a6f2cf;
            --background: #121212;
            --primary: #4ade80;
            --on-primary-container: #a6f2cf;
            --secondary: #22c55e;
            --surface-variant: #2d2d2d;
            --surface-dim: #151515;
            --inverse-primary: #003527;
            --error: #f87171;
            --surface-container-low: #222222;
            --surface-bright: #1e1e1e;
            --on-background: #f1f1f1;
            --on-surface: #f1f1f1;
            --secondary-container: #003527;
            --primary-fixed: #1b6b4f;
            --error-container: #8c1d18;
            --inverse-on-surface: #121212;
            --tertiary: #ffdf9f;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* Animated Background */
        .bg-rekap-animated {
            background: linear-gradient(-45deg, #e0f2fe, #d1fae5, #fef3c7, #e0fdf4);
            background-size: 400% 400%;
            animation: gradient-shift 18s ease infinite;
        }
        .dark .bg-rekap-animated {
            background: linear-gradient(-45deg, #022e23, #0b132b, #0c1a16, #052e16);
            background-size: 400% 400%;
        }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Cartoon Card */
        .cartoon-card {
            border: 4px solid #000;
            border-radius: 1.5rem;
            box-shadow: 8px 8px 0px 0px rgba(0, 53, 39, 0.15);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .dark .cartoon-card {
            border-color: #fff;
            box-shadow: 8px 8px 0px 0px rgba(255, 255, 255, 0.1);
        }

        .cartoon-btn {
            border: 3px solid #000;
            border-radius: 1rem;
            box-shadow: 4px 4px 0px 0px #000;
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .cartoon-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #000;
        }
        .cartoon-btn:active {
            transform: translate(0px, 0px);
            box-shadow: 4px 4px 0px 0px #000;
        }
        .dark .cartoon-btn {
            border-color: #fff;
            box-shadow: 4px 4px 0px 0px #fff;
        }
        .dark .cartoon-btn:hover { box-shadow: 6px 6px 0px 0px #fff; }
        .dark .cartoon-btn:active { box-shadow: 4px 4px 0px 0px #fff; }

        .cartoon-nav-card {
            border: 3px solid #000;
            border-radius: 1.25rem;
            box-shadow: 6px 6px 0px 0px #000;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
        }
        .cartoon-nav-card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000;
        }
        .cartoon-nav-card:active {
            transform: translate(0, 0);
            box-shadow: 6px 6px 0px 0px #000;
        }
        .dark .cartoon-nav-card {
            border-color: #fff;
            box-shadow: 6px 6px 0px 0px #fff;
        }
        .dark .cartoon-nav-card:hover { box-shadow: 9px 9px 0px 0px #fff; }
        .dark .cartoon-nav-card:active { box-shadow: 6px 6px 0px 0px #fff; }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes sparkle {
            0%, 100% { transform: scale(0.6) rotate(0deg); opacity: 0.3; }
            50% { transform: scale(1.1) rotate(45deg); opacity: 0.9; }
        }
        @keyframes drift-right {
            0% { transform: translateX(-15vw); }
            100% { transform: translateX(115vw); }
        }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(3deg); }
        }
        .animate-fade-up {
            opacity: 0;
            animation: fadeInUp 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        .animate-fade-up-d1 { animation-delay: 0.1s; }
        .animate-fade-up-d2 { animation-delay: 0.2s; }
        .animate-fade-up-d3 { animation-delay: 0.3s; }
        .animate-fade-up-d4 { animation-delay: 0.4s; }
        .animate-fade-scale {
            opacity: 0;
            animation: fadeInScale 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        .animate-sparkle-1 { animation: sparkle 4s ease-in-out infinite; }
        .animate-sparkle-2 { animation: sparkle 5s ease-in-out infinite 1.5s; }
        .animate-drift-slow { animation: drift-right 55s linear infinite; }
        .animate-float-slow { animation: float-slow 6s ease-in-out infinite; }

        /* Bar chart animation */
        @keyframes bar-grow {
            from { width: 0%; }
        }
        .bar-animated {
            animation: bar-grow 0.8s ease-out forwards;
        }

        /* Ring chart */
        .ring-chart {
            transition: stroke-dasharray 1s ease-out;
        }

        /* Dark mode input */
        .dark select, .dark input {
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
<body class="bg-rekap-animated text-on-surface font-body min-h-screen relative">

    <!-- Animated Background Canvas -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
        <svg class="absolute text-yellow-300/30 dark:text-yellow-200/40 fill-current animate-sparkle-1" style="top: 10%; right: 12%; height: 22px; width: 22px;" viewBox="0 0 24 24">
            <path d="M12,0 L15,9 L24,12 L15,15 L12,24 L9,15 L0,12 L9,9 Z" />
        </svg>
        <svg class="absolute text-yellow-300/20 dark:text-yellow-200/30 fill-current animate-sparkle-2" style="top: 60%; left: 8%; height: 18px; width: 18px;" viewBox="0 0 24 24">
            <path d="M12,0 L15,9 L24,12 L15,15 L12,24 L9,15 L0,12 L9,9 Z" />
        </svg>
        <svg class="absolute text-white/40 dark:text-slate-700/15 fill-current animate-drift-slow" style="top: 20%; height: 45px; width: 90px;" viewBox="0 0 120 60">
            <path d="M20,40 C20,30 30,25 40,25 C45,15 60,10 75,18 C85,10 100,15 100,30 C110,30 115,38 110,48 C105,55 95,55 90,55 L30,55 C15,55 10,48 20,40 Z"/>
        </svg>
        <svg class="absolute text-yellow-300/40 dark:text-yellow-100/50 fill-current animate-float-slow" style="top: 5%; left: 20%; height: 50px; width: 50px;" viewBox="0 0 24 24">
            <path d="M12.1,22 C17.6,22 22,17.6 22,12.1 C22,11.5 21.9,10.9 21.8,10.3 C20.3,11.8 18.2,12.8 15.9,12.8 C11.3,12.8 7.6,9.1 7.6,4.5 C7.6,3 8.1,1.7 8.9,0.6 C4,1.8 0.5,6.3 0.5,11.6 C0.5,17.3 5.2,22 12.1,22 Z" />
        </svg>
    </div>

    <!-- Theme Toggle -->
    <div class="fixed top-4 right-4 z-50">
        <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-white dark:bg-surface-container-lowest text-on-background border-3 border-black dark:border-white rounded-2xl shadow-[4px_4px_0px_0px_#000] dark:shadow-[4px_4px_0px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_#000] dark:hover:shadow-[6px_6px_0px_0px_#fff] active:translate-x-0 active:translate-y-0 transition-all cursor-pointer" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-xl block dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-xl hidden dark:block">light_mode</span>
        </button>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 md:px-8 py-8 pb-16">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8 animate-fade-up">
            <div>
                <h1 class="font-cartoon text-4xl md:text-5xl font-bold text-primary dark:text-primary tracking-tight">Rekap Santri 📊</h1>
                <p class="font-body text-on-surface-variant mt-2 text-sm md:text-base">Laporan kehadiran bulanan seluruh santri pondok.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="cartoon-btn bg-white dark:bg-surface-container-lowest text-on-surface font-cartoon font-bold px-5 py-2.5 flex items-center gap-2 text-sm">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Kembali
            </a>
        </div>

        <!-- Filter Section -->
        <div class="cartoon-card bg-white dark:bg-surface-container-lowest p-5 mb-8 animate-fade-up animate-fade-up-d1">
            <form method="GET" action="{{ route('rekap') }}" class="flex flex-wrap items-end gap-4">
                <div>
                    <label class="font-cartoon font-bold text-xs uppercase tracking-wider text-on-surface-variant mb-1 block">Bulan</label>
                    <select name="month" class="cartoon-btn bg-white dark:bg-surface-container-lowest text-on-surface font-body font-bold px-4 py-2 text-sm min-w-[140px]">
                        @php
                            $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        @endphp
                        @foreach($months as $i => $name)
                            <option value="{{ $i + 1 }}" {{ $month == $i + 1 ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="font-cartoon font-bold text-xs uppercase tracking-wider text-on-surface-variant mb-1 block">Tahun</label>
                    <select name="year" class="cartoon-btn bg-white dark:bg-surface-container-lowest text-on-surface font-body font-bold px-4 py-2 text-sm min-w-[100px]">
                        @for($y = now()->year; $y >= now()->year - 2; $y--)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="cartoon-btn bg-primary-container text-on-primary font-cartoon font-bold px-6 py-2 text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">search</span>
                    Lihat Data
                </button>
            </form>
        </div>

        @php
            $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        @endphp

        <!-- Bar Chart: All Students Attendance -->
        <div class="cartoon-card bg-white dark:bg-surface-container-lowest p-6 mb-8 animate-fade-up animate-fade-up-d2">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-cartoon text-xl md:text-2xl font-bold text-on-surface flex items-center gap-2">
                    <span class="text-2xl">📈</span>
                    Kehadiran Kajian — {{ $monthNames[$month] }} {{ $year }}
                </h2>
                <span class="cartoon-btn bg-secondary-container text-on-secondary-container px-3 py-1 text-xs font-cartoon font-bold">
                    KBM: {{ $totalKBMDays }} Hari
                </span>
            </div>

            @if(count($studentStats) === 0)
                <div class="text-center py-12 text-on-surface-variant">
                    <span class="text-5xl block mb-3">📭</span>
                    <p class="font-cartoon text-lg font-bold">Belum ada data kehadiran.</p>
                </div>
            @else
                <div class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                    @foreach($studentStats as $i => $stat)
                        @php
                            $barColor = $stat['percentage'] >= 75 ? 'bg-emerald-400 dark:bg-emerald-500' : ($stat['percentage'] >= 50 ? 'bg-amber-400 dark:bg-amber-500' : 'bg-red-400 dark:bg-red-500');
                            $delay = min($i * 0.05, 1.5);
                        @endphp
                        <div class="flex items-center gap-3 group" style="animation: fadeInUp 0.4s ease forwards; animation-delay: {{ $delay }}s; opacity: 0;">
                            <div class="w-36 md:w-48 text-xs font-body font-bold text-on-surface truncate shrink-0" title="{{ $stat['name'] }}">
                                {{ $stat['name'] }}
                            </div>
                            <div class="flex-1 bg-surface-container-high dark:bg-surface-container rounded-full h-7 relative overflow-hidden border-2 border-black/10 dark:border-white/10">
                                <div class="bar-animated {{ $barColor }} h-full rounded-full flex items-center justify-end pr-2 transition-all" style="width: {{ $stat['percentage'] }}%; animation-delay: {{ $delay + 0.2 }}s;">
                                    @if($stat['percentage'] > 15)
                                        <span class="text-[10px] font-cartoon font-bold text-white drop-shadow-sm">{{ $stat['hadir'] }}/{{ $stat['kbm'] }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="w-12 text-right font-cartoon font-bold text-sm {{ $stat['percentage'] >= 75 ? 'text-emerald-600 dark:text-emerald-400' : ($stat['percentage'] >= 50 ? 'text-amber-600 dark:text-amber-400' : 'text-red-600 dark:text-red-400') }}">
                                {{ $stat['percentage'] }}%
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Ring Charts: Per Session Type -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @php
                $sessionColors = [
                    'Kajian' => ['stroke' => '#10b981', 'bg' => 'bg-emerald-50 dark:bg-emerald-900/20', 'text' => 'text-emerald-600 dark:text-emerald-400', 'icon' => '📖'],
                    'Subuh' => ['stroke' => '#f59e0b', 'bg' => 'bg-amber-50 dark:bg-amber-900/20', 'text' => 'text-amber-600 dark:text-amber-400', 'icon' => '🌅'],
                    'Tahsin' => ['stroke' => '#6366f1', 'bg' => 'bg-indigo-50 dark:bg-indigo-900/20', 'text' => 'text-indigo-600 dark:text-indigo-400', 'icon' => '📿'],
                ];
            @endphp

            @foreach($sessionStats as $type => $stat)
                @php
                    $color = $sessionColors[$type] ?? ['stroke' => '#64748b', 'bg' => 'bg-gray-50', 'text' => 'text-gray-600', 'icon' => '📋'];
                    $circumference = 2 * 3.14159 * 45;
                    $dashArray = ($stat['percentage'] / 100) * $circumference;
                    $dashOffset = $circumference - $dashArray;
                @endphp
                <div class="cartoon-card {{ $color['bg'] }} bg-white dark:bg-surface-container-lowest p-6 text-center animate-fade-up animate-fade-up-d3">
                    <div class="flex items-center justify-center gap-2 mb-4">
                        <span class="text-2xl">{{ $color['icon'] }}</span>
                        <h3 class="font-cartoon text-lg font-bold text-on-surface">{{ $type }}</h3>
                    </div>

                    <!-- SVG Ring Chart -->
                    <div class="relative inline-block">
                        <svg width="130" height="130" viewBox="0 0 100 100" class="transform -rotate-90">
                            <circle cx="50" cy="50" r="45" fill="none" stroke-width="10" class="stroke-surface-container-high dark:stroke-surface-container" />
                            <circle cx="50" cy="50" r="45" fill="none" stroke-width="10" stroke="{{ $color['stroke'] }}"
                                    stroke-linecap="round"
                                    stroke-dasharray="{{ $dashArray }} {{ $dashOffset }}"
                                    class="ring-chart" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="font-cartoon text-2xl font-bold {{ $color['text'] }}">{{ $stat['percentage'] }}%</span>
                        </div>
                    </div>

                    <div class="mt-3 flex justify-center gap-4 text-xs font-body font-bold text-on-surface-variant">
                        <span>✅ Hadir: {{ $stat['hadir'] }}</span>
                        <span>📊 Total: {{ $stat['total'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Cards -->
        <h2 class="font-cartoon text-2xl font-bold text-on-surface mb-4 animate-fade-up animate-fade-up-d3 flex items-center gap-2">
            <span class="text-2xl">📂</span>
            Lihat Detail Rekap
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Rekap Bulanan -->
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'bulanan']) }}" class="cartoon-nav-card bg-emerald-50 dark:bg-emerald-900/20 p-6 flex flex-col items-center gap-3 text-center animate-fade-up animate-fade-up-d3 no-underline">
                <div class="w-16 h-16 bg-emerald-400 dark:bg-emerald-600 rounded-2xl flex items-center justify-center text-3xl border-3 border-black dark:border-white shadow-[3px_3px_0_0_#000] dark:shadow-[3px_3px_0_0_#fff]">
                    📅
                </div>
                <h3 class="font-cartoon text-lg font-bold text-on-surface">Rekap Bulanan</h3>
                <p class="text-xs font-body text-on-surface-variant">Tabel kehadiran per hari dalam satu bulan.</p>
            </a>

            <!-- Rekap Mingguan -->
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'mingguan']) }}" class="cartoon-nav-card bg-amber-50 dark:bg-amber-900/20 p-6 flex flex-col items-center gap-3 text-center animate-fade-up animate-fade-up-d3 no-underline">
                <div class="w-16 h-16 bg-amber-400 dark:bg-amber-600 rounded-2xl flex items-center justify-center text-3xl border-3 border-black dark:border-white shadow-[3px_3px_0_0_#000] dark:shadow-[3px_3px_0_0_#fff]">
                    📋
                </div>
                <h3 class="font-cartoon text-lg font-bold text-on-surface">Rekap Mingguan</h3>
                <p class="text-xs font-body text-on-surface-variant">Detail absensi mingguan per hari.</p>
            </a>

            <!-- Rekap Tahunan -->
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'tahunan']) }}" class="cartoon-nav-card bg-indigo-50 dark:bg-indigo-900/20 p-6 flex flex-col items-center gap-3 text-center animate-fade-up animate-fade-up-d4 no-underline">
                <div class="w-16 h-16 bg-indigo-400 dark:bg-indigo-600 rounded-2xl flex items-center justify-center text-3xl border-3 border-black dark:border-white shadow-[3px_3px_0_0_#000] dark:shadow-[3px_3px_0_0_#fff]">
                    📆
                </div>
                <h3 class="font-cartoon text-lg font-bold text-on-surface">Rekap Tahunan</h3>
                <p class="text-xs font-body text-on-surface-variant">Ringkasan kehadiran selama setahun.</p>
            </a>
        </div>
    </div>

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
    </script>
</body>
</html>
