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
    <title>Rekap Detail - Daaru Hiraa</title>
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
        .bg-detail-animated {
            background: linear-gradient(-45deg, #ecfdf5, #e0f2fe, #fef3c7, #d1fae5);
            background-size: 400% 400%;
            animation: gradient-shift 18s ease infinite;
        }
        .dark .bg-detail-animated {
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
            transform: translate(0, 0);
            box-shadow: 4px 4px 0px 0px #000;
        }
        .dark .cartoon-btn { border-color: #fff; box-shadow: 4px 4px 0px 0px #fff; }
        .dark .cartoon-btn:hover { box-shadow: 6px 6px 0px 0px #fff; }
        .dark .cartoon-btn:active { box-shadow: 4px 4px 0px 0px #fff; }

        .cartoon-tab {
            border: 3px solid #000;
            border-radius: 1rem 1rem 0 0;
            border-bottom: none;
            padding: 0.6rem 1.5rem;
            font-weight: 700;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }
        .cartoon-tab.active {
            background-color: var(--primary-container);
            color: var(--on-primary);
        }
        .cartoon-tab:not(.active) {
            background-color: var(--surface-container);
            color: var(--on-surface);
        }
        .cartoon-tab:not(.active):hover {
            background-color: var(--surface-container-high);
        }
        .dark .cartoon-tab { border-color: #fff; }
        .dark .cartoon-tab.active { background-color: var(--primary-container); color: #fff; }
        .dark .cartoon-tab:not(.active) { background-color: var(--surface-container); }

        /* Table styles */
        .rekap-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        .rekap-table th, .rekap-table td {
            border: 2px solid #000;
            padding: 6px 4px;
            text-align: center;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }
        .dark .rekap-table th, .dark .rekap-table td {
            border-color: #4a5568;
        }
        .rekap-table thead th {
            background: var(--primary-container);
            color: var(--on-primary);
            position: sticky;
            top: 0;
            z-index: 10;
            font-family: 'Fredoka', sans-serif;
            font-size: 12px;
        }
        .rekap-table th:first-child,
        .rekap-table td:first-child {
            position: sticky;
            left: 0;
            z-index: 20;
            min-width: 40px;
            max-width: 40px;
            width: 40px;
        }
        .rekap-table th:nth-child(2),
        .rekap-table td:nth-child(2) {
            position: sticky;
            left: 40px;
            z-index: 20;
            min-width: 140px;
            max-width: 140px;
            width: 140px;
            text-align: left;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        /* Mobile optimization: make sticky columns narrower so more date columns fit on mobile */
        @media (max-width: 640px) {
            .rekap-table th, .rekap-table td {
                padding: 5px 2px;
                font-size: 10px;
            }
            .rekap-table th:first-child,
            .rekap-table td:first-child {
                min-width: 28px;
                max-width: 28px;
                width: 28px;
            }
            .rekap-table th:nth-child(2),
            .rekap-table td:nth-child(2) {
                left: 28px;
                min-width: 105px;
                max-width: 105px;
                width: 105px;
                padding-left: 4px !important;
            }
        }
        /* headers should have higher z-index to stay above vertical scrolling */
        .rekap-table thead th:first-child,
        .rekap-table thead th:nth-child(2) {
            z-index: 30;
        }
        .rekap-table tbody td:first-child,
        .rekap-table tbody td:nth-child(2) {
            z-index: 10;
            background: inherit;
        }

        /* Status cells */
        .cell-h { background: #6ee7b7; color: #064e3b; }
        .cell-i { background: #fde68a; color: #78350f; }
        .cell-a { background: #fca5a5; color: #7f1d1d; }
        .cell-s { background: #93c5fd; color: #1e3a5f; }
        .cell-none { background: var(--surface-container-low); color: var(--outline); }

        .dark .cell-h { background: #065f46; color: #6ee7b7; }
        .dark .cell-i { background: #78350f; color: #fde68a; }
        .dark .cell-a { background: #7f1d1d; color: #fca5a5; }
        .dark .cell-s { background: #1e3a5f; color: #93c5fd; }
        .dark .cell-none { background: var(--surface-container); color: var(--outline-variant); }

        /* Zebra stripes */
        .rekap-table tbody tr:nth-child(even) td {
            background-color: rgba(0, 0, 0, 0.02);
        }
        .rekap-table tbody tr:nth-child(even) td.cell-h { background: #6ee7b7; }
        .rekap-table tbody tr:nth-child(even) td.cell-i { background: #fde68a; }
        .rekap-table tbody tr:nth-child(even) td.cell-a { background: #fca5a5; }
        .rekap-table tbody tr:nth-child(even) td.cell-s { background: #93c5fd; }
        .rekap-table tbody tr:nth-child(even) td.cell-none { background: var(--surface-container-low); }
        .dark .rekap-table tbody tr:nth-child(even) td { background-color: rgba(255,255,255,0.02); }
        .dark .rekap-table tbody tr:nth-child(even) td.cell-h { background: #065f46; }
        .dark .rekap-table tbody tr:nth-child(even) td.cell-i { background: #78350f; }
        .dark .rekap-table tbody tr:nth-child(even) td.cell-a { background: #7f1d1d; }
        .dark .rekap-table tbody tr:nth-child(even) td.cell-s { background: #1e3a5f; }
        .dark .rekap-table tbody tr:nth-child(even) td.cell-none { background: var(--surface-container); }

        /* Sticky name cell inherits row bg */
        .rekap-table tbody tr:nth-child(odd) td:first-child,
        .rekap-table tbody tr:nth-child(odd) td:nth-child(2) {
            background: var(--surface-container-lowest);
        }
        .rekap-table tbody tr:nth-child(even) td:first-child,
        .rekap-table tbody tr:nth-child(even) td:nth-child(2) {
            background: var(--surface-container-low);
        }

        /* JML & % columns */
        .col-total { background: var(--secondary-container) !important; color: var(--on-secondary-container); font-weight: 800; }
        .col-pct { font-weight: 800; }
        .pct-high { background: #6ee7b7 !important; color: #064e3b; }
        .pct-mid { background: #fde68a !important; color: #78350f; }
        .pct-low { background: #fca5a5 !important; color: #7f1d1d; }
        .dark .pct-high { background: #065f46 !important; color: #6ee7b7; }
        .dark .pct-mid { background: #78350f !important; color: #fde68a; }
        .dark .pct-low { background: #7f1d1d !important; color: #fca5a5; }
        .dark .col-total { background: var(--secondary-container) !important; }

        /* Hover row */
        .rekap-table tbody tr {
            transition: outline 0.15s ease;
        }
        .rekap-table tbody tr:hover {
            outline: 3px solid var(--primary);
            outline-offset: -3px;
            z-index: 2;
            position: relative;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes sparkle {
            0%, 100% { transform: scale(0.6) rotate(0deg); opacity: 0.3; }
            50% { transform: scale(1.1) rotate(45deg); opacity: 0.9; }
        }
        @keyframes drift-right {
            0% { transform: translateX(-15vw); }
            100% { transform: translateX(115vw); }
        }
        .animate-fade-up {
            opacity: 0;
            animation: fadeInUp 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        .animate-fade-up-d1 { animation-delay: 0.1s; }
        .animate-fade-up-d2 { animation-delay: 0.2s; }
        .animate-fade-up-d3 { animation-delay: 0.3s; }
        .animate-sparkle-1 { animation: sparkle 4s ease-in-out infinite; }
        .animate-sparkle-2 { animation: sparkle 5s ease-in-out infinite 1.5s; }
        .animate-drift-slow { animation: drift-right 55s linear infinite; }

        .row-stagger {
            opacity: 0;
            animation: fadeInUp 0.35s ease forwards;
        }

        .dark select, .dark input {
            background-color: var(--surface-container-lowest) !important;
            color: var(--on-surface) !important;
            border-color: var(--outline-variant) !important;
        }

        /* Scrollbar */
        .table-scroll::-webkit-scrollbar { height: 10px; width: 6px; }
        .table-scroll::-webkit-scrollbar-track { background: var(--surface-container); border-radius: 10px; }
        .table-scroll::-webkit-scrollbar-thumb { background: var(--outline); border-radius: 10px; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background: var(--primary); }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-detail-animated text-on-surface font-body min-h-screen relative">

    <!-- Animated Background Canvas -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
        <svg class="absolute text-yellow-300/25 dark:text-yellow-200/30 fill-current animate-sparkle-1" style="top: 8%; right: 10%; height: 20px; width: 20px;" viewBox="0 0 24 24">
            <path d="M12,0 L15,9 L24,12 L15,15 L12,24 L9,15 L0,12 L9,9 Z" />
        </svg>
        <svg class="absolute text-yellow-300/20 dark:text-yellow-200/25 fill-current animate-sparkle-2" style="top: 70%; left: 5%; height: 16px; width: 16px;" viewBox="0 0 24 24">
            <path d="M12,0 L15,9 L24,12 L15,15 L12,24 L9,15 L0,12 L9,9 Z" />
        </svg>
        <svg class="absolute text-white/35 dark:text-slate-700/15 fill-current animate-drift-slow" style="top: 15%; height: 40px; width: 80px;" viewBox="0 0 120 60">
            <path d="M20,40 C20,30 30,25 40,25 C45,15 60,10 75,18 C85,10 100,15 100,30 C110,30 115,38 110,48 C105,55 95,55 90,55 L30,55 C15,55 10,48 20,40 Z"/>
        </svg>
    </div>

    <!-- Theme Toggle -->
    <div class="fixed top-4 right-4 z-50">
        <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-white dark:bg-surface-container-lowest text-on-background border-3 border-black dark:border-white rounded-2xl shadow-[4px_4px_0px_0px_#000] dark:shadow-[4px_4px_0px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_#000] dark:hover:shadow-[6px_6px_0px_0px_#fff] active:translate-x-0 active:translate-y-0 transition-all cursor-pointer" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-xl block dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-xl hidden dark:block">light_mode</span>
        </button>
    </div>

    <div class="relative z-10 max-w-[98vw] xl:max-w-7xl mx-auto px-3 md:px-6 py-6 pb-16">

        @php
            $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        @endphp

        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 animate-fade-up">
            <div>
                <h1 class="font-cartoon text-3xl md:text-4xl font-bold text-primary dark:text-primary tracking-tight">REKAP SANTRI 📊</h1>
                <p class="font-body text-on-surface-variant mt-1 text-sm">Laporan Kehadiran Bulanan & Mingguan</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('rekap', ['month' => $month, 'year' => $year]) }}" class="cartoon-btn bg-white dark:bg-surface-container-lowest text-on-surface font-cartoon font-bold px-4 py-2 flex items-center gap-2 text-sm no-underline">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    KEMBALI
                </a>
                <a href="{{ route('rekap.export.excel', ['month' => $month, 'year' => $year, 'view' => $view, 'date' => $selectedDate ?? '']) }}" class="cartoon-btn bg-emerald-400 dark:bg-emerald-600 text-white font-cartoon font-bold px-4 py-2 flex items-center gap-2 text-sm no-underline">
                    <span class="material-symbols-outlined text-lg">table_chart</span>
                    EXCEL
                </a>
                <a href="{{ route('rekap.export.pdf', ['month' => $month, 'year' => $year, 'view' => $view, 'date' => $selectedDate ?? '']) }}" class="cartoon-btn bg-red-400 dark:bg-red-600 text-white font-cartoon font-bold px-4 py-2 flex items-center gap-2 text-sm no-underline">
                    <span class="material-symbols-outlined text-lg">picture_as_pdf</span>
                    PDF
                </a>
            </div>
        </div>

        <!-- Tabs -->
        <div class="flex gap-0 mb-0 animate-fade-up animate-fade-up-d1">
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'bulanan']) }}" class="cartoon-tab font-cartoon text-sm {{ $view === 'bulanan' ? 'active' : '' }}">
                📅 BULANAN
            </a>
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'mingguan', 'date' => $selectedDate ?? '']) }}" class="cartoon-tab font-cartoon text-sm {{ $view === 'mingguan' ? 'active' : '' }}">
                📋 MINGGUAN
            </a>
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'tahunan']) }}" class="cartoon-tab font-cartoon text-sm {{ $view === 'tahunan' ? 'active' : '' }}">
                🌐 TAHUNAN
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="cartoon-card bg-white dark:bg-surface-container-lowest p-5 animate-fade-up animate-fade-up-d2" style="border-top-left-radius: 0;">

            <!-- Filter -->
            <div class="flex flex-wrap items-end gap-4 mb-5 p-4 bg-surface-container dark:bg-surface-container rounded-xl border-2 border-black/10 dark:border-white/10">
                <form method="GET" action="{{ route('rekap.detail') }}" class="flex flex-wrap items-end gap-4">
                    <input type="hidden" name="view" value="{{ $view }}">
                    <div class="flex items-center gap-2">
                        <span class="font-cartoon font-bold text-sm text-on-surface">FILTER DATA:</span>
                    </div>
                    @if($view === 'mingguan')
                        <div>
                            <select name="date" class="cartoon-btn bg-white dark:bg-surface-container-lowest text-on-surface font-body font-bold px-3 py-1.5 text-xs min-w-[150px]">
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $tempDate = $today->copy()->startOfWeek();
                                @endphp
                                @for($w = 0; $w < 10; $w++)
                                    @php
                                        $wStart = $tempDate->copy()->subWeeks($w);
                                        $wEnd = $wStart->copy()->endOfWeek();
                                        $wVal = $wStart->toDateString();
                                        $label = $wStart->format('d M') . ' - ' . $wEnd->format('d M Y');
                                        $isSelected = (\Carbon\Carbon::parse($selectedDate)->startOfWeek()->toDateString() === $wVal) ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $wVal }}" {{ $isSelected }}>{{ $label }}</option>
                                @endfor
                            </select>
                        </div>
                    @else
                        <div>
                            <select name="month" class="cartoon-btn bg-white dark:bg-surface-container-lowest text-on-surface font-body font-bold px-3 py-1.5 text-xs min-w-[120px]">
                                @php $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; @endphp
                                @foreach($months as $i => $name)
                                    <option value="{{ $i + 1 }}" {{ $month == $i + 1 ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select name="year" class="cartoon-btn bg-white dark:bg-surface-container-lowest text-on-surface font-body font-bold px-3 py-1.5 text-xs min-w-[80px]">
                                @for($y = now()->year; $y >= now()->year - 2; $y--)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    @endif
                    <button type="submit" class="cartoon-btn bg-primary-container text-on-primary font-cartoon font-bold px-5 py-1.5 text-xs">
                        LIHAT DATA
                    </button>
                </form>
            </div>

            <!-- Month/Year Title -->
            <div class="text-center mb-5">
                <h2 class="font-cartoon text-xl md:text-2xl font-bold text-on-surface">
                    @if($view === 'tahunan')
                        REKAPITULASI TAHUN {{ $year }}
                    @elseif($view === 'mingguan')
                        REKAPITULASI MINGGUAN ({{ \Carbon\Carbon::parse($startOfWeek)->isoFormat('D MMM') }} - {{ \Carbon\Carbon::parse($endOfWeek)->isoFormat('D MMM Y') }})
                    @else
                        REKAPITULASI BULAN {{ strtoupper($monthNames[$month]) }} {{ $year }}
                    @endif
                </h2>
                @if($view !== 'tahunan')
                    <span class="inline-block mt-2 cartoon-btn bg-secondary-container text-on-secondary-container px-4 py-1 text-xs font-cartoon font-bold cursor-default" style="box-shadow: 2px 2px 0 0 #000;">
                        KBM: {{ $totalKBMDays }} HARI
                    </span>
                @endif
            </div>

            <!-- Legend -->
            @if($view !== 'tahunan')
                <div class="flex flex-wrap justify-center gap-3 mb-4 text-xs font-body font-bold">
                    <span class="flex items-center gap-1.5"><span class="w-5 h-5 rounded cell-h border border-black/20 dark:border-white/20 flex items-center justify-center text-[10px]">✓</span> Hadir</span>
                    <span class="flex items-center gap-1.5"><span class="w-5 h-5 rounded cell-i border border-black/20 dark:border-white/20 flex items-center justify-center text-[10px]">I</span> Izin</span>
                    <span class="flex items-center gap-1.5"><span class="w-5 h-5 rounded cell-a border border-black/20 dark:border-white/20 flex items-center justify-center text-[10px]">✗</span> Alpha</span>
                    <span class="flex items-center gap-1.5"><span class="w-5 h-5 rounded cell-s border border-black/20 dark:border-white/20 flex items-center justify-center text-[10px]">S</span> Sakit</span>
                    <span class="flex items-center gap-1.5"><span class="w-5 h-5 rounded cell-none border border-black/20 dark:border-white/20 flex items-center justify-center text-[10px]">-</span> Belum</span>
                </div>
            @else
                <div class="text-center mb-4 text-xs font-body font-bold text-on-surface-variant">
                    Menampilkan persentase kehadiran bulanan santri selama satu tahun.
                </div>
            @endif

            <!-- Weekly Navigation -->
            @if($view === 'mingguan')
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mb-6 max-w-md sm:max-w-xl mx-auto">
                    <div class="flex items-center justify-between w-full sm:w-auto gap-2">
                        <a href="{{ route('rekap.detail', ['view' => 'mingguan', 'date' => $prevWeekDate]) }}" class="cartoon-btn bg-white dark:bg-surface-container-lowest text-on-surface font-cartoon font-bold px-3 py-2 flex items-center gap-1 text-xs no-underline">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                            Prev
                        </a>
                        <span class="cartoon-btn bg-secondary-container text-on-secondary-container px-3 py-2 text-xs font-cartoon font-bold text-center flex-1 sm:flex-none min-w-[140px] sm:min-w-[200px]">
                            {{ \Carbon\Carbon::parse($startOfWeek)->isoFormat('D MMM') }} - {{ \Carbon\Carbon::parse($endOfWeek)->isoFormat('D MMM Y') }}
                        </span>
                        <a href="{{ route('rekap.detail', ['view' => 'mingguan', 'date' => $nextWeekDate]) }}" class="cartoon-btn bg-white dark:bg-surface-container-lowest text-on-surface font-cartoon font-bold px-3 py-2 flex items-center gap-1 text-xs no-underline">
                            Next
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Mobile Scroll Hint -->
            <div class="flex items-center justify-between text-[11px] font-cartoon font-bold text-on-surface-variant mb-2 md:hidden">
                <span class="flex items-center gap-1 bg-secondary-container text-on-secondary-container px-2 py-0.5 rounded-md border border-black/20 dark:border-white/20">
                    👈👉 Geser tabel ke kanan untuk melihat tanggal lengkap
                </span>
            </div>

            <!-- Table Container -->
            <div class="table-scroll overflow-auto rounded-xl border-3 border-black dark:border-white max-h-[65vh]">
                <table class="rekap-table">
                    <thead>
                        @if($view === 'tahunan')
                            <tr>
                                <th>No</th>
                                <th class="text-left pl-3">Nama Santri</th>
                                @php $shortMonths = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des']; @endphp
                                @foreach($shortMonths as $mName)
                                    <th class="min-w-[45px]">{{ $mName }}</th>
                                @endforeach
                                <th class="min-w-[50px]">Hadir</th>
                                <th class="min-w-[50px]">KBM</th>
                                <th class="min-w-[55px]">Rata</th>
                            </tr>
                        @elseif($view === 'mingguan')
                            <tr>
                                <th>No</th>
                                <th class="text-left pl-3">Nama Santri</th>
                                @foreach($weekDays as $dayInfo)
                                    <th class="min-w-[70px]">
                                        <div class="font-cartoon text-xs">{{ $dayInfo['day_name'] }}</div>
                                        <div class="text-[9px] font-body opacity-80">{{ $dayInfo['date_formatted'] }}</div>
                                    </th>
                                @endforeach
                                <th class="min-w-[40px]">JML</th>
                                <th class="min-w-[45px]">%</th>
                            </tr>
                        @else
                            <tr>
                                <th>No</th>
                                <th class="text-left pl-3">Nama Santri</th>
                                @for($d = 1; $d <= $daysInMonth; $d++)
                                    <th class="min-w-[32px]">{{ $d }}</th>
                                @endfor
                                <th class="min-w-[40px]">JML</th>
                                <th class="min-w-[45px]">%</th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @forelse($rows as $i => $row)
                            <tr class="row-stagger" style="animation-delay: {{ min($i * 0.03, 1.2) }}s;">
                                <td class="font-cartoon font-bold">{{ $row['no'] }}</td>
                                <td class="font-body font-bold text-left pl-3" title="{{ $row['name'] }}">{{ $row['name'] }}</td>
                                @if($view === 'tahunan')
                                    @for($m = 1; $m <= 12; $m++)
                                        @php
                                            $val = $row['months'][$m];
                                            $cellClass = 'cell-none';
                                            if ($val !== '-') {
                                                $pctVal = (int) $val;
                                                $cellClass = $pctVal >= 75 ? 'pct-high' : ($pctVal >= 50 ? 'pct-mid' : 'pct-low');
                                            }
                                        @endphp
                                        <td class="{{ $cellClass }}">{{ $val }}</td>
                                    @endfor
                                    <td class="col-total font-cartoon">{{ $row['total_hadir'] }}</td>
                                    <td class="font-cartoon bg-slate-100 dark:bg-zinc-800">{{ $row['total_kbm'] }}</td>
                                    @php
                                        $pctClass = $row['percentage'] >= 75 ? 'pct-high' : ($row['percentage'] >= 50 ? 'pct-mid' : 'pct-low');
                                    @endphp
                                    <td class="col-pct {{ $pctClass }} font-cartoon">{{ $row['percentage'] }}%</td>
                                @elseif($view === 'mingguan')
                                    @foreach($weekDays as $dayInfo)
                                        @php
                                            $status = $row['statuses'][$dayInfo['date']];
                                            $cellClass = 'cell-none';
                                            $display = '-';
                                            if ($status === 'H') { $cellClass = 'cell-h'; $display = '✓'; }
                                            elseif ($status === 'I') { $cellClass = 'cell-i'; $display = 'I'; }
                                            elseif ($status === 'A') { $cellClass = 'cell-a'; $display = '✗'; }
                                            elseif ($status === 'S') { $cellClass = 'cell-s'; $display = 'S'; }
                                        @endphp
                                        <td class="{{ $cellClass }}">{{ $display }}</td>
                                    @endforeach
                                    <td class="col-total font-cartoon">{{ $row['total_hadir'] }}</td>
                                    @php
                                        $pctClass = $row['percentage'] >= 75 ? 'pct-high' : ($row['percentage'] >= 50 ? 'pct-mid' : 'pct-low');
                                    @endphp
                                    <td class="col-pct {{ $pctClass }} font-cartoon">{{ $row['percentage'] }}%</td>
                                @else
                                    @for($d = 1; $d <= $daysInMonth; $d++)
                                        @php
                                            $status = $row['statuses'][$d];
                                            $cellClass = 'cell-none';
                                            $display = '-';
                                            if ($status === 'H') { $cellClass = 'cell-h'; $display = '✓'; }
                                            elseif ($status === 'I') { $cellClass = 'cell-i'; $display = 'I'; }
                                            elseif ($status === 'A') { $cellClass = 'cell-a'; $display = '✗'; }
                                            elseif ($status === 'S') { $cellClass = 'cell-s'; $display = 'S'; }
                                        @endphp
                                        <td class="{{ $cellClass }}">{{ $display }}</td>
                                    @endfor
                                    <td class="col-total font-cartoon">{{ $row['total_hadir'] }}</td>
                                    @php
                                        $pctClass = $row['percentage'] >= 75 ? 'pct-high' : ($row['percentage'] >= 50 ? 'pct-mid' : 'pct-low');
                                    @endphp
                                    <td class="col-pct {{ $pctClass }} font-cartoon">{{ $row['percentage'] }}%</td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $view === 'tahunan' ? 17 : ($view === 'mingguan' ? 11 : $daysInMonth + 4) }}" class="py-12 text-center text-on-surface-variant">
                                    <span class="text-4xl block mb-2">📭</span>
                                    <span class="font-cartoon font-bold">Belum ada data kehadiran.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Summary Footer -->
            @if(count($rows) > 0)
                <div class="mt-4 flex flex-wrap gap-3 justify-center text-xs font-body font-bold text-on-surface-variant">
                    <span>📊 Total Santri: {{ count($rows) }}</span>
                    @if($view !== 'tahunan')
                        <span>•</span>
                        <span>📅 Hari KBM: {{ $totalKBMDays }}</span>
                    @endif
                    <span>•</span>
                    @php
                        $avgPct = count($rows) > 0 ? round(collect($rows)->avg('percentage')) : 0;
                    @endphp
                    <span>📈 Rata-rata Kehadiran: <span class="{{ $avgPct >= 75 ? 'text-emerald-600 dark:text-emerald-400' : ($avgPct >= 50 ? 'text-amber-600 dark:text-amber-400' : 'text-red-600 dark:text-red-400') }}">{{ $avgPct }}%</span></span>
                </div>
            @endif
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
