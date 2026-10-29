<!DOCTYPE html>
<html lang="id">
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
                <title>Daaru Hiraa - Pusat Informasi Kajian & Pondok Pesantren</title>
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#003527">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Daaru Hiraa">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
          <style>
        :root {
            --on-tertiary-fixed-variant: #5c4300;
            --inverse-on-surface: #f1f1f1;
            --on-secondary-fixed: #002115;
            --on-primary-fixed: #002117;
            --error-container: #ffdad6;
            --on-tertiary-container: #e0a800;
            --on-secondary-container: #247155;
            --on-error-container: #93000a;
            --tertiary-fixed-dim: #f9bd22;
            --outline-variant: #bfc9c3;
            --outline: #707974;
            --surface-container-high: #e8e8e8;
            --surface-tint: #2b6954;
            --surface-bright: #f9f9f9;
            --primary-fixed-dim: #95d3ba;
            --surface: #f9f9f9;
            --surface-container-lowest: #ffffff;
            --secondary-container: #a6f2cf;
            --on-error: #ffffff;
            --surface-container-highest: #e2e2e2;
            --on-primary: #ffffff;
            --surface-container-low: #f3f3f3;
            --inverse-primary: #95d3ba;
            --surface-variant: #e2e2e2;
            --primary-fixed: #b0f0d6;
            --on-tertiary-fixed: #261a00;
            --on-secondary: #ffffff;
            --on-surface: #1b1b1b;
            --background: #f9f9f9;
            --surface-container: #eeeeee;
            --primary: #003527;
            --on-primary-fixed-variant: #0b513d;
            --tertiary-container: #584000;
            --secondary-fixed: #a6f2cf;
            --primary-container: #064e3b;
            --on-primary-container: #80bea6;
            --on-background: #1b1b1b;
            --secondary: #1b6b4f;
            --error: #ba1a1a;
            --surface-dim: #dadada;
            --inverse-surface: #303030;
            --tertiary: #3c2b00;
            --on-secondary-fixed-variant: #00513a;
            --on-surface-variant: #404944;
            --on-tertiary: #ffffff;
            --tertiary-fixed: #ffdf9f;
            --secondary-fixed-dim: #8bd6b4;
            --neobrutal-shadow-color: 0, 0, 0;
            --neobrutal-border-color: #000000;
        }

        .dark {
            --on-tertiary-fixed-variant: #ffdf9f;
            --inverse-on-surface: #121212;
            --on-secondary-fixed: #a6f2cf;
            --on-primary-fixed: #b0f0d6;
            --error-container: #8c1d18;
            --on-tertiary-container: #ffdf9f;
            --on-secondary-container: #a6f2cf;
            --on-error-container: #f9cbd2;
            --tertiary-fixed-dim: #ffdf9f;
            --outline-variant: #4a5568;
            --outline: #94a3b8;
            --surface-container-high: #2d2d2d;
            --surface-tint: #4ade80;
            --surface-bright: #1e1e1e;
            --primary-fixed-dim: #1b6b4f;
            --surface: #1e1e1e;
            --surface-container-lowest: #1a1a1a;
            --secondary-container: #003527;
            --on-error: #601410;
            --surface-container-highest: #3e3e3e;
            --on-primary: #002117;
            --surface-container-low: #222222;
            --inverse-primary: #003527;
            --surface-variant: #2d2d2d;
            --primary-fixed: #1b6b4f;
            --on-tertiary-fixed: #ffdf9f;
            --on-secondary: #002115;
            --on-surface: #f1f1f1;
            --background: #121212;
            --surface-container: #242424;
            --primary: #4ade80;
            --on-primary-fixed-variant: #b0f0d6;
            --tertiary-container: #ffdf9f;
            --secondary-fixed: #003527;
            --primary-container: #004d38;
            --on-primary-container: #a6f2cf;
            --on-background: #f1f1f1;
            --secondary: #22c55e;
            --error: #f87171;
            --surface-dim: #151515;
            --inverse-surface: #f1f1f1;
            --tertiary: #ffdf9f;
            --on-secondary-fixed-variant: #a6f2cf;
            --on-surface-variant: #cbd5e1;
            --on-tertiary: #261a00;
            --tertiary-fixed: #584000;
            --secondary-fixed-dim: #1b6b4f;
            --neobrutal-shadow-color: 255, 255, 255;
            --neobrutal-border-color: #ffffff;
        }

        .neobrutal-shadow { box-shadow: 6px 6px 0px 0px rgba(var(--neobrutal-shadow-color), 1); }
        .neobrutal-shadow-large { box-shadow: 12px 12px 0px 0px rgba(var(--neobrutal-shadow-color), 1); }
        .neobrutal-btn { transition: all 0.2s; }
        .neobrutal-btn:hover { transform: translate(-2px, -2px); box-shadow: 8px 8px 0px 0px rgba(var(--neobrutal-shadow-color), 1); }
        .neobrutal-btn:active { transform: translate(6px, 6px); box-shadow: 0px 0px 0px 0px rgba(var(--neobrutal-shadow-color), 1); }
        html { scroll-behavior: smooth; }

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
        .dark .shadow-\[12px_12px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 12px 12px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark .shadow-\[8px_8px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 8px 8px 0px 0px rgba(var(--neobrutal-shadow-color), 1) !important;
        }
        .dark .shadow-\[-8px_0_0_0_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: -8px 0 0 0 rgba(var(--neobrutal-shadow-color), 1) !important;
        }
      </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background font-body-md overflow-x-hidden">
<!-- TopAppBar with Hamburger Menu -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 md:px-margin-desktop py-4 bg-surface border-b-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
<div class="flex items-center gap-4">
<a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90">
    <img src="{{ asset($landingPage['hero']['image'] ?? 'images/logo-daar-hira.png') }}" alt="Dar Hara" class="h-12 w-auto"/>
    <span class="font-headline-md text-headline-md font-black text-primary tracking-tighter">Daaru Hiraa</span>
</a>
</div>
<div class="flex items-center gap-3">
    <!-- Theme Toggle -->
    <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer" aria-label="Toggle Theme">
        <span class="material-symbols-outlined text-2xl block dark:hidden">dark_mode</span>
        <span class="material-symbols-outlined text-2xl hidden dark:block">light_mode</span>
    </button>
    <button id="hamburger-toggle" class="flex flex-col items-center justify-center w-12 h-12 bg-secondary text-on-secondary border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all" aria-label="Menu">
        <span class="material-symbols-outlined text-2xl">menu</span>
    </button>
</div>
</header>

<!-- Mobile Drawer Menu -->
<div id="drawer-overlay" class="fixed inset-0 bg-black/60 z-[60] hidden transition-opacity opacity-0"></div>
<aside id="drawer-menu" class="fixed top-0 right-0 h-full w-72 max-w-[80vw] bg-surface z-[70] border-l-3 border-on-background shadow-[-8px_0_0_0_rgba(0,0,0,1)] transform translate-x-full transition-transform duration-300 flex flex-col">
    <div class="p-4 border-b-3 border-on-background flex justify-between items-center bg-primary-container">
        <span class="font-headline-md text-headline-md font-black text-on-primary">Menu</span>
        <button id="drawer-close" class="w-10 h-10 bg-surface text-on-background border-2 border-on-background rounded-lg flex items-center justify-center hover:bg-error-container transition-colors" aria-label="Tutup menu">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        <a href="{{ url('/') }}" class="drawer-link flex items-center gap-4 p-4 bg-secondary-container text-on-secondary-container border-2 border-on-background rounded-xl font-headline-md text-headline-md shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all">
            <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">home</span>
            Home
        </a>
        <a href="#kajian" class="drawer-link flex items-center gap-4 p-4 bg-surface text-on-background border-2 border-on-background rounded-xl font-headline-md text-headline-md shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-surface-container active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all">
            <span class="material-symbols-outlined text-2xl">menu_book</span>
            Kajian
        </a>
        <a href="#pondok" class="drawer-link flex items-center gap-4 p-4 bg-surface text-on-background border-2 border-on-background rounded-xl font-headline-md text-headline-md shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-surface-container active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all">
            <span class="material-symbols-outlined text-2xl">school</span>
            Pondok
        </a>
        <a href="#lokasi" class="drawer-link flex items-center gap-4 p-4 bg-surface text-on-background border-2 border-on-background rounded-xl font-headline-md text-headline-md shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-surface-container active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all">
            <span class="material-symbols-outlined text-2xl">location_on</span>
            Lokasi
        </a>
        <a href="#kontak" class="drawer-link flex items-center gap-4 p-4 bg-surface text-on-background border-2 border-on-background rounded-xl font-headline-md text-headline-md shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-surface-container active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all">
            <span class="material-symbols-outlined text-2xl">mail</span>
            Kontak
        </a>
    </nav>
    <div class="p-4 border-t-3 border-on-background">
        @auth
            <a href="{{ url('/dashboard') }}" class="w-full block text-center bg-secondary text-on-secondary px-6 py-3 border-3 border-on-background font-label-sm text-label-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="w-full block text-center bg-secondary text-on-secondary px-6 py-3 border-3 border-on-background font-label-sm text-label-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all">Login</a>
        @endauth
    </div>
</aside>

<main class="pt-24">
<!-- Hero Section -->
<section class="min-h-screen flex flex-col items-center justify-center px-4 md:px-margin-desktop py-20 relative overflow-hidden">
<div class="absolute top-20 right-10 w-32 h-32 bg-tertiary-fixed-dim border-3 border-on-background -rotate-12 z-0 hidden md:block"></div>
<div class="absolute bottom-20 left-10 w-24 h-24 bg-secondary-container border-3 border-on-background rotate-12 z-0 hidden md:block"></div>
<div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-2 gap-16 items-center z-10">
<div class="flex flex-col items-start gap-8">
<span class="bg-tertiary-fixed text-on-tertiary-fixed font-label-sm text-label-sm px-4 py-2 border-2 border-on-background uppercase tracking-widest">{{ $landingPage['hero']['badge'] }}</span>
<h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary uppercase leading-none">
    {{ $landingPage['hero']['title_1'] }} <br/>
    <span class="bg-secondary-container px-2 border-3 border-on-background inline-block my-2">{{ $landingPage['hero']['title_2'] }}</span> <br/>
    {{ $landingPage['hero']['title_3'] }}
</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl">
    {{ $landingPage['hero']['desc'] }}
</p>
<div class="flex flex-wrap gap-6">
    <a href="{{ $landingPage['hero']['btn_primary_link'] }}" class="bg-primary text-on-primary font-headline-md text-headline-md px-10 py-5 border-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] active:translate-x-[8px] active:translate-y-[8px] active:shadow-none transition-all block text-center">
        {{ $landingPage['hero']['btn_primary_text'] }}
    </a>
    <a href="{{ $landingPage['hero']['btn_secondary_link'] }}" class="bg-white text-on-background font-headline-md text-headline-md px-10 py-5 border-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] active:translate-x-[8px] active:translate-y-[8px] active:shadow-none transition-all flex items-center gap-2">
        <span class="material-symbols-outlined" data-icon="info">info</span>
        {{ $landingPage['hero']['btn_secondary_text'] }}
    </a>
</div>
</div>
<div class="relative flex justify-center items-center">
<div class="absolute inset-0 bg-primary-fixed-dim rounded-full opacity-20 blur-3xl"></div>
<div class="relative z-10 p-4 bg-surface border-3 border-on-background shadow-[16px_16px_0px_0px_rgba(0,0,0,1)] -rotate-3 hover:rotate-0 transition-transform duration-500">
    <div class="w-72 h-72 md:w-80 md:h-80 border-3 border-on-background bg-white flex items-center justify-center overflow-hidden">
        <img src="{{ asset($landingPage['hero']['image'] ?? 'images/logo-daar-hira.png') }}" alt="Hero Image" class="w-full h-full object-contain p-6"/>
    </div>
</div>
</div>
</div>
</section>

<!-- Jadwal Kajian Section -->
<section id="kajian" class="py-32 px-4 md:px-margin-desktop bg-surface-container-lowest border-t-3 border-on-background">
<div class="max-w-7xl mx-auto">
<div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
<div class="max-w-2xl">
<span class="bg-secondary-container text-on-secondary-container font-label-sm text-label-sm px-4 py-2 border-2 border-on-background uppercase tracking-widest block mb-4 w-fit">{{ $landingPage['kajian']['badge'] }}</span>
<h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary uppercase">{{ $landingPage['kajian']['title_1'] }} <br/>{{ $landingPage['kajian']['title_2'] }}</h2>
</div>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-md">
    {{ $landingPage['kajian']['desc'] }}
</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
@foreach($landingPage['kajian']['items'] ?? [] as $item)
<div class="bg-white p-8 border-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-4px] hover:translate-y-[-4px] hover:shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] transition-all">
<div class="w-16 h-16 {{ $item['bg_class'] }} border-3 border-on-background flex items-center justify-center mb-6">
    <span class="material-symbols-outlined text-4xl {{ $item['text_class'] }}" style="font-variation-settings:'FILL' 1;">{{ $item['icon'] }}</span>
</div>
<h3 class="font-headline-md text-headline-md text-primary mb-2">{{ $item['title'] }}</h3>
<span class="font-label-sm text-label-sm text-secondary mb-4 block">{{ $item['schedule'] }}</span>
<p class="font-body-md text-body-md text-on-surface-variant">
    {!! nl2br(e($item['desc'])) !!}
</p>
</div>
@endforeach
</div>
</div>
</section>

<!-- Pondok Info Section -->
<section id="pondok" class="py-32 px-4 md:px-margin-desktop bg-surface border-t-3 border-on-background">
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-6 md:grid-rows-2 gap-6">
<!-- Pondok Main Info -->
<div class="md:col-span-4 bg-secondary-container p-12 border-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between">
<div>
<span class="bg-primary text-on-primary font-label-sm text-label-sm px-4 py-2 border-2 border-on-background uppercase tracking-widest inline-block mb-4">{{ $landingPage['pondok']['badge'] }}</span>
<h3 class="font-display-lg text-headline-lg text-primary mb-4">{{ $landingPage['pondok']['title'] }}</h3>
<p class="font-body-lg text-body-lg text-on-secondary-container max-w-xl">{{ $landingPage['pondok']['desc'] }}</p>
</div>
<div class="mt-8 grid grid-cols-2 md:grid-cols-3 gap-4">
    <div class="bg-white border-2 border-on-background p-4 text-center">
        <span class="font-display-lg text-2xl text-primary font-bold block">{{ $landingPage['pondok']['stat_1_val'] }}</span>
        <span class="font-label-sm text-label-sm text-on-surface-variant">{{ $landingPage['pondok']['stat_1_lbl'] }}</span>
    </div>
    <div class="bg-white border-2 border-on-background p-4 text-center">
        <span class="font-display-lg text-2xl text-primary font-bold block">{{ $landingPage['pondok']['stat_2_val'] }}</span>
        <span class="font-label-sm text-label-sm text-on-surface-variant">{{ $landingPage['pondok']['stat_2_lbl'] }}</span>
    </div>
    <div class="bg-white border-2 border-on-background p-4 text-center">
        <span class="font-display-lg text-2xl text-primary font-bold block">{{ $landingPage['pondok']['stat_3_val'] }}</span>
        <span class="font-label-sm text-label-sm text-on-surface-variant">{{ $landingPage['pondok']['stat_3_lbl'] }}</span>
    </div>
</div>
</div>
<!-- Visi -->
<div class="md:col-span-2 bg-tertiary-fixed p-8 border-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col items-center justify-center text-center">
<span class="material-symbols-outlined text-7xl mb-4 text-on-tertiary-fixed-variant" data-icon="visibility" style="font-variation-settings:'FILL' 1;">visibility</span>
<h3 class="font-headline-md text-headline-md text-on-tertiary-fixed-variant mb-2">{{ $landingPage['pondok']['visi_title'] }}</h3>
<p class="font-body-md text-body-md text-on-tertiary-fixed-variant">{{ $landingPage['pondok']['visi_desc'] }}</p>
</div>
<!-- Misi -->
<div class="md:col-span-2 bg-primary-fixed-dim p-8 border-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-end">
<span class="material-symbols-outlined text-5xl text-primary mb-4" data-icon="flag" style="font-variation-settings:'FILL' 1;">flag</span>
<h3 class="font-headline-md text-headline-md text-primary mb-2">{{ $landingPage['pondok']['misi_title'] }}</h3>
<p class="font-body-md text-body-md text-primary-fixed-variant">{{ $landingPage['pondok']['misi_desc'] }}</p>
</div>
<!-- Fasilitas -->
<div class="md:col-span-4 bg-white p-8 border-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
<h3 class="font-display-lg text-headline-lg text-primary uppercase mb-6">🏠 Fasilitas Pondok</h3>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach($landingPage['pondok']['facilities'] ?? [] as $facility)
    <div class="flex flex-col items-center gap-2 p-4 bg-surface-container-low border-2 border-on-background">
        <span class="material-symbols-outlined text-4xl text-primary" style="font-variation-settings:'FILL' 1;">{{ $facility['icon'] }}</span>
        <span class="font-label-sm text-label-sm text-center">{{ $facility['label'] }}</span>
    </div>
    @endforeach
</div>
</div>
</div>
</section>

<!-- Lokasi / Maps Section -->
<section id="lokasi" class="py-32 px-4 md:px-margin-desktop bg-primary-container border-t-3 border-on-background">
<div class="max-w-7xl mx-auto">
<div class="text-center mb-16">
<span class="bg-tertiary-fixed-dim text-on-tertiary-fixed font-label-sm text-label-sm px-4 py-2 border-2 border-on-background uppercase tracking-widest inline-block mb-4">{{ $landingPage['lokasi']['badge'] }}</span>
<h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-primary-container uppercase">{{ $landingPage['lokasi']['title'] }}</h2>
<p class="font-body-lg text-body-lg text-primary-fixed-dim max-w-2xl mx-auto mt-4">{{ $landingPage['lokasi']['desc'] }}</p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<!-- Map Embed -->
<div class="lg:col-span-2 border-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] bg-white overflow-hidden">
    <iframe
        src="{{ $landingPage['lokasi']['maps_url'] }}"
        width="100%"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
<!-- Location Info -->
<div class="flex flex-col gap-6">
<div class="bg-white p-8 border-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex-1">
    <span class="material-symbols-outlined text-5xl text-primary mb-4 block" data-icon="location_on" style="font-variation-settings:'FILL' 1;">location_on</span>
    <h3 class="font-headline-md text-headline-md text-primary mb-3">{{ $landingPage['lokasi']['alamat_title'] }}</h3>
    <p class="font-body-md text-body-md text-on-surface-variant mb-4">{{ $landingPage['lokasi']['alamat_text'] }}</p>
    <a href="{{ $landingPage['lokasi']['alamat_link'] }}" target="_blank" class="bg-secondary text-on-secondary px-6 py-3 border-3 border-on-background font-label-sm text-label-sm shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] transition-all inline-flex items-center gap-2">
        <span class="material-symbols-outlined text-lg" data-icon="map">map</span>
        Buka di Google Maps
    </a>
</div>
<div class="bg-tertiary-fixed p-8 border-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
    <span class="material-symbols-outlined text-4xl text-on-tertiary-fixed-variant mb-3 block" data-icon="schedule" style="font-variation-settings:'FILL' 1;">schedule</span>
    <h3 class="font-headline-md text-headline-md text-on-tertiary-fixed-variant mb-2">{{ $landingPage['lokasi']['jam_besuk_title'] }}</h3>
    <p class="font-body-md text-body-md text-on-tertiary-fixed-variant">{!! nl2br(e($landingPage['lokasi']['jam_besuk_text'])) !!}</p>
</div>
</div>
</div>
</div>
</section>

<!-- Kontak Section -->
<section id="kontak" class="py-32 px-4 bg-surface border-t-3 border-on-background">
<div class="max-w-4xl mx-auto text-center flex flex-col items-center gap-12">
<h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary uppercase">{{ $landingPage['kontak']['title'] }}</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">{{ $landingPage['kontak']['desc'] }}</p>
<div class="flex flex-wrap justify-center gap-8 w-full">
<div class="bg-white p-8 border-3 border-on-background shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] max-w-sm text-left flex-1 min-w-[280px]">
    <span class="material-symbols-outlined text-5xl text-primary mb-4 block" data-icon="call" style="font-variation-settings:'FILL' 1;">call</span>
    <h4 class="font-headline-md text-headline-md mb-2">{{ $landingPage['kontak']['wa_title'] }}</h4>
    <p class="font-body-md text-body-md mb-6 text-on-surface-variant">{{ $landingPage['kontak']['wa_desc'] }}</p>
    <a href="{{ $landingPage['kontak']['wa_link'] }}" target="_blank" class="w-full bg-secondary text-on-secondary py-3 border-3 border-on-background font-bold neobrutal-btn block text-center">{{ $landingPage['kontak']['wa_btn'] }}</a>
</div>
<div class="bg-white p-8 border-3 border-on-background shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] max-w-sm text-left flex-1 min-w-[280px]">
    <span class="material-symbols-outlined text-5xl text-secondary mb-4 block" data-icon="mail" style="font-variation-settings:'FILL' 1;">mail</span>
    <h4 class="font-headline-md text-headline-md mb-2">{{ $landingPage['kontak']['email_title'] }}</h4>
    <p class="font-body-md text-body-md mb-6 text-on-surface-variant">{{ $landingPage['kontak']['email_desc'] }}</p>
    <a href="{{ $landingPage['kontak']['email_link'] }}" class="w-full bg-primary text-on-primary py-3 border-3 border-on-background font-bold neobrutal-btn block text-center">{{ $landingPage['kontak']['email_btn'] }}</a>
</div>
</div>
</div>
</section>
</main>

<!-- Footer -->
<footer class="bg-on-background text-white py-20 px-4 md:px-margin-desktop border-t-3 border-on-background">
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-16">
<div class="md:col-span-2">
<span class="font-headline-md text-headline-md font-black text-primary-fixed tracking-tighter block mb-6">Daaru Hiraa</span>
<p class="font-body-md text-body-md text-outline-variant max-w-sm mb-8">
    {{ $landingPage['footer']['desc'] }}
</p>
<div class="flex gap-4">
<a href="{{ $landingPage['footer']['wa'] }}" target="_blank" class="w-12 h-12 border-2 border-outline-variant flex items-center justify-center hover:bg-primary transition-colors cursor-pointer">
    <span class="material-symbols-outlined" data-icon="call">call</span>
</a>
<a href="{{ $landingPage['footer']['email'] }}" class="w-12 h-12 border-2 border-outline-variant flex items-center justify-center hover:bg-primary transition-colors cursor-pointer">
    <span class="material-symbols-outlined" data-icon="mail">mail</span>
</a>
<a href="{{ $landingPage['footer']['maps'] }}" target="_blank" class="w-12 h-12 border-2 border-outline-variant flex items-center justify-center hover:bg-primary transition-colors cursor-pointer">
    <span class="material-symbols-outlined" data-icon="location_on">location_on</span>
</a>
</div>
</div>
<div>
<h4 class="font-headline-md text-headline-md text-primary-fixed mb-6 uppercase">Navigasi</h4>
<ul class="flex flex-col gap-4 font-body-md text-body-md text-outline-variant">
<li><a class="hover:text-white transition-colors" href="#kajian">Jadwal Kajian</a></li>
<li><a class="hover:text-white transition-colors" href="#pondok">Tentang Pondok</a></li>
<li><a class="hover:text-white transition-colors" href="#lokasi">Lokasi</a></li>
<li><a class="hover:text-white transition-colors" href="#kontak">Kontak</a></li>
</ul>
</div>
<div>
<h4 class="font-headline-md text-headline-md text-primary-fixed mb-6 uppercase">Kajian</h4>
<ul class="flex flex-col gap-4 font-body-md text-body-md text-outline-variant">
@foreach(array_slice($landingPage['kajian']['items'] ?? [], 0, 4) as $item)
<li><a class="hover:text-white transition-colors" href="#kajian">{{ $item['title'] }}</a></li>
@endforeach
</ul>
</div>
</div>
<div class="max-w-7xl mx-auto mt-20 pt-8 border-t border-outline-variant flex flex-col md:flex-row justify-between gap-4">
<span class="text-label-sm font-label-sm text-outline-variant">© 2024 Daaru Hiraa. All rights reserved.</span>
<span class="text-label-sm font-label-sm text-outline-variant italic">#IlmuBerkah</span>
</div>
</footer>

<script>
// Drawer Menu Toggle
const hamburgerToggle = document.getElementById('hamburger-toggle');
const drawerOverlay = document.getElementById('drawer-overlay');
const drawerMenu = document.getElementById('drawer-menu');
const drawerClose = document.getElementById('drawer-close');
const drawerLinks = document.querySelectorAll('.drawer-link');

function openDrawer() {
    drawerOverlay.classList.remove('hidden');
    requestAnimationFrame(() => {
        drawerOverlay.classList.add('opacity-100');
        drawerOverlay.classList.remove('opacity-0');
        drawerMenu.classList.remove('translate-x-full');
        drawerMenu.classList.add('translate-x-0');
    });
    document.body.style.overflow = 'hidden';
}

function closeDrawer() {
    drawerOverlay.classList.add('opacity-0');
    drawerOverlay.classList.remove('opacity-100');
    drawerMenu.classList.add('translate-x-full');
    drawerMenu.classList.remove('translate-x-0');
    document.body.style.overflow = '';
    setTimeout(() => {
        drawerOverlay.classList.add('hidden');
    }, 300);
}

hamburgerToggle.addEventListener('click', openDrawer);
drawerClose.addEventListener('click', closeDrawer);
drawerOverlay.addEventListener('click', closeDrawer);

// Close drawer when a link is clicked (smooth scroll to section)
drawerLinks.forEach(link => {
    link.addEventListener('click', () => {
        closeDrawer();
    });
});

// Close drawer with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !drawerMenu.classList.contains('translate-x-full')) {
        closeDrawer();
    }
});

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
