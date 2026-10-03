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
    <title>Rekap Detail Kehadiran - Daaru Hiraa</title>
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
        .bg-detail-animated {
            background: linear-gradient(-45deg, #ecfdf5, #e0f2fe, #fef3c7, #d1fae5);
            background-size: 400% 400%;
            animation: gradient-shift 18s ease infinite;
        }
        .dark .bg-detail-animated {
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
            transform: translate(0, 0);
            box-shadow: 2px 2px 0px 0px #000;
        }
        .dark .neo-btn { border-color: #fff; box-shadow: 4px 4px 0px 0px #fff; }
        .dark .neo-btn:hover { box-shadow: 6px 6px 0px 0px #fff; }
        .dark .neo-btn:active { box-shadow: 2px 2px 0px 0px #fff; }

        /* Neobrutalist Tabs */
        .neo-tab {
            border: 3px solid #000;
            border-radius: 1rem 1rem 0 0;
            border-bottom: none;
            padding: 0.65rem 1.4rem;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dark .neo-tab {
            border-color: #fff;
        }
        .neo-tab.active {
            background-color: #34d399;
            color: #000;
            box-shadow: 0px -4px 0px 0px #000;
        }
        .dark .neo-tab.active {
            background-color: #059669;
            color: #fff;
            box-shadow: 0px -4px 0px 0px #fff;
        }
        .neo-tab:not(.active) {
            background-color: #fff;
            color: #374151;
        }
        .dark .neo-tab:not(.active) {
            background-color: #27272a;
            color: #d4d4d8;
        }
        .neo-tab:not(.active):hover {
            background-color: #f3f4f6;
            transform: translateY(-2px);
        }
        .dark .neo-tab:not(.active):hover {
            background-color: #3f3f46;
        }

        /* Table styles */
        .rekap-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        .rekap-table th, .rekap-table td {
            border: 1.5px solid #000;
            padding: 7px 5px;
            text-align: center;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }
        .dark .rekap-table th, .dark .rekap-table td {
            border-color: #52525b;
        }
        .rekap-table thead th {
            background: #064e3b;
            color: #ffffff;
            position: sticky;
            top: 0;
            z-index: 10;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 12px;
            font-weight: 700;
        }
        .dark .rekap-table thead th {
            background: #065f46;
            color: #ffffff;
        }

        /* Sticky Columns */
        .rekap-table th:first-child,
        .rekap-table td:first-child {
            position: sticky;
            left: 0;
            z-index: 20;
            min-width: 42px;
            max-width: 42px;
            width: 42px;
        }
        .rekap-table th:nth-child(2),
        .rekap-table td:nth-child(2) {
            position: sticky;
            left: 42px;
            z-index: 20;
            min-width: 150px;
            max-width: 150px;
            width: 150px;
            text-align: left;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        @media (max-width: 640px) {
            .rekap-table th, .rekap-table td {
                padding: 5px 3px;
                font-size: 10px;
            }
            .rekap-table th:first-child,
            .rekap-table td:first-child {
                min-width: 30px;
                max-width: 30px;
                width: 30px;
            }
            .rekap-table th:nth-child(2),
            .rekap-table td:nth-child(2) {
                left: 30px;
                min-width: 110px;
                max-width: 110px;
                width: 110px;
                padding-left: 5px !important;
            }
        }
        .rekap-table thead th:first-child,
        .rekap-table thead th:nth-child(2) {
            z-index: 30;
        }
        .rekap-table tbody td:first-child,
        .rekap-table tbody td:nth-child(2) {
            z-index: 10;
        }

        /* Status cell backgrounds */
        .cell-h { background: #6ee7b7; color: #064e3b; font-weight: 800; }
        .cell-i { background: #fde68a; color: #78350f; font-weight: 800; }
        .cell-a { background: #fca5a5; color: #7f1d1d; font-weight: 800; }
        .cell-s { background: #93c5fd; color: #1e3a5f; font-weight: 800; }
        .cell-none { background: #f3f4f6; color: #9ca3af; }

        .dark .cell-h { background: #065f46; color: #6ee7b7; }
        .dark .cell-i { background: #78350f; color: #fde68a; }
        .dark .cell-a { background: #7f1d1d; color: #fca5a5; }
        .dark .cell-s { background: #1e3a5f; color: #93c5fd; }
        .dark .cell-none { background: #27272a; color: #71717a; }

        /* Zebra striping */
        .rekap-table tbody tr:nth-child(odd) td:first-child,
        .rekap-table tbody tr:nth-child(odd) td:nth-child(2) {
            background: #ffffff;
        }
        .dark .rekap-table tbody tr:nth-child(odd) td:first-child,
        .dark .rekap-table tbody tr:nth-child(odd) td:nth-child(2) {
            background: #18181b;
        }

        .rekap-table tbody tr:nth-child(even) td:first-child,
        .rekap-table tbody tr:nth-child(even) td:nth-child(2) {
            background: #f9fafb;
        }
        .dark .rekap-table tbody tr:nth-child(even) td:first-child,
        .dark .rekap-table tbody tr:nth-child(even) td:nth-child(2) {
            background: #27272a;
        }

        /* Summary / Total Column */
        .col-total { background: #a6f2cf !important; color: #064e3b !important; font-weight: 800; }
        .dark .col-total { background: #064e3b !important; color: #a6f2cf !important; }

        .pct-high { background: #6ee7b7 !important; color: #064e3b !important; font-weight: 800; }
        .pct-mid { background: #fde68a !important; color: #78350f !important; font-weight: 800; }
        .pct-low { background: #fca5a5 !important; color: #7f1d1d !important; font-weight: 800; }
        .dark .pct-high { background: #065f46 !important; color: #6ee7b7 !important; }
        .dark .pct-mid { background: #78350f !important; color: #fde68a !important; }
        .dark .pct-low { background: #7f1d1d !important; color: #fca5a5 !important; }

        /* Row Hover Highlight */
        .rekap-table tbody tr {
            transition: all 0.15s ease;
        }
        .rekap-table tbody tr:hover td {
            filter: brightness(0.96);
        }
        .dark .rekap-table tbody tr:hover td {
            filter: brightness(1.1);
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes sparkle {
            0%, 100% { transform: scale(0.6) rotate(0deg); opacity: 0.3; }
            50% { transform: scale(1.1) rotate(45deg); opacity: 0.9; }
        }
        .animate-fade-up {
            opacity: 0;
            animation: fadeInUp 0.45s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        .animate-fade-up-d1 { animation-delay: 0.08s; }
        .animate-fade-up-d2 { animation-delay: 0.16s; }
        .animate-fade-up-d3 { animation-delay: 0.24s; }
        .animate-sparkle-1 { animation: sparkle 4s ease-in-out infinite; }
        .animate-sparkle-2 { animation: sparkle 5s ease-in-out infinite 1.5s; }

        .row-stagger {
            opacity: 0;
            animation: fadeInUp 0.35s ease forwards;
        }

        .dark select, .dark input {
            background-color: #18181b !important;
            color: #f4f4f5 !important;
            border-color: #ffffff !important;
        }

        /* Scrollbar */
        .table-scroll::-webkit-scrollbar { height: 10px; width: 6px; }
        .table-scroll::-webkit-scrollbar-track { background: #e5e7eb; border-radius: 8px; }
        .dark .table-scroll::-webkit-scrollbar-track { background: #27272a; }
        .table-scroll::-webkit-scrollbar-thumb { background: #9ca3af; border-radius: 8px; }
        .dark .table-scroll::-webkit-scrollbar-thumb { background: #52525b; }
        .table-scroll::-webkit-scrollbar-thumb:hover { background: #059669; }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-detail-animated text-on-surface font-body min-h-screen relative selection:bg-emerald-300 selection:text-black">

    <!-- Sparkles -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
        <svg class="absolute text-yellow-400/30 dark:text-yellow-200/25 fill-current animate-sparkle-1" style="top: 8%; right: 10%; height: 20px; width: 20px;" viewBox="0 0 24 24">
            <path d="M12,0 L15,9 L24,12 L15,15 L12,24 L9,15 L0,12 L9,9 Z" />
        </svg>
        <svg class="absolute text-emerald-400/30 dark:text-emerald-300/20 fill-current animate-sparkle-2" style="top: 70%; left: 5%; height: 16px; width: 16px;" viewBox="0 0 24 24">
            <path d="M12,0 L15,9 L24,12 L15,15 L12,24 L9,15 L0,12 L9,9 Z" />
        </svg>
    </div>

    <!-- Theme Toggle -->
    <div class="fixed top-4 right-4 z-50">
        <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-white dark:bg-zinc-800 text-black dark:text-white border-3 border-black dark:border-white rounded-2xl shadow-[4px_4px_0px_0px_#000] dark:shadow-[4px_4px_0px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_#000] dark:hover:shadow-[6px_6px_0px_0px_#fff] active:translate-x-0 active:translate-y-0 transition-all cursor-pointer" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-xl block dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-xl hidden dark:block">light_mode</span>
        </button>
    </div>

    <div class="relative z-10 max-w-[98vw] xl:max-w-7xl mx-auto px-3 sm:px-6 py-6 pb-16">

        @php
            $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        @endphp

        <!-- Top Header & Actions -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 animate-fade-up">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-200 dark:bg-emerald-950 text-emerald-900 dark:text-emerald-300 font-cartoon font-bold text-xs rounded-full border-2 border-black dark:border-white shadow-[2px_2px_0_0_#000] dark:shadow-[2px_2px_0_0_#fff] mb-1.5">
                    <span>📑 TABEL PRESENSI DETAIL</span>
                </div>
                <h1 class="font-cartoon text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight flex items-center gap-2">
                    Rekap Detail {{ $sessionType === 'Tahsin' ? 'Tahsin & Tahfidz' : 'Kajian' }} 📊
                </h1>
                <p class="font-body text-slate-600 dark:text-slate-300 text-xs sm:text-sm mt-0.5">
                    Transkrip kehadiran santri per hari/minggu/bulan dengan fitur ekspor data.
                </p>
            </div>
            <div class="flex flex-wrap gap-2.5 self-stretch sm:self-auto">
                <a href="{{ route('rekap', ['month' => $month, 'year' => $year, 'session_type' => $sessionType]) }}" class="neo-btn bg-white dark:bg-zinc-800 text-slate-900 dark:text-white font-cartoon font-bold px-4 py-2 flex items-center gap-2 text-xs no-underline">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    Kembali
                </a>
                <a href="{{ route('rekap.export.excel', ['month' => $month, 'year' => $year, 'view' => $view, 'date' => $selectedDate ?? '', 'session_type' => $sessionType]) }}" class="neo-btn bg-emerald-400 dark:bg-emerald-600 text-slate-900 dark:text-white font-cartoon font-bold px-4 py-2 flex items-center gap-2 text-xs no-underline">
                    <span class="material-symbols-outlined text-base">table_chart</span>
                    Ekspor Excel
                </a>
                <a href="{{ route('rekap.export.pdf', ['month' => $month, 'year' => $year, 'view' => $view, 'date' => $selectedDate ?? '', 'session_type' => $sessionType]) }}" class="neo-btn bg-rose-400 dark:bg-rose-600 text-slate-900 dark:text-white font-cartoon font-bold px-4 py-2 flex items-center gap-2 text-xs no-underline">
                    <span class="material-symbols-outlined text-base">picture_as_pdf</span>
                    Ekspor PDF
                </a>
            </div>
        </div>


        <!-- Session Switcher: Kajian / Tahsin & Tahfidz -->
        <div class="flex gap-2 mb-4 overflow-x-auto pb-0.5">
            @foreach (['Kajian' => ['📖', 'KAJIAN'], 'Tahsin' => ['🕌', 'TAHSIN & TAHFIDZ']] as $key => [$icon, $label])
                <a href="{{ route(Route::currentRouteName(), array_merge(request()->except('session_type'), ['session_type' => $key])) }}"
                   class="neo-tab {{ $sessionType === $key ? 'active' : '' }}">
                    <span>{{ $icon }}</span>
                    <span>{{ $label }}</span>
                </a>
            @endforeach
        </div>
        <!-- Navigation Tabs -->
        <div class="flex gap-2 mb-0 animate-fade-up animate-fade-up-d1 overflow-x-auto pb-0.5">
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'bulanan', 'session_type' => $sessionType]) }}" class="neo-tab {{ $view === 'bulanan' ? 'active' : '' }}">
                <span>📅</span>
                <span>BULANAN</span>
            </a>
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'mingguan', 'date' => $selectedDate ?? '', 'session_type' => $sessionType]) }}" class="neo-tab {{ $view === 'mingguan' ? 'active' : '' }}">
                <span>📋</span>
                <span>MINGGUAN</span>
            </a>
            <a href="{{ route('rekap.detail', ['month' => $month, 'year' => $year, 'view' => 'tahunan', 'session_type' => $sessionType]) }}" class="neo-tab {{ $view === 'tahunan' ? 'active' : '' }}">
                <span>🌐</span>
                <span>TAHUNAN</span>
            </a>
        </div>

        <!-- Main Content Card Container -->
        <div class="neo-card bg-white dark:bg-zinc-900 p-5 animate-fade-up animate-fade-up-d2" style="border-top-left-radius: 0;">

            <!-- Filter Panel -->
            <div class="mb-5 p-4 bg-slate-100 dark:bg-zinc-800 rounded-xl border-2 border-black dark:border-white">
                <form method="GET" action="{{ route('rekap.detail') }}" class="flex flex-wrap items-end gap-3 sm:gap-4">
                    <input type="hidden" name="view" value="{{ $view }}">
                    <input type="hidden" name="session_type" value="{{ $sessionType }}">
                    <div class="flex items-center gap-2">
                        <span class="font-cartoon font-bold text-xs uppercase tracking-wider text-slate-700 dark:text-slate-300 flex items-center gap-1">
                            <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 text-sm">tune</span>
                            Filter Data:
                        </span>
                    </div>

                    @if($view === 'mingguan')
                        <div>
                            <select name="date" class="neo-btn bg-white dark:bg-zinc-900 text-slate-900 dark:text-white font-body font-bold px-3 py-1.5 text-xs min-w-[160px]">
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
                            <select name="month" class="neo-btn bg-white dark:bg-zinc-900 text-slate-900 dark:text-white font-body font-bold px-3 py-1.5 text-xs min-w-[130px]">
                                @php $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']; @endphp
                                @foreach($months as $i => $name)
                                    <option value="{{ $i + 1 }}" {{ $month == $i + 1 ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select name="year" class="neo-btn bg-white dark:bg-zinc-900 text-slate-900 dark:text-white font-body font-bold px-3 py-1.5 text-xs min-w-[90px]">
                                @for($y = now()->year; $y >= now()->year - 2; $y--)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    @endif

                    <button type="submit" class="neo-btn bg-emerald-400 dark:bg-emerald-600 text-slate-900 dark:text-white font-cartoon font-bold px-5 py-1.5 text-xs">
                        TAMPILKAN
                    </button>
                </form>
            </div>

            <!-- Title & KBM Badge -->
            <div class="text-center mb-5">
                <h2 class="font-cartoon text-xl md:text-2xl font-bold text-slate-900 dark:text-white">
                    @if($view === 'tahunan')
                        REKAPITULASI KEHADIRAN TAHUN {{ $year }}
                    @elseif($view === 'mingguan')
                        REKAPITULASI MINGGUAN ({{ \Carbon\Carbon::parse($startOfWeek)->isoFormat('D MMM') }} - {{ \Carbon\Carbon::parse($endOfWeek)->isoFormat('D MMM Y') }})
                    @else
                        REKAPITULASI BULAN {{ strtoupper($monthNames[$month]) }} {{ $year }}
                    @endif
                </h2>
                @if($view !== 'tahunan')
                    <span class="inline-block mt-2 px-3 py-1 bg-emerald-100 dark:bg-emerald-950 text-emerald-900 dark:text-emerald-300 rounded-full border-2 border-black dark:border-white font-cartoon font-bold text-xs shadow-[2px_2px_0_0_#000] dark:shadow-[2px_2px_0_0_#fff]">
                        KBM Aktif: {{ $totalKBMDays }} Hari
                    </span>
                @endif
            </div>

            <!-- Status Legend Chips -->
            @if($view !== 'tahunan')
                <div class="flex flex-wrap justify-center gap-2.5 mb-5 text-xs font-body font-bold">
                    <span class="flex items-center gap-1.5 px-2.5 py-1 bg-emerald-100 dark:bg-emerald-950 text-emerald-900 dark:text-emerald-200 rounded-lg border border-black/20 dark:border-white/20">
                        <span class="w-4 h-4 rounded cell-h border border-black/30 flex items-center justify-center text-[10px]">✓</span> Hadir
                    </span>
                    <span class="flex items-center gap-1.5 px-2.5 py-1 bg-amber-100 dark:bg-amber-950 text-amber-900 dark:text-amber-200 rounded-lg border border-black/20 dark:border-white/20">
                        <span class="w-4 h-4 rounded cell-i border border-black/30 flex items-center justify-center text-[10px]">I</span> Izin
                    </span>
                    <span class="flex items-center gap-1.5 px-2.5 py-1 bg-rose-100 dark:bg-rose-950 text-rose-900 dark:text-rose-200 rounded-lg border border-black/20 dark:border-white/20">
                        <span class="w-4 h-4 rounded cell-a border border-black/30 flex items-center justify-center text-[10px]">✗</span> Alpha
                    </span>
                    <span class="flex items-center gap-1.5 px-2.5 py-1 bg-sky-100 dark:bg-sky-950 text-sky-900 dark:text-sky-200 rounded-lg border border-black/20 dark:border-white/20">
                        <span class="w-4 h-4 rounded cell-s border border-black/30 flex items-center justify-center text-[10px]">S</span> Sakit
                    </span>
                    <span class="flex items-center gap-1.5 px-2.5 py-1 bg-slate-100 dark:bg-zinc-800 text-slate-600 dark:text-slate-400 rounded-lg border border-black/20 dark:border-white/20">
                        <span class="w-4 h-4 rounded cell-none border border-black/30 flex items-center justify-center text-[10px]">-</span> Belum Input
                    </span>
                </div>
            @endif

            <!-- Weekly Nav Controls -->
            @if($view === 'mingguan')
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mb-6 max-w-md sm:max-w-xl mx-auto">
                    <div class="flex items-center justify-between w-full sm:w-auto gap-2">
                        <a href="{{ route('rekap.detail', ['view' => 'mingguan', 'date' => $prevWeekDate, 'session_type' => $sessionType]) }}" class="neo-btn bg-white dark:bg-zinc-800 text-slate-900 dark:text-white font-cartoon font-bold px-3 py-1.5 flex items-center gap-1 text-xs no-underline">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                            Minggu Lalu
                        </a>
                        <span class="neo-btn bg-amber-300 dark:bg-amber-900 text-amber-950 dark:text-amber-100 px-3 py-1.5 text-xs font-cartoon font-bold text-center flex-1 sm:flex-none min-w-[140px] sm:min-w-[190px]">
                            {{ \Carbon\Carbon::parse($startOfWeek)->isoFormat('D MMM') }} - {{ \Carbon\Carbon::parse($endOfWeek)->isoFormat('D MMM Y') }}
                        </span>
                        <a href="{{ route('rekap.detail', ['view' => 'mingguan', 'date' => $nextWeekDate, 'session_type' => $sessionType]) }}" class="neo-btn bg-white dark:bg-zinc-800 text-slate-900 dark:text-white font-cartoon font-bold px-3 py-1.5 flex items-center gap-1 text-xs no-underline">
                            Minggu Depan
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Mobile Scroll Hint -->
            <div class="flex items-center justify-between text-[11px] font-cartoon font-bold text-slate-500 dark:text-slate-400 mb-2 md:hidden">
                <span class="flex items-center gap-1 bg-emerald-100 dark:bg-emerald-950 text-emerald-900 dark:text-emerald-300 px-2 py-0.5 rounded-md border border-black/20 dark:border-white/20">
                    👈👉 Geser tabel ke samping untuk melihat tanggal
                </span>
            </div>

            <!-- Table Scroll Container -->
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
                                <th class="min-w-[42px]">JML</th>
                                <th class="min-w-[48px]">%</th>
                            </tr>
                        @else
                            <tr>
                                <th>No</th>
                                <th class="text-left pl-3">Nama Santri</th>
                                @if(isset($activeDates))
                                    @foreach($activeDates as $dateInfo)
                                        <th class="min-w-[40px] px-1">
                                            <div class="text-[9px] font-cartoon opacity-80 uppercase">{{ $dateInfo['day_name'] }}</div>
                                            <div class="text-xs">{{ $dateInfo['day'] }}</div>
                                        </th>
                                    @endforeach
                                @else
                                    @for($d = 1; $d <= $daysInMonth; $d++)
                                        <th class="min-w-[32px]">{{ $d }}</th>
                                    @endfor
                                @endif
                                <th class="min-w-[42px]">JML</th>
                                <th class="min-w-[48px]">%</th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @forelse($rows as $i => $row)
                            <tr class="row-stagger" style="animation-delay: {{ min($i * 0.03, 1.2) }}s;">
                                <td class="font-cartoon font-bold">{{ $row['no'] }}</td>
                                <td class="font-body font-bold text-left pl-3 text-slate-900 dark:text-slate-100" title="{{ $row['name'] }}">{{ $row['name'] }}</td>
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
                                    <td class="font-cartoon bg-slate-100 dark:bg-zinc-800 text-slate-800 dark:text-slate-200">{{ $row['total_kbm'] }}</td>
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
                                    @if(isset($activeDates))
                                        @foreach($activeDates as $dateInfo)
                                            @php
                                                $status = $row['statuses'][$dateInfo['day']] ?? null;
                                                $cellClass = 'cell-none';
                                                $display = '-';
                                                if ($status === 'H') { $cellClass = 'cell-h'; $display = '✓'; }
                                                elseif ($status === 'I') { $cellClass = 'cell-i'; $display = 'I'; }
                                                elseif ($status === 'A') { $cellClass = 'cell-a'; $display = '✗'; }
                                                elseif ($status === 'S') { $cellClass = 'cell-s'; $display = 'S'; }
                                            @endphp
                                            <td class="{{ $cellClass }}">{{ $display }}</td>
                                        @endforeach
                                    @else
                                        @for($d = 1; $d <= $daysInMonth; $d++)
                                            @php
                                                $status = $row['statuses'][$d] ?? null;
                                                $cellClass = 'cell-none';
                                                $display = '-';
                                                if ($status === 'H') { $cellClass = 'cell-h'; $display = '✓'; }
                                                elseif ($status === 'I') { $cellClass = 'cell-i'; $display = 'I'; }
                                                elseif ($status === 'A') { $cellClass = 'cell-a'; $display = '✗'; }
                                                elseif ($status === 'S') { $cellClass = 'cell-s'; $display = 'S'; }
                                            @endphp
                                            <td class="{{ $cellClass }}">{{ $display }}</td>
                                        @endfor
                                    @endif
                                    <td class="col-total font-cartoon">{{ $row['total_hadir'] }}</td>
                                    @php
                                        $pctClass = $row['percentage'] >= 75 ? 'pct-high' : ($row['percentage'] >= 50 ? 'pct-mid' : 'pct-low');
                                    @endphp
                                    <td class="col-pct {{ $pctClass }} font-cartoon">{{ $row['percentage'] }}%</td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $view === 'tahunan' ? 17 : ($view === 'mingguan' ? 11 : $daysInMonth + 4) }}" class="py-12 text-center text-slate-500 dark:text-slate-400">
                                    <span class="text-4xl block mb-2">📭</span>
                                    <span class="font-cartoon font-bold">Belum ada data kehadiran.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Summary -->
            @if(count($rows) > 0)
                <div class="mt-4 pt-3 border-t border-slate-200 dark:border-zinc-800 flex flex-wrap gap-4 justify-between items-center text-xs font-body font-bold text-slate-600 dark:text-slate-400">
                    <div>
                        <span>📊 Total Santri Terdata: <strong class="text-slate-900 dark:text-white font-cartoon">{{ count($rows) }} Santri</strong></span>
                        @if($view !== 'tahunan')
                            <span class="mx-2">•</span>
                            <span>📅 Hari KBM: <strong class="text-slate-900 dark:text-white font-cartoon">{{ $totalKBMDays }} Hari</strong></span>
                        @endif
                    </div>
                    @php
                        $avgPct = count($rows) > 0 ? round(collect($rows)->avg('percentage')) : 0;
                    @endphp
                    <div class="flex items-center gap-1.5 bg-slate-100 dark:bg-zinc-800 px-3 py-1 rounded-lg border border-black/10 dark:border-white/10">
                        <span>📈 Rata-rata Kehadiran:</span>
                        <span class="font-cartoon font-extrabold text-sm {{ $avgPct >= 75 ? 'text-emerald-600 dark:text-emerald-400' : ($avgPct >= 50 ? 'text-amber-600 dark:text-amber-400' : 'text-rose-600 dark:text-rose-400') }}">
                            {{ $avgPct }}%
                        </span>
                    </div>
                </div>
            @endif
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
