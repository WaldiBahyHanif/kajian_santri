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
    <title>Kartu Setoran Hafalan - Daaru Hiraa</title>
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
            --surface-container-lowest: #121212;
            --surface-bright: #2d2d2d;
            --outline: #718096;
            --surface-dim: #1a202c;
            --on-tertiary-fixed: #ffdf9f;
            --secondary-fixed: #003527;
            --surface-container-low: #171717;
            --on-error: #690005;
            --error: #ffb4ab;
            --on-surface: #f1f1f1;
            --inverse-surface: #e2e2e2;
            --neobrutal-shadow-color: 255, 255, 255;
            --neobrutal-border-color: #ffffff;
        }
        .neobrutal-shadow {
            box-shadow: 6px 6px 0px 0px rgba(var(--neobrutal-shadow-color), 1);
        }
        .neobrutal-shadow-sm {
            box-shadow: 3px 3px 0px 0px rgba(var(--neobrutal-shadow-color), 1);
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background font-body-md selection:bg-secondary-container selection:text-on-secondary-container overflow-x-hidden">

<!-- TopAppBar -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-6 py-4 bg-surface text-on-background border-b-3 border-on-background shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)]">
    <div class="flex items-center gap-4">
        <span class="text-2xl font-black text-primary tracking-tighter uppercase font-display-lg">Daaru Hiraa</span>
    </div>
    <div class="flex items-center gap-4">
        <a href="{{ route('kalender.index') }}" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] transition-all cursor-pointer text-primary" aria-label="Open Calendar">
            <span class="material-symbols-outlined text-2xl">calendar_month</span>
        </a>
        <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] transition-all cursor-pointer text-on-background" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-2xl block dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-2xl hidden dark:block">light_mode</span>
        </button>
        <button id="hamburger-toggle" class="flex md:hidden flex-col items-center justify-center w-12 h-12 bg-secondary text-on-secondary border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer" aria-label="Menu">
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

<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-[55] hidden opacity-0 transition-opacity duration-300 md:hidden"></div>

<x-sidebar active="setoran.index" />

<main class="pt-24 pb-24 md:pl-72 md:pr-10 px-4">
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Header -->
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary tracking-tight flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl text-primary">menu_book</span>
                    Kartu Setoran Hafalan
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">
                    Rekam jejak Ziyadah, Muroja'ah, dan Tilawah yang telah disimak & disahkan oleh Ustadz Penyimak.
                </p>
            </div>
            <div class="flex items-center gap-2 bg-tertiary-fixed border-2 border-on-background px-4 py-2 rounded-lg neobrutal-shadow-sm shrink-0">
                <span class="material-symbols-outlined text-tertiary">verified</span>
                <span class="font-label-sm text-label-sm text-tertiary font-black">
                    Minggu Ini: {{ $mingguIniCount }} / {{ $targetMingguan }} Setoran
                </span>
            </div>
        </section>

        <!-- Banner Aturan Pondok -->
        <section class="bg-amber-100 dark:bg-amber-950/30 border-3 border-on-background rounded-xl p-4 neobrutal-shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-2xl text-amber-800 dark:text-amber-300 shrink-0 mt-0.5">shield_lock</span>
                <div>
                    <h3 class="font-headline-md text-sm font-black text-on-background">Sistem Simakan Terverifikasi Ustadz</h3>
                    <p class="text-xs font-semibold text-on-surface-variant mt-0.5">
                        Setoran diinput langsung oleh Ustadz Penyimak saat kamu maju menyetor.
                        Syarat minimal saat ini:
                        <strong class="underline">Hafalan Baru (Ziyadah) minimal {{ $config['min_baris_ziyadah'] ?? 2 }} baris</strong> &
                        <strong class="underline">Muroja'ah minimal {{ $config['min_baris_murojaah'] ?? 6 }} baris</strong>.
                    </p>
                </div>
            </div>
            <span class="text-[11px] font-black uppercase bg-white dark:bg-zinc-800 border-2 border-on-background px-3 py-1 rounded-lg shrink-0 self-start sm:self-center">
                1 Halaman = {{ $barisPerHalaman }} Baris
            </span>
        </section>

        <!-- Statistik Capaian Santri -->
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-emerald-200 dark:bg-emerald-900/40 border-3 border-on-background p-5 rounded-xl neobrutal-shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-black uppercase tracking-wider text-emerald-950 dark:text-emerald-200">🌱 Hafalan Baru (Ziyadah)</span>
                    <span class="text-xl">🌱</span>
                </div>
                <p class="text-3xl font-black text-on-background mt-2">{{ number_format($totalBarisZiyadah) }} <span class="text-sm font-bold">Baris</span></p>
                <p class="text-xs font-bold text-emerald-900 dark:text-emerald-300 mt-1">Setara ± {{ $halamanZiyadah }} Halaman Mushaf</p>
            </div>

            <div class="bg-amber-200 dark:bg-amber-900/40 border-3 border-on-background p-5 rounded-xl neobrutal-shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-black uppercase tracking-wider text-amber-950 dark:text-amber-200">🔄 Muroja'ah Hafalan</span>
                    <span class="text-xl">🔄</span>
                </div>
                <p class="text-3xl font-black text-on-background mt-2">{{ number_format($totalBarisMurojaah) }} <span class="text-sm font-bold">Baris</span></p>
                <p class="text-xs font-bold text-amber-900 dark:text-amber-300 mt-1">Setara ± {{ $halamanMurojaah }} Halaman Mushaf</p>
            </div>

            <div class="bg-sky-200 dark:bg-sky-900/40 border-3 border-on-background p-5 rounded-xl neobrutal-shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-black uppercase tracking-wider text-sky-950 dark:text-sky-200">📖 Tilawah & Tahsin</span>
                    <span class="text-xl">📖</span>
                </div>
                <p class="text-3xl font-black text-on-background mt-2">{{ number_format($totalBarisTilawah) }} <span class="text-sm font-bold">Baris</span></p>
                <p class="text-xs font-bold text-sky-900 dark:text-sky-300 mt-1">Setara ± {{ round($totalBarisTilawah / $barisPerHalaman, 1) }} Halaman Mushaf</p>
            </div>
        </section>

        <!-- Filter & Riwayat Kartu Kendali Setoran -->
        <section class="bg-surface border-3 border-on-background rounded-xl p-6 neobrutal-shadow space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b-2 border-on-background pb-4">
                <h2 class="font-headline-md text-lg font-black text-primary flex items-center gap-2">
                    <span class="material-symbols-outlined">history_edu</span>
                    Riwayat Kartu Kendali Setoran
                </h2>

                <form method="GET" action="{{ route('setoran.index') }}" class="flex flex-wrap items-center gap-2">
                    <select name="jenis" onchange="this.form.submit()" class="border-2 border-on-background rounded-lg px-3 py-1.5 text-xs font-bold bg-background text-on-background">
                        <option value="">Semua Kategori</option>
                        <option value="ziyadah" @selected($jenisFilter === 'ziyadah')>🌱 Ziyadah (Hafalan Baru)</option>
                        <option value="murojaah" @selected($jenisFilter === 'murojaah')>🔄 Muroja'ah</option>
                        <option value="tilawah" @selected($jenisFilter === 'tilawah')>📖 Tilawah</option>
                    </select>

                    <input type="month" name="bulan" value="{{ $bulanFilter }}" onchange="this.form.submit()"
                           class="border-2 border-on-background rounded-lg px-3 py-1.5 text-xs font-bold bg-background text-on-background"/>

                    @if($jenisFilter || $bulanFilter)
                        <a href="{{ route('setoran.index', ['bulan' => '']) }}" class="text-xs font-black underline px-2 py-1">Semua Waktu</a>
                    @endif
                </form>
            </div>

            @if($setorans->isEmpty())
                <div class="text-center py-12 space-y-2">
                    <span class="material-symbols-outlined text-4xl text-on-surface-variant">menu_book</span>
                    <p class="font-headline-md text-sm font-black text-on-surface-variant">Belum ada catatan setoran pada periode ini.</p>
                    <p class="text-xs text-on-surface-variant">Silakan maju menyetor ke Ustadz Penyimak untuk mencatat progres hafalanmu.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($setorans as $item)
                        @php
                            $badgeStyle = match($item->jenis) {
                                'ziyadah' => 'bg-emerald-200 text-emerald-950',
                                'murojaah' => 'bg-amber-200 text-amber-950',
                                'tilawah' => 'bg-sky-200 text-sky-950',
                                default => 'bg-gray-200 text-black',
                            };
                        @endphp
                        <div class="bg-background border-2 border-on-background rounded-xl p-4 neobrutal-shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="px-2.5 py-0.5 rounded border border-black text-[10px] font-black uppercase {{ $badgeStyle }}">
                                        {{ $item->jenis_label }}
                                    </span>
                                    <span class="text-sm font-black text-on-background">
                                        QS. {{ $item->surah }}
                                        @if($item->ayat_awal)
                                            : Ayat {{ $item->ayat_awal }}{{ $item->ayat_akhir ? '–' . $item->ayat_akhir : '' }}
                                        @endif
                                    </span>
                                    <span class="bg-[#FFDE00] text-black px-2 py-0.5 rounded border border-black text-xs font-black">
                                        {{ $item->jumlah_baris }} Baris
                                    </span>
                                </div>

                                <div class="flex items-center gap-3 text-xs font-bold text-on-surface-variant flex-wrap">
                                    <span>📅 {{ $item->tanggal_setor->translatedFormat('l, d M Y') }}</span>
                                    <span>•</span>
                                    <span class="text-primary font-black">✓ Disahkan: Ust. {{ $item->penyimak_nama }}</span>
                                </div>

                                @if($item->catatan)
                                    <p class="text-xs font-bold text-amber-800 dark:text-amber-300 bg-amber-50 dark:bg-amber-950/40 border border-amber-400 px-2.5 py-1 rounded mt-1 inline-block">
                                        📝 Catatan Ustadz: "{{ $item->catatan }}"
                                    </p>
                                @endif
                            </div>

                            <div class="shrink-0 flex sm:flex-col items-center sm:items-end justify-between border-t sm:border-t-0 pt-2 sm:pt-0 border-outline-variant">
                                <span class="text-[10px] font-bold uppercase text-on-surface-variant">Predikat</span>
                                <span class="font-headline-md text-xs font-black px-3 py-1 rounded-lg border-2 border-on-background {{ $item->predikat === 'Mengulang' ? 'bg-red-200 text-red-950' : 'bg-secondary-container text-on-secondary-container' }}">
                                    {{ $item->predikat }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4">
                    {{ $setorans->links() }}
                </div>
            @endif
        </section>

    </div>
</main>

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

    if (hamburgerToggle) hamburgerToggle.addEventListener('click', openSidebar);
    if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);
</script>
</body>
</html>

