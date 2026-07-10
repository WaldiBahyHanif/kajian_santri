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
    <title>Tasbih Digital - Daaru Hiraa</title>
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

        .arabic {
            font-family: 'Scheherazade New', serif;
            line-height: 2.2;
            font-weight: 500;
            direction: rtl;
        }
        .tab-active {
            background-color: var(--primary) !important;
            color: var(--on-primary) !important;
            border-color: var(--neobrutal-border-color) !important;
        }
        .zikir-card.completed {
            border-color: var(--secondary) !important;
            box-shadow: 8px 8px 0 0 var(--secondary) !important;
            background-color: var(--secondary-container) !important;
            color: var(--on-secondary-container) !important;
        }
        .dark .zikir-card.completed h4 {
            background-color: var(--secondary) !important;
            color: var(--on-secondary) !important;
        }
        .progress-bar { transition: width 0.3s ease-out; }
        .animate-fade-in { animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounce-subtle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        .animate-bounce-subtle { animation: bounce-subtle 2s infinite ease-in-out; }
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
<body class="bg-background text-on-background font-body-md min-h-screen">

<!-- TopAppBar Shell -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 md:px-margin-desktop py-4 bg-surface border-b-3 border-on-background shadow-[6px_6px_0px_0px_#000000]">
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

    <x-sidebar active="zikir" />

<!-- Main Content Canvas -->
<main class="pt-24 pb-24 md:pl-72 md:pr-10 px-4">
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Header Section -->
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary tracking-tight">📿 Zikir & Doa</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">Al-Ma'tsurat dan dzikir harian untuk mendekatkan diri kepada Allah.</p>
            </div>
            <button onclick="resetAllProgress()" class="bg-white text-on-surface border-3 border-on-background px-6 py-3 rounded-lg font-bold neobrutal-shadow-sm neobrutal-shadow-active transition-all flex items-center gap-2">
                <span class="material-symbols-outlined">restart_alt</span>
                Reset Progres
            </button>
        </section>

        <!-- Tabs Section -->
        <div class="flex gap-4 overflow-x-auto pb-2">
            <button onclick="switchTab('pagi')" id="btn-pagi" class="tab-btn shrink-0 bg-white border-3 border-on-background px-6 py-3 rounded-lg font-bold neobrutal-shadow-sm transition-all tab-active hover:translate-x-1 hover:translate-y-1 hover:shadow-none">
                ☀️ Al-Ma'tsurat Pagi
            </button>
            <button onclick="switchTab('petang')" id="btn-petang" class="tab-btn shrink-0 bg-white border-3 border-on-background px-6 py-3 rounded-lg font-bold neobrutal-shadow-sm transition-all hover:translate-x-1 hover:translate-y-1 hover:shadow-none">
                🌙 Al-Ma'tsurat Petang
            </button>
            <button onclick="switchTab('yasin')" id="btn-yasin" class="tab-btn shrink-0 bg-white border-3 border-on-background px-6 py-3 rounded-lg font-bold neobrutal-shadow-sm transition-all hover:translate-x-1 hover:translate-y-1 hover:shadow-none">
                📖 Surah Yasin
            </button>
            <button onclick="switchTab('tahlil')" id="btn-tahlil" class="tab-btn shrink-0 bg-white border-3 border-on-background px-6 py-3 rounded-lg font-bold neobrutal-shadow-sm transition-all hover:translate-x-1 hover:translate-y-1 hover:shadow-none">
                📿 Tahlilan Lengkap (NU Online)
            </button>
        </div>

        <!-- Zikir List Container -->
        <div id="zikir-container" class="space-y-6 md:space-y-0 md:grid md:grid-cols-2 md:gap-6">
            <!-- Content will be injected by JS -->
        </div>

    </div>
</main>

<!-- Digital Tasbih Floating Widget -->
<div class="fixed bottom-24 right-6 md:bottom-8 md:right-24 z-[60]">
    <div id="tasbih-container" class="hidden bg-white border-3 border-on-background p-4 neobrutal-shadow rounded-xl mb-4 w-52 text-center animate-bounce-subtle">
        <p class="font-label-sm text-label-sm text-primary uppercase mb-1">Tasbih Digital</p>
        <h2 id="counter-val" class="text-5xl font-black text-primary mb-3">0</h2>
        <div class="flex gap-2">
            <button onclick="resetGlobalCounter()" class="flex-1 bg-error-container text-on-error-container border-2 border-on-background p-2 rounded-lg font-bold text-xs">Reset</button>
            <button onclick="incrementGlobalCounter()" class="flex-[2] bg-secondary-container text-on-secondary-container border-2 border-on-background p-2 rounded-lg font-bold text-xs">Hitung</button>
        </div>
        <div class="mt-3 pt-2 border-t-2 border-dashed border-outline-variant text-[10px] font-black text-on-surface-variant font-bold">
            Total Dzikir: <span id="total-zikir-accumulated">{{ auth()->user()->total_zikir ?? 0 }}</span>
        </div>
    </div>
    <button onclick="toggleTasbih()" class="w-14 h-14 bg-tertiary-fixed-dim text-on-tertiary-fixed border-3 border-on-background rounded-full neobrutal-shadow flex items-center justify-center hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all ml-auto text-2xl">
        📿
    </button>
</div>

<!-- Floating Action Button (FAB) -->
<a href="{{ route('attendance.scan') }}" class="fixed bottom-24 right-6 md:bottom-8 md:right-8 w-14 h-14 bg-primary text-on-primary border-3 border-on-background rounded-full neobrutal-shadow flex items-center justify-center hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all z-40">
    <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
</a>

<script>
    const zikirData = {
        pagi: [
            {
                title: "1. Ta'awudz & Al-Fatihah",
                arabic: "أَعُوذُ بِاللَّهِ السَّمِيعِ الْعَلِيمِ مِنَ الشَّيْطَانِ الرَّجِيمِ. بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. اَلْحَمْدُ لِلّٰهِ رَبِّ الْعٰلَمِيْنَۙ. الرَّحْمٰنِ الرَّحِيْمِۙ. مٰلِكِ يَوْمِ الدِّيْنِۗ. اِيَّاكَ نَعْبُدُ وَاِيَّاكَ نَسْتَعِيْنُۗ. اِهْدِنَا الصِّرَاطَ الْمُسْتَقِيْمَۙ. صِرَاطَ الَّذِيْنَ اَنْعَمْتَ عَلَيْهِمْ ەۙ غَيْرِ الْمَغْضُوْبِ عَلَيْهِمْ وَلَا الضَّالِّيْنَ۠",
                latin: `A'udzubillaahissami'il 'aliimi minasy-syaithaanir-rajiim. Bismillaahir-rahmaanir-rahiim. Al-hamdu lillaahi rabbil-'aalamiin. Ar-rahmaanir-rahiim. Maaliki yaumid-diin. Iyyaaka na'budu wa iyyaaka nasta'iin. Ihdinas-shiraathal-mustaqiim. Shiraathal-ladziina an'amta 'alaihim ghairil-maghghuubi 'alaihim waladh-dhaalliin.`,
                arti: `Aku berlindung kepada Allah Yang Maha Mendengar lagi Maha Mengetahui dari gangguan setan yang terkutuk. Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Segala puji bagi Allah, Tuhan seluruh alam. Yang Maha Pengasih lagi Maha Penyayang. Pemilik hari pembalasan. Hanya kepada-Mu kami menyembah dan hanya kepada-Mu kami memohon pertolongan. Tunjukkanlah kami jalan yang lurus, (yaitu) jalan orang-orang yang telah Engkau beri nikmat kepadanya; bukan (jalan) mereka yang dimurkai, dan bukan (pula jalan) mereka yang sesat.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "2. QS. Al-Baqarah : 1 – 5",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. الۤمّۤۚ. ذٰلِكَ الْكِتٰبُ لَا رَيْبَ ۛ فِيْهِ ۛ هُدًى لِّلْمُتَّقِيْنَۙ. الَّذِيْنَ يُؤْمِنُوْنَ بِالْغَيْبِ وَيُقِيْمُوْنَ الصَّلٰوةَ وَمِمَّا رَزَقْنٰهُمْ يُنْفِقُوْنَۙ. وَالَّذِيْنَ يُؤْمِنُوْنَ بِمَآ اُنْزِلَ اِلَيْكَ وَمَآ اُنْزِلَ مِنْ قَبْلِكَۚ وَبِالْاٰخِرَةِ هُمْ يُوقِنُوْنَۗ. اُولٰۤىِٕكَ عَلٰى هُدًى مِّنْ رَّبِّهِمْ ۙ وَاُولٰۤىِٕكَ هُمُ الْمُفْلِحُوْنَ",
                latin: `Bismillaahir-rahmaanir-rahiim. Alif-laam-miim. Dzaalikal-kitaabu laa raiba fiihi hudan lil-muttaqiin. Al-ladziina yu'minuuna bil-ghaibi wa yuqiimuunas-shalaata wa mimmaa razaqnaahum yunfiquun. Wal-ladziina yu'minuuna bimaa unzila ilaika wa maa unzila min qablika wa bil-aakhirati hum yuuqinuun. Ulaa'ika 'alaa hudam mir-rabbihim wa ulaa'ika humul-muflihuun.`,
                arti: `Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Alif Lam Mim. Kitab (Al-Qur'an) ini tidak ada keraguan padanya; petunjuk bagi mereka yang bertakwa, (yaitu) mereka yang beriman kepada yang gaib, melaksanakan shalat, dan menginfakkan sebagian rezeki yang Kami berikan kepada mereka, dan mereka yang beriman kepada (Al-Qur'an) yang diturunkan kepamadamu (Muhammad) dan (kitab-kitab) yang diturunkan sebelum engkau, dan mereka yakin akan adanya akhirat. Merekalah yang mendapat petunjuk dari Tuhannya, dan mereka itulah orang-orang yang beruntung.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "3. Ayat Kursi",
                arabic: "اللّٰهُ لَآ اِلٰهَ اِلَّا هُوَ الْحَيُّ الْقَيُّوْمُۚ لَا تَأْخُذُهٗ سِنَةٌ وَلَا نَوْمٌۗ لَهٗ مَا فِى السَّمٰوٰتِ وَمَا فِى الْاَرْضِۗ مَنْ ذَا الَّذِيْ يَشْفَعُ عِنْدَهٗٓ اِلَّا بِاِذْنِهٖۗ يَعْلَمُ مَا بَيْنَ اَيْدِيْهِمْ وَمَا خَلْفَهُمْۚ وَلَا يُحِيْطُوْنَ بِشَيْءٍ مِّنْ عِلْمِهٖٓ اِلَّا بِمَا شَاۤءَۚ وَسِعَ كُرْسِيُّهُ السَّمٰوٰتِ وَالْاَرْضَۚ وَلَا يَـُٔوْدُهٗ حِفْظُهُمَاۚ وَهُوَ الْعَلِيُّ الْعَظِيْمُ",
                latin: `Allaahu laa ilaaha illa huwal-hayyul-qayyuum, laa ta'khudzuhuu sinatuw-wa laa naum, lahuu maa fis-samaawaati wa maa fil-ardh, man dzal-ladzii yasyfa'u 'indahuu illa bi idznih, ya'lamu maa baina aidiihim wa maa khalfahum, wa laa yuhiithuuna bisyai'im-min 'ilmihii illa bimaa syaa', wasi'a kursiyyuhus-samaawaati wal-ardh, wa laa ya'uuduhuu hifdhuhumaa wa huwal-'aliyyul-'adhiim.`,
                arti: `Allah, tidak ada tuhan selain Dia. Yang Maha Hidup, yang terus-menerus mengurus (makhluk-Nya), tidak mengantuk and tidak tidur. Milik-Nya apa yang ada di langit dan apa yang ada di bumi. Tidak ada yang dapat memberi syafaat di sisi-Nya tanpa izin-Nya. Dia mengetahui apa yang ada di hadapan mereka dan apa yang ada di belakang mereka, dan mereka tidak mengetahui sesuatu pun dari ilmu-Nya melainkan apa yang Dia kehendaki. Kursi-Nya meliputi langit dan bumi. Dan Dia tidak merasa berat memelihara keduanya, dan Dia Maha Tinggi lagi Maha Agung.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "4. QS. Al-Baqarah : 284 – 286",
                arabic: "لِّلَّهِ مَا فِى ٱلسَّمَٰوَٰتِ وَمَا فِى ٱلْأَرْضِۗ وَإِن تُbْدُوا۟ مَا فِىٓ أَنفُسِكُمْ أَوْ تُخْfُوهُ يُحَاسِبْكُم بِهِ ٱللَّهُۖ فَيَغْفِرُ لِمَن يَشَآءُ وَyُعَذِّbُ مَن يَشَآءُۗ وَٱللَّهُ عَلَىٰ كُلِّ شَىْءٍ قَدِيرٌ. اٰمَنَ Rَّسُوْلُ بِمَآ اُنْزِلَ اِلَيْهِ مِنْ رَّبِّهٖ وَالْمُؤْمِنُوْنَۗ كُلٌّ اٰمَنَ بِاللّٰهِ وَمَلٰۤىِٕكَتِهٖ وَكُتُبِهٖ وَرُسُلِهٖۗ لَا nُفَرِّقُ بَيْنَ اَحَدٍ مِّنْ رُّسُلِهٖۗ وَقَالُوْا سَمِعْنَا وَاَطَعْنَا غُفْرَانَكَ رَبَّنَا وَاِلَيْكَ الْمَصِيْرُ. لَا يُكَلِّفُ اللّٰه * نَفْسًا اِلَّا وُسْعَهَاۗ لَهَا مَا كَسَبَتْ وَعَلَيْهَا مَا اكْتَسَبَتْۗ رَبَّنَا لَا تُؤَاخِذْنَآ اِنْ نَّسِيْنَآ اَوْ اَخْطَأْنَاۚ رَبَّنَا وَلَا تَحْمِل * عَلَيْنَآ اِصْرًا كَمَا hamaltahuu 'alalladziina min qablinaa, rabbanaa wa laa tuhammilnaa maa laa thaaqata lanaa bih, wa'fu 'annaa, waghfir lanaa, warhamnaa, anta maulaanaa fanshurnaa 'alal-qaumil-kaafiriin.",
                latin: `Lillāhi mā fis-samāwāti wa mā fil-arḍ, wa in tubdụ mā fī anfusikum au tukhfụhu yuḥāsibkum bihillāh, fa yagfiru limay yasyā\`u wa yu'ażżibu may yasyā\`, wallāhu 'alā kulli syai\`ing qadīr. Aamanar-rasuulu bimaa unzila ilaihi mir-rabbihii wal-mu'minuun, kullun aamana billaahi wa malaaikatihii wa kutubihii wa rusulih, laa nufarriqu baina ahadim-mir-rusulih, wa qaaluu sami'naa wa atha'naa ghufraanaka rabbanaa wa ilaikal-mashiir. Laa yukallifullaahu nafsan illaa wus'ahaa, lahaa maa kasabat wa 'alaihaa maktasabat, rabbanaa laa tu'aakhidznaa in-nasiinaa au akhtha'naa, rabbanaa wa laa tahmil 'alainaa ishran kamaa hamaltahuu 'alalladziina min qablinaa, rabbanaa wa laa tuhammilnaa maa laa thaaqata lanaa bih, wa'fu 'annaa, waghfir lanaa, warhamnaa, anta maulaanaa fanshurnaa 'alal-qaumil-kaafiriin.`,
                arti: `Milik Allah-lah apa yang ada di langit dan apa yang ada di bumi. Dan jika kamu nyatakan apa yang ada di dalam hatimu atau kamu sembunyikan... Rasul (Muhammad) beriman kepada apa yang diturunkan kepadanya dari Tuhannya, demikian pula orang-orang yang beriman... Allah tidak membebani seseorang melainkan sesuai dengan kesanggupannya...`,
                target: 1,
                fullWidth: true
            },
            {
                title: "5. QS. Al-Ikhlas",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. قُلْ هُوَ اللّٰهُ اَحَدٌۚ. اَللّٰهُ الصَّمَدُۚ. لَمْ يَلِدْ وَلَمْ يُوْلَدْۙ. وَلَمْ يَكُنْ لَّهٗ كُفُوًا اَحَدٌ",
                latin: `Bismillaahir-rahmaanir-rahiim. Qul huwallaahu ahad. Allaahus-shamad. Lam yalid wa lam yuulad. Wa lam yakul-lahuu kufuwan ahad.`,
                arti: `Katakanlah (Muhammad), 'Dialah Allah, Yang Maha Esa. Allah tempat meminta segala sesuatu. Allah tidak beranak dan tidak pula diperanakkan. Dan tidak ada sesuatu yang setara dengan Dia.'`,
                target: 1
            },
            {
                title: "6. QS. Al-Falaq",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. قُلْ اَعُوْذُ بِرَبِّ الْفَلَقِۙ. مِنْ شَرِّ مَا خَلَقَۙ. وَمِنْ شَرِّ غَاسِقٍ اِذَا وَقَبَۙ. وَمِنْ شَرِّ النَّفّٰثٰتِ فِى الْعُقَدِۙ. وَمِنْ شَرِّ حَاسِدٍ اِذَا حَسَدَ",
                latin: `Bismillaahir-rahmaanir-rahiim. Qul a'uudzu birabbil-falaq. Min syarri maa khalaq. Wa min syarri ghaasiqin idzaa waqab. Wa min syarri-naffaatsaati fil-'uqad. Wa min syarri haasidin idzaa hasad.`,
                arti: `Katakanlah, 'Aku berlindung kepada Tuhan yang menguasai subuh, dari kejahatan (makhluk yang) Dia ciptakan, dan dari kejahatan malam apabila telah gelap gulita, dan dari kejahatan (perempuan-perempuan) penyihir yang meniup pada buhul-buhul (talinya), dan dari kejahatan orang yang dengki apabila dia dengki.'`,
                target: 1
            },
            {
                title: "7. QS. An-Nas",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. قُلْ اَعُوْذُ بِرَبِّ النَّاسِۙ. مَلِكِ النَّاسِۙ. اِلٰهِ النَّاسِۙ. مِنْ شَرِّ الْوَسْوَاسِ ەۙ الْخَنَّاسِۖ. الَّذِيْ يُوَسْوِسُ فِيْ صُدُوْرِ النَّاسِۙ. مِنَ الْجِنَّةِ وَالنَّاسِ",
                latin: `Bismillaahir-rahmaanir-rahiim. Qul a'uudzu birabbin-naas. Malikin-naas. Ilaahin-naas. Min syarril-waswaasil-khannaas. Al-ladzii yuwaswisu fii shuduurin-naas. Minal-jinnati wan-naas.`,
                arti: `Katakanlah, 'Aku berlindung kepada Tuhannya manusia, Raja manusia, Sembahan manusia, dari kejahatan (bisikan) setan yang bersembunyi, yang membisikkan (kejahatan) ke dalam dada manusia, dari (golongan) jin dan manusia.'`,
                target: 1
            },
            {
                title: "8. Dzikir Memasuki Pagi",
                arabic: "أَصْبَحْنَا وَأَصْبَحَ الْمُلْكُ لِلَّهِ وَالْحَمْدُ لِلَّهِ لَا إِلَهَ إِلَّا اللهُ وَحْدَهُ لَا شَرِيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ وَهُوَ عَلَى كُلِّ شَيْءٍ قَدِيرٌ",
                latin: `Ash-bahnaa wa ash-bahal-mulku lillaahi wal-hamdu lillaahi laa ilaaha illallaahu wahdahu laa syariikalahu lahul-mulku wa lahul-hamdu wa huwa 'ala kulli syai'in qadiir.`,
                arti: `Kami berpagi hari dan di pagi ini kekuasaan milik Allah. Segala puji bagi Allah, tiada tuhan selain Allah yang Maha Esa tiada sekutu bagi-Nya. Bagi-Nya kekuasaan dan bagi-Nya segala puji dan Dia Maha Kuasa atas segala sesuatu.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "9. Doa Nikmat & Afiat",
                arabic: "اللَّهُمَّ إِنِّي أَصْبَحْتُ مِنْكَ فِي نِعْمَةٍ وَعَافِيَةٍ وَسِtْرٍ، فَأَتِمَّ عَلَيَّ نِعْمَتَكَ وَعَافِيَتَكَ وَسِتْرَكَ فِي الدُّنْيَا وَالْآخِرَةِ",
                latin: `Allaahumma innii ash-bahtu minka fii ni'matiw-wa 'aafiyatiw-wa sitrin fa-atimm 'alayya ni'mataka wa 'aafiyataka wa sitraka fid-dunyaa wal-aakhirah.`,
                arti: `Ya Allah, sesungguhnya aku berpagi hari dari-Mu dalam kenikmatan, kesehatan, dan perlindungan. Maka sempurnakanlah untukku kenikmatan, kesehatan, dan perlindungan-Mu itu di dunia dan akhirat.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "10. Doa Pengakuan Syukur",
                arabic: "اللَّهُمَّ مَا أَصْبَحَ بِي مِنْ نِعْمَةٍ أَوْ بِأَحَدٍ مِنْ خَلْقِكَ، فَمِنْكَ وَحْدَهُ لَا شَرِيكَ لَكَ، فَلَكَ الْحَمْدُ وَلَكَ الشُّكْرُ",
                latin: `Allaahumma maa ash-baha bii min ni'matin au bi-ahadim-min khalqika faminka wahdaka laa syariikalaka falakal-hamdu walakasy-syukru.`,
                arti: `Ya Allah, nikmat apa pun yang kuterima di pagi ini atau yang diterima oleh salah seorang makhluk-Mu, maka itu semua hanya dari-Mu semata, tiada sekutu bagi-Mu. Bagi-Mu segala puji dan bagi-Mu segala syukur.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "11. Pujian Bagi Allah",
                arabic: "يَا رَبِّ لَكَ الْحَمْدُ كَمَا يَنْبَغِي لِجَلَالِ وَجْهِكَ وَعَظِيمِ سُلْطَانِكَ",
                latin: `Yaa rabbi lakal-hamdu kamaa yambaghii lijalaali wajhika wa 'adhiimi sulthaanik.`,
                arti: `Ya Tuhanku, segala puji bagi-Mu sebagaimana seyogianya bagi kemuliaan wajah-Mu dan keagungan kekuasaan-Mu.`,
                target: 1
            },
            {
                title: "12. Keridhaan Iman",
                arabic: "رَضِيتُ بِاللهِ رَبًّا، وَبِالْإِسْلَامِ دِينًا، وَبِمُحَمَّدٍ نَبِيًّا وَرَسُولًا",
                latin: `Radhiitu billaahi rabbaw-wa bil-islaami diinaw-wa bi-muhammadin nabiyyaw-wa rasuulaa.`,
                arti: `Aku rela Allah sebagai Tuhanku, Islam sebagai agamaku, dan Muhammad sebagai nabi dan rasul-Ku.`,
                target: 1
            },
            {
                title: "13. Tasbih Pujian",
                arabic: "سُبْحَانَ اللهِ وَبِحَمْدِهِ عَدَدَ خَلْقِهِ، وَرِضَا نَفْسِهِ، وَزِنَةَ عَرْشِهِ، وَمِدَادَ كَلِمَاتِهِ",
                latin: `Subhaanallaahi wa bihamdihi 'adada khalqihi wa ridhaa nafsihi wa zinata 'arsyihi wa midaada kalimaatih.`,
                arti: `Maha Suci Allah dan segala puji bagi-Nya, sebanyak bilangan makhluk-Nya, serela diri-Nya, seberat timbangan Arsy-Nya, dan sebanyak tinta kalimat-kalimat-Nya.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "14. Perlindungan Nama Allah",
                arabic: "بِسْمِ اللهِ الَّذِي لَا يَضُرُّ مَعَ اسْمِهِ شَيْءٌ فِي الْأَرْضِ وَلَا فِي السَّمَاءِ وَهُوَ السَّمِيعُ الْعَلِيمُ",
                latin: `Bismillaahilladzii laa yadhurru ma'asmihi syai'un fil-ardhi wa laa fis-samaai wa huwas-samii'ul-'aliim.`,
                arti: `Dengan nama Allah yang bila nama-Nya disebut, segala sesuatu di bumi dan langit tidak akan membahayakan, dan Dia Maha Mendengar lagi Maha Mengetahui.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "15. Perlindungan Dari Syirik",
                arabic: "اللَّهُمَّ إِنَّا نَعُوذُ بِكَ مِنْ أَنْ نُشْرِكَ بِكَ شَيْءًا نَعْلَمُهُ، وَنَسْتَغْفِرُكَ لِمَا لَا نَعْلَمُهُ",
                latin: `Allaahumma innaa na'uudzu bika min an nusyrika bika syai'an na'lamuhu wa nastaghfiruka limaa laa na'lamuh.`,
                arti: `Ya Allah, sesungguhnya kami berlindung kepada-Mu dari menyekutukan-Mu dengan sesuatu yang kami ketahui, dan kami memohon ampun kepada-Mu dari apa yang tidak kami ketahui.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "16. Perlindungan Dari Kejahatan",
                arabic: "أَعُوذُ بِكَلِمَاتِ اللهِ التَّامَّاتِ مِنْ شَرِّ مَا خَلَقَ",
                latin: `A'udzu bikalimaatillaahit-taammaati min syarri maa khalaq.`,
                arti: `Aku berlindung dengan kalimat-kalimat Allah yang sempurna dari kejahatan makhluk yang Dia ciptakan.`,
                target: 1
            },
            {
                title: "17. Perlindungan Dari Kesusahan",
                arabic: "اللَّهُمَّ إِنِّي أَعُوذُ بِكَ مِنَ الْهَمِّ وَالْحَزَنِ، وَأَعُوذُ بِكَ مِنَ الْعَجْزِ وَالْكَسَلِ، وَأَعُوذُ بِكَ مِنَ الْجُبْنِ وَالْبُخْلِ، وَأَعُوذُ بِكَ مِنْ غَلَبَةِ الدَّيْنِ وَقَهْرِ الرِّجَالِ",
                latin: `Allaahumma innii na'uudzu bika minal-hammi wal-hazani wa a'uudzu bika minal-'ajzi wal-kasali wa a'uudzu bika minal-jubni wal-bukhli wa a'uudzu bika min ghalabatid-daini wa qahrir-rijaal.`,
                arti: `Ya Allah, aku berlindung kepada-Mu dari kemurungan dan kesedihan, aku berlindung kepada-Mu dari kemalasan dan kelemahan, aku berlindung kepada-Mu dari sifat pengecut dan kikir, dan aku berlindung kepada-Mu dari lilitan hutang dan kesewenang-wenangan orang lain.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "18. Doa Kesehatan Afiat",
                arabic: "اللَّهُمَّ عَافِنِي فِي بَدَنِي، اللَّهُمَّ عَافِنِي فِي سَمْعِي، اللَّهُمَّ عَافِنِي فِي بَصَرِي",
                latin: `Allaahumma 'aafinii fii badanii, Allaahumma 'aafinii fii sam'ii, Allaahumma 'aafinii fii basharii.`,
                arti: `Ya Allah, sehatkanlah badanku. Ya Allah, sehatkanlah pendengaranku. Ya Allah, sehatkanlah penglihatanku.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "19. Perlindungan Dari Kekufuran",
                arabic: "اللَّهُمَّ إِنِّي أَعُوذُ بِكَ مِنَ الْكُفْرِ وَالْفَقْرِ، وَأَعُوذُ بِكَ مِنْ عَذَابِ الْقَبْرِ، لَا إِلَهَ إِلَّا أَنْتَ",
                latin: `Allaahumma innii a'uudzu bika minal-kufri wal-faqri wa a'uudzu bika min 'adzaabil-qabri laa ilaaha illa Anta.`,
                arti: `Ya Allah, aku berlindung kepada-Mu dari kekufuran dan kefakiran. Ya Allah, aku berlindung kepada-Mu dari azab kubur. Tiada tuhan selain Engkau.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "20. Sayyidul Istighfar",
                arabic: "اللَّهُمَّ أَنْتَ رَبِّي لَا إِلَهَ إِلَّا أَنْتَ، خَلَقْتَنِي وَأَنَا عَبْدُكَ، وَأَنَا عَلَى عَهْدِكَ وَوَعْدِكَ مَا اسْتَطَعْتُ، أَعُوذُ بِكَ مِنْ شَرِّ مَا صَنَعْتُ، أَبُوءُ لَكَ بِنِعْمَتِكَ عَلَيَّ، وَأَبُوءُ بِذَنْبِي فَاغْفِرْ لِي فَإِنَّهُ لَا يَغْفِرُ الذُّنُوبَ إِلَّا أَنْتَ",
                latin: `Allaahumma anta rabbii laa ilaaha illa Anta khalaqtanii wa ana 'abduka wa ana 'alaa 'ahdika wa wa'dika mastatha'tu a'uudzu bika min syarri maa shana'tu abuu'u laka bini'matika 'alayya wa abuu'u bidzambii faghfirlii fainnahu laa yaghfirudz-dzunuuba illaa Anta.`,
                arti: `Ya Allah, Engkau adalah Tuhanku, tiada tuhan selain Engkau. Engkaulah yang menciptakan aku dan aku adalah hamba-Mu. Aku akan setia pada perjanjianku dengan-Mu semampuku. Aku berlindung kepada-Mu dari keburukan yang kuperbuat. Aku mengakui nikmat-Mu kepadaku dan aku mengakui dosaku, maka ampunilah aku. Sesungguhnya tiada yang mengampuni dosa selain Engkau.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "21. Istighfar & Taubat",
                arabic: "أَسْتَغْفِرُ اللهَ وَأَتُوبُ إِلَيْهِ",
                latin: `Astaghfirullaaha wa atuubu ilaih.`,
                arti: `Aku memohon ampun kepada Allah dan aku bertaubat kepada-Nya.`,
                target: 1
            },
            {
                title: "22. Shalawat Nabi",
                arabic: "اللَّهُمَّ صَلِّ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ كَمَا صَلَّيْتَ عَلَى سَيِّدِنَا إِبْرَاهِيمَ وَعَلَى آلِ سَيِّدِنَا إِبْرَاهِيمَ وَبَارِكْ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ كَمَا بَارَكْتَ عَلَى سَيِّدِنَا إِبْرَاهِيمَ وَعَلَى آلِ سَيِّدِنَا إِبْرَاهِيمَ فِي الْعَالَمِينَ إِنَّكَ حَمِيدٌ مَجِيدٌ",
                latin: `Allaahumma shalli 'alaa sayyidinaa muhammadin wa 'alaa aali sayyidinaa muhammadin kamaa shallaita 'alaa sayyidinaa ibraahiima wa 'alaa aali sayyidinaa ibraahiima wa baarik 'alaa sayyidinaa muhammadin wa 'alaa aali sayyidinaa muhammadin kamaa baarakta 'alaa sayyidinaa ibraahiima wa 'alaa aali sayyidinaa ibraahiima fil-'aalamiina innaka hamiidum-majiid.`,
                arti: `Ya Allah, limpahkanlah rahmat kepada junjungan kami Nabi Muhammad beserta keluarganya sebagaimana Engkau limpahkan rahmat kepada Nabi Ibrahim beserta keluarganya, dan berkahilah junjungan kami Nabi Muhammad beserta keluarganya sebagaimana Engkau berkahi Nabi Ibrahim beserta keluarganya, di seluruh alam semesta, sesungguhnya Engkau Maha Terpuji lagi Maha Mulia.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "23. Doa Al-Matsurat (Doa Rabithah)",
                arabic: "اَللَّهُمَّ إِنَّكَ تَعْلَمُ أَنَّ هَذِهِ الْقُلُوبَ قَدِ اجْتَمَعَتْ عَلَى مَحَبَّتِكَ، وَالْتَقَتْ عَلَى طَاعَتِكَ، وَتَوَحَّدَتْ عَلَى دَعْوَتِكَ، وَتَعَاهَدَتْ عَلَى نُصْرَةِ شَرِيعَتِكَ. فَوَثِّقِ اللَّهُمَّ رَابِطَتَهَا، وَأَدِمْ وُدَّهَا، وَاهْدِهَا سُبُلَهَا، وَامْلَأْهَا بِنُورِكَ الَّذِي لَا يَخْبُو، وَاشْرَحْ صُدُورَهَا بِفَيْضِ الْإِيمَانِ بِكَ، وَجَمِيلِ التَّوَكُّلِ عَلَيْكَ، وَأَحْيِهَا بِمَعْرِفَتِكَ، وَأَمِتْهَا عَلَى الشَّهَادَةِ فِي سَبِيلِكَ. إِنَّكَ نِعْمَ الْمَوْلَى وَنِعْمَ النَّصِيرُ. اَللَّهُمَّ أَمِينَ، وَصَلِّ اللَّهُمَّ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِهِ وَصَحْبِهِ وَسَلِّمْ.",
                latin: "Allaahumma innaka ta'lamu anna haadzihil-quluuba qadij-tama'at 'alaa mahabbatik, wal-taqat 'alaa thaa'atik, wa tawahhadat 'alaa da'watik, wa ta'ahadat 'alaa nushrati syarii'atik. Fawats-tsiqillaahumma raabithatahaa, wa adim wuddahaa, wahdihaa subulahaa, wamla'haa binuurikal-ladzii laa yakhbuu, wasyrah shuduurahaa bifaidhil-iimaani bik, wa jamiilit-tawakkuli 'alaik, wa ahyihaa bima'rifatik, wa amithaa 'alasy-syahaadati fii sabiilik. Innaka ni'mal-maulaa wa ni'man-nashiir. Allaahumma aamiin, wa shallillaahumma 'alaa sayyidinaa muhammadiw-wa 'alaa aalihii wa shahbihii wa sallim.",
                arti: "Ya Allah, sesungguhnya Engkau mengetahui bahwa hati-hati ini telah berkumpul atas dasar kecintaan kepada-Mu, bertemu atas dasar ketaatan pada-Mu, bersatu atas dasar dakwah-Mu, dan berjanji setia untuk membela syariat-Mu. Maka kuatkanlah ikatannya, kekalkanlah kasih sayangnya, tunjukkanlah jalannya, dan penuhilah ia dengan cahaya-Mu yang tidak pernah redup. Lapangkanlah dadanya dengan limpahan iman kepada-Mu dan keindahan tawakal kepada-Mu. Hidupkanlah ia dengan ma'rifat-Mu, dan matikanlah ia dalam keadaan syahid di jalan-Mu. Sesungguhnya Engkau adalah sebaik-baik pelindung dan penolong. Ya Allah, kabulkanlah. Dan limpahkanlah rahmat kepada junjungan kami Nabi Muhammad, beserta keluarga dan para sahabatnya.",
                target: 1,
                fullWidth: true
            }
        ],
        petang: [
            {
                title: "1. Ta'awudz & Al-Fatihah",
                arabic: "أَعُوذُ بِاللَّهِ السَّمِيعِ الْعَلِيمِ مِنَ الشَّيْطَانِ الرَّجِيمِ. بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. اَلْحَمْدُ لِلّٰهِ رَبِّ الْعٰلَمِيْنَۙ. الرَّحْمٰنِ الرَّحِيْمِۙ. مٰلِكِ يَوْمِ الدِّيْنِۗ. اِيَّاكَ نَعْبُدُ وَاِيَّاكَ نَسْتَعِيْنُۗ. اِهْدِنَا الصِّرَاطَ الْمُسْتَقِيْمَۙ. صِرَاطَ الَّذِيْنَ اَنْعَمْتَ عَلَيْهِمْ ەۙ غَيْرِ الْمَغْضُوْبِ عَلَيْهِمْ وَلَا الضَّالِّيْنَ۠",
                latin: `A'udzubillaahissami'il 'aliimi minasy-syaithaanir-rajiim. Bismillaahir-rahmaanir-rahiim. Al-hamdu lillaahi rabbil-'aalamiin. Ar-rahmaanir-rahiim. Maaliki yaumid-diin. Iyyaaka na'budu wa iyyaaka nasta'iin. Ihdinas-shiraathal-mustaqiim. Shiraathal-ladziina an'amta 'alaihim ghairil-maghghuubi 'alaihim waladh-dhaalliin.`,
                arti: `Aku berlindung kepada Allah Yang Maha Mendengar lagi Maha Mengetahui dari gangguan setan yang terkutuk. Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Segala puji bagi Allah, Tuhan seluruh alam. Yang Maha Pengasih lagi Maha Penyayang. Pemilik hari pembalasan. Hanya kepada-Mu kami menyembah dan hanya kepada-Mu kami memohon pertolongan. Tunjukkanlah kami jalan yang lurus, (yaitu) jalan orang-orang yang telah Engkau beri nikmat kepadanya; bukan (jalan) mereka yang dimurkai, dan bukan (pula jalan) mereka yang sesat.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "2. QS. Al-Baqarah : 1 – 5",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. الۤمّۤۚ. ذٰلِكَ الْكِتٰبُ لَا رَيْبَ ۛ فِيْهِ ۛ هُدًى لِّلْمُtَّقِيْنَۙ. الَّذِيْنَ يُؤْمِنُوْنَ بِالْغَيْبِ وَيُقِيْمُوْنَ الصَّلٰوةَ وَمِمَّا رَزَقْنٰهُمْ يُنْفِقُوْنَۙ. وَالَّذِيْنَ يُؤْمِنُوْنَ بِمَآ اُنْزِلَ اِلَيْكَ وَمَآ اُنْزِلَ مِنْ قَبْلِكَۚ وَبِالْاٰخِرَةِ هُمْ يُوقِنُوْنَۗ. اُولٰۤىِٕكَ عَلٰى هُدًى مِّنْ رَّبِّهِمْ ۙ وَاُولٰۤىِٕكَ هُمُ الْمُفْلِحُوْنَ",
                latin: `Bismillaahir-rahmaanir-rahiim. Alif-laam-miim. Dzaalikal-kitaabu laa raiba fiihi hudan lil-muttaqiin. Al-ladziina yu'minuuna bil-ghaibi wa yuqiimuunas-shalaata wa mimmaa razaqnaahum yunfiquun. Wal-ladziina yu'minuuna bimaa unzila ilaika wa maa unzila min qablika wa bil-aakhirati hum yuuqinuun. Ulaa'ika 'alaa hudam mir-rabbihim wa ulaa'ika humul-muflihuun.`,
                arti: `Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Alif Lam Mim. Kitab (Al-Qur'an) ini tidak ada keraguan padanya; petunjuk bagi mereka yang bertakwa, (yaitu) mereka yang beriman kepada yang gaib, melaksanakan shalat, dan menginfakkan sebagian rezeki yang Kami berikan kepada mereka, dan mereka yang beriman kepada (Al-Qur'an) yang diturunkan kepamadamu (Muhammad) dan (kitab-kitab) yang diturunkan sebelum engkau, dan mereka yakin akan adanya akhirat. Merekalah yang mendapat petunjuk dari Tuhannya, dan mereka itulah orang-orang yang beruntung.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "3. Ayat Kursi",
                arabic: "اللّٰهُ لَآ اِلٰهَ اِلَّا هُوَ الْحَيُّ الْقَيُّوْمُۚ لَا تَأْخُذُهٗ سِنَةٌ وَلَا نَوْمٌۗ لَهٗ مَا فِى السَّمٰوٰtِ وَمَا فِى الْاَرْضِۗ مَنْ ذَا الَّذِيْ يَشْفَعُ عِنْدَهٗٓ اِلَّا بِاِذْنِهٖۗ يَعْلَمُ مَا بَيْنَ اَيْدِيْهِمْ وَمَا خَلْفَهُمْۚ وَلَا يُحِيْطُوْنَ بِشَيْءٍ مِّن * عِلْمِهٖٓ اِلَّا بِمَا شَاۤءَۚ وَسِعَ كُرْسِيُّهُ السَّمٰوٰتِ وَالْاَرْضَۚ وَلَا يَـُٔوْدُهٗ حِفْظُهُمَاۚ وَهُوَ الْعَلِيُّ الْعَظِيْمُ",
                latin: `Allaahu laa ilaaha illa huwal-hayyul-qayyuum, laa ta'khudzuhuu sinatuw-wa laa naum, lahuu maa fis-samaawaati wa maa fil-ardh, man dzal-ladzii yasyfa'u 'indahuu illa bi idznih, ya'lamu maa baina aidiihim wa maa khalfahum, wa laa yuhiithuuna bisyai'im-min 'ilmihii illa bimaa syaa', wasi'a kursiyyuhus-samaawaati wal-ardh, wa laa ya'uuduhuu hifdhuhumaa wa huwal-'aliyyul-'adhiim.`,
                arti: `Allah, tidak ada tuhan selain Dia. Yang Maha Hidup, yang terus-menerus mengurus (makhluk-Nya), tidak mengantuk dan tidak tidur. Milik-Nya apa yang ada di langit dan apa yang ada di bumi. Tidak ada yang dapat memberi syafaat di sisi-Nya tanpa izin-Nya. Dia mengetahui apa yang ada di hadapan mereka dan apa yang ada di belakang mereka, dan mereka tidak mengetahui sesuatu pun dari ilmu-Nya melainkan apa yang Dia kehendaki. Kursi-Nya meliputi langit dan bumi. Dan Dia tidak merasa berat memelihara keduanya, dan Dia Maha Tinggi lagi Maha Agung.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "4. QS. Al-Baqarah : 284 – 286",
                arabic: "لِّلَّهِ مَا فِى ٱلسَّمَٰوَٰتِ وَمَا فِى ٱلْأَرْضِۗ وَإِن تُبْدُوا۟ مَا فِىٓ أَنفُسِكُمْ أَوْ تُخْفُوهُ يُحَاسِبْكُم بِهِ ٱللَّهُۖ فَيَغْفِرُ لِمَن يَشَآءُ وَيُعَذِّبُ مَن يَشَآءُۗ وَٱللَّهُ عَلَىٰ كُلِّ شَىْءٍ قَدِيرٌ. اٰمَنَ الرَّسُوْلُ بِمَآ اُنْزِلَ اِلَيْهِ مِنْ رَّبِّهٖ وَالْمُؤْنِنُوْنَۗ كُلٌّ اٰمَنَ بِاللّٰهِ وَمَلٰۤىِٕكَتِهٖ وَكُتُبِهٖ وَرُسُلِهٖۗ لَا نُفَرِّقُ بَيْنَ اَحَدٍ مِّنْ رُّسُلِهٖۗ وَقَالُوْا سَمِعْنَا وَاَطَعْنَا غُفْرَانَكَ رَبَّنَا وَاِلَيْكَ الْمَصِيْرُ. لَا يُكَلِّفُ اللّٰه * نَفْسًا اِلَّا وُسْعَهَاۗ لَهَا مَا كَسَبَتْ وَعَلَيْهَا مَا اكْتَسَبَتْۗ رَبَّنَا لَا تُؤَاخِذْنَآ اِنْ نَّسِيْنَآ اَوْ اَخْطَأْنَاۚ رَبَّنَا وَلَا تَحْمِل * عَلَيْنَآ اِصْرًا كَمَا حَمَلْتَهٗ عَلَى الَّذِينَ مِنْ قَبْلِنَاۚ رَبَّنَا وَلَا تُحَمِّلْنَا مَا لَا طَاقَةَ لَنَا بِهٖۚ وَاعْفُ عَنَّاۗ وَاغْفِرْ لَنَاۗ وَارْحَمْنَاۗ اَنْتَ مَوْلٰىنَا فَانْصُرْنَا عَلَى الْقَوْمِ الْكَافِرِيْنَ",
                latin: `Lillāhi mā fis-samāwāti wa mā fil-arḍ, wa in tubdụ mā fī anfusikum au tukhfụhu yuḥāsibkum bihillāh, fa yagfiru limay yasyā\`u wa yu'ażżibu may yasyā\`, wallāhu 'alā kulli syai\`ing qadīr. Aamanar-rasuulu bimaa unzila ilaihi mir-rabbihii wal-mu'minuun, kullun aamana billaahi wa malaaikatihii wa kutubihii wa rusulih, laa nufarriqu baina ahadim-mir-rusulih, wa qaaluu sami'naa wa atha'naa ghufraanaka rabbanaa wa ilaikal-mashiir. Laa yukallifullaahu nafsan illaa wus'ahaa, lahaa maa kesabat wa 'alaihaa maktasabat, rabbanaa laa tu'aakhidznaa in-nasiinaa au akhtha'naa, rabbanaa wa laa tahmil 'alainaa ishran kamaa hamaltahuu 'alalladziina min qablinaa, rabbanaa wa laa tuhammilnaa maa laa thaaqata lanaa bih, wa'fu 'annaa, waghfir lanaa, warhamnaa, anta maulaanaa fanshurnaa 'alal-qaumil-kaafiriin.`,
                arti: `Milik Allah-lah apa yang ada di langit dan apa yang ada di bumi. Dan jika kamu nyatakan apa yang ada di dalam hatimu atau kamu sembunyikan... Rasul (Muhammad) beriman kepada apa yang diturunkan kepadanya dari Tuhannya, demikian pula orang-orang yang beriman... Allah tidak membebani seseorang melainkan sesuai dengan kesanggupannya...`,
                target: 1,
                fullWidth: true
            },
            {
                title: "5. QS. Al-Ikhlas",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. قُلْ هُوَ اللّٰهُ اَحَدٌۚ. اَللّٰهُ الصَّمَدُۚ. لَمْ يَلِدْ وَلَمْ يُوْلَدْۙ. وَلَمْ يَكُنْ لَّهٗ كُفُوًا اَحَدٌ",
                latin: `Bismillaahir-rahmaanir-rahiim. Qul huwallaahu ahad. Allaahus-shamad. Lam yalid wa lam yuulad. Wa lam yakul-lahuu kufuwan ahad.`,
                arti: `Katakanlah (Muhammad), 'Dialah Allah, Yang Maha Esa. Allah tempat meminta segala sesuatu. Allah tidak beranak dan tidak pula diperanakkan. Dan tidak ada sesuatu yang setara dengan Dia.'`,
                target: 1
            },
            {
                title: "6. QS. Al-Falaq",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. قُلْ اَعُوْذُ بِرَبِّ الْفَلَقِۙ. مِنْ شَرِّ مَا خَلَقَۙ. وَمِنْ شَرِّ غَاسِقٍ اِذَا وَقَبَۙ. وَمِنْ شَرِّ النَّفّٰثٰتِ فِى الْعُقَدِۙ. وَمِنْ شَرِّ حَاسِدٍ اِذَا حَسَدَ",
                latin: `Bismillaahir-rahmaanir-rahiim. Qul a'uudzu birabbil-falaq. Min syarri maa khalaq. Wa min syarri ghaasiqin idzaa waqab. Wa min syarri-naffaatsaati fil-'uqad. Wa min syarri haasidin idzaa hasad.`,
                arti: `Katakanlah, 'Aku berlindung kepada Tuhan yang menguasai subuh, dari kejahatan (makhluk yang) Dia ciptakan, dan dari kejahatan malam apabila telah gelap gulita, dan dari kejahatan (perempuan-perempuan) penyihir yang meniup pada buhul-buhul (talinya), dan dari kejahatan orang yang dengki apabila dia dengki.'`,
                target: 1
            },
            {
                title: "7. QS. An-Nas",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. قُلْ اَعُوْذُ بِرَبِّ النَّاسِۙ. مَلِكِ النَّاسِۙ. اِلٰهِ النَّاسِۙ. مِنْ شَرِّ الْوَسْوَاسِ ەۙ الْخَنَّاسِۖ. الَّذِيْ يُوَسْوِسُ فِيْ صُدُوْرِ النَّاسِۙ. مِنَ الْجِنَّةِ وَالنَّاسِ",
                latin: `Bismillaahir-rahmaanir-rahiim. Qul a'uudzu birabbin-naas. Malikin-naas. Ilaahin-naas. Min syarril-waswaasil-khannaas. Al-ladzii yuwaswisu fii shuduurin-naas. Minal-jinnati wan-naas.`,
                arti: `Katakanlah, 'Aku berlindung kepada Tuhannya manusia, Raja manusia, Sembahan manusia, dari kejahatan (bisikan) setan yang bersembunyi, yang membisikkan (kejahatan) ke dalam dada manusia, dari (golongan) jin dan manusia.'`,
                target: 1
            },
            {
                title: "8. Dzikir Memasuki Petang",
                arabic: "أَمْسَيْنَا وَأَمْسَى الْمُلْكُ لِلَّهِ وَالْحَمْدُ لِلَّهِ لَا إِلَهَ إِلَّا اللهُ وَحْدَهُ لَا شَرِيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ وَهُوَ عَلَى كُلِّ شَيْءٍ قَدِيرٌ",
                latin: `Amsainaa wa amsal-mulku lillaahi wal-hamdu lillaahi laa ilaaha illallaahu wahdahu laa syariikalahu lahul-mulku wa lahul-hamdu wa huwa 'ala kulli syai'in qadiir.`,
                arti: `Kami bersore hari dan di sore ini kekuasaan milik Allah. Segala puji bagi Allah, tiada tuhan selain Allah yang Maha Esa tiada sekutu bagi-Nya. Bagi-Nya kekuasaan dan bagi-Nya segala puji dan Dia Maha Kuasa atas segala sesuatu.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "9. Doa Nikmat & Afiat Sore",
                arabic: "اللَّهُمَّ إِنِّي أَمْسَيْتُ مِنْكَ فِي نِعْمَةٍ وَعَافِيَةٍ وَسِتْرٍ، فَأَتِمَّ عَلَيَّ نِعْمَتَكَ وَعَافِيَتَكَ وَسِتْرَكَ فِي الدُّنْيَا وَالْآخِرَةِ",
                latin: `Allaahumma innii amsaitu minka fii ni'matiw-wa 'aafiyatiw-wa sitrin fa-atimm 'alayya ni'mataka wa 'aafiyataka wa sitraka fid-dunyaa wal-aakhirah.`,
                arti: `Ya Allah, sesungguhnya aku bersore hari dari-Mu dalam kenikmatan, kesehatan, dan perlindungan. Maka sempurnakanlah untukku kenikmatan, kesehatan, dan perlindungan-Mu itu di dunia dan akhirat.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "10. Doa Pengakuan Syukur Sore",
                arabic: "اللَّهُمَّ مَا أَمْسَى بِي مِنْ نِعْمَةٍ أَوْ بِأَحَدٍ مِنْ خَلْقِكَ، فَمِنْكَ وَحْدَهُ لَا شَرِيكَ لَكَ، فَلَكَ الْحَمْدُ وَلَكَ الشُّكْرُ",
                latin: `Allaahumma maa amsaa bii min ni'matin au bi-ahadim-min khalqika faminka wahdaka laa syariikalaka falakal-hamdu walakasy-syukru.`,
                arti: `Ya Allah, nikmat apa pun yang kuterima di sore ini atau yang diterima oleh salah seorang makhluk-Mu, maka itu semua hanya dari-Mu semata, tiada sekutu bagi-Mu. Bagi-Mu segala puji dan bagi-Mu segala syukur.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "11. Pujian Bagi Allah",
                arabic: "يَا رَبِّ لَكَ الْحَمْدُ كَمَا يَنْبَغِي لِجَلَالِ وَجْهِكَ وَعَظِيمِ سُلْطَانِكَ",
                latin: `Yaa rabbi lakal-hamdu kamaa yambaghii lijalaali wajhika wa 'adhiimi sulthaanik.`,
                arti: `Ya Tuhanku, segala puji bagi-Mu sebagaimana seyogianya bagi kemuliaan wajah-Mu dan keagungan kekuasaan-Mu.`,
                target: 1
            },
            {
                title: "12. Keridhaan Iman",
                arabic: "رَضِيتُ بِاللهِ رَبًّا، وَبِالْإِسْلَامِ دِينًا، وَبِمُحَمَّدٍ نَبِيًّا وَرَسُولًا",
                latin: `Radhiitu billaahi rabbaw-wa bil-islaami diinaw-wa bi-muhammadin nabiyyaw-wa rasuulaa.`,
                arti: `Aku rela Allah sebagai Tuhanku, Islam sebagai agamaku, dan Muhammad sebagai nabi dan rasul-Ku.`,
                target: 1
            },
            {
                title: "13. Tasbih Pujian",
                arabic: "سُبْحَانَ اللهِ وَبِحَمْدِهِ عَدَدَ خَلْقِهِ، وَرِضَا نَفْسِهِ، وَزِنَةَ عَرْشِهِ، وَمِدَادَ كَلِمَاتِهِ",
                latin: `Subhaanallaahi wa bihamdihi 'adada khalqihi wa ridhaa nafsihi wa zinata 'arsyihi wa midaada kalimaatih.`,
                arti: `Maha Suci Allah dan segala puji bagi-Nya, sebanyak bilangan makhluk-Nya, serela diri-Nya, seberat timbangan Arsy-Nya, dan sebanyak tinta kalimat-kalimat-Nya.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "14. Perlindungan Nama Allah",
                arabic: "بِسْمِ اللهِ الَّذِي لَا يَضُرُّ مَعَ اسْمِهِ شَيْءٌ فِي الْأَرْضِ وَلَا فِي السَّمَاءِ وَهُوَ السَّمِيعُ الْعَلِيمُ",
                latin: `Bismillaahilladzii laa yadhurru ma'asmihi syai'un fil-ardhi wa laa fis-samaai wa huwas-samii'ul-'aliim.`,
                arti: `Dengan nama Allah yang bila nama-Nya disebut, segala sesuatu di bumi dan langit tidak akan membahayakan, dan Dia Maha Mendengar lagi Maha Mengetahui.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "15. Perlindungan Dari Syirik",
                arabic: "اللَّهُمَّ إِنَّا نَعُوذُ بِكَ مِنْ أَنْ نُشْرِكَ بِكَ شَيْءًا نَعْلَمُهُ، وَنَسْتَغْفِرُكَ لِمَا لَا نَعْلَمُهُ",
                latin: `Allaahumma innaa na'uudzu bika min an nusyrika bika syai'an na'lamuhu wa nastaghfiruka limaa laa na'lamuh.`,
                arti: `Ya Allah, sesungguhnya kami berlindung kepada-Mu dari menyekutukan-Mu dengan sesuatu yang kami ketahui, dan kami memohon ampun kepada-Mu dari apa yang tidak kami ketahui.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "16. Perlindungan Dari Kejahatan",
                arabic: "أَعُوذُ بِكَلِمَاتِ اللهِ Tَّامَّاتِ مِنْ شَرِّ مَا خَلَقَ",
                latin: `A'udzu bikalimaatillaahit-taammaati min syarri maa khalaq.`,
                arti: `Aku berlindung dengan kalimat-kalimat Allah yang sempurna dari kejahatan makhluk yang Dia ciptakan.`,
                target: 1
            },
            {
                title: "17. Perlindungan Dari Kesusahan",
                arabic: "اللَّهُمَّ إِنِّي أَعُوذُ بِكَ مِنَ الْهَمِّ وَالْحَزَنِ، وَأَعُوذُ بِكَ مِنَ الْعَجْزِ وَالْكَسَلِ، وَأَعُوذُ بِكَ مِنَ الْجُبْنِ وَالْبُخْلِ، وَأَعُوذُ بِكَ مِنْ غَلَبَةِ الدَّيْنِ وَقَهْرِ الرِّجَالِ",
                latin: `Allaahumma innii na'uudzu bika minal-hammi wal-hazani wa a'uudzu bika minal-'ajzi wal-kasali wa a'uudzu bika minal-jubni wal-bukhli wa a'uudzu bika min ghalabatid-daini wa qahrir-rijaal.`,
                arti: `Ya Allah, aku berlindung kepada-Mu dari kemurungan dan kesedihan, aku berlindung kepada-Mu dari kemalasan dan kelemahan, aku berlindung kepada-Mu dari sifat pengecut dan kikir, dan aku berlindung kepada-Mu dari lilitan hutang dan kesewenang-wenangan orang lain.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "18. Doa Kesehatan Afiat",
                arabic: "اللَّهُمَّ عَافِنِي فِي بَدَنِي، اللَّهُمَّ عَافِنِي فِي سَمْعِي، اللَّهُمَّ عَافِنِي فِي بَصَرِي",
                latin: `Allaahumma 'aafinii fii badanii, Allaahumma 'aafinii fii sam'ii, Allaahumma 'aafinii fii basharii.`,
                arti: `Ya Allah, sehatkanlah badanku. Ya Allah, sehatkanlah pendengaranku. Ya Allah, sehatkanlah penglihatanku.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "19. Perlindungan Dari Kekufuran",
                arabic: "اللَّهُمَّ إِنِّي أَعُوذُ بِكَ مِنَ الْكُفْرِ وَالْفَقْرِ، وَأَعُوذُ بِكَ مِنْ عَذَابِ الْقَبْرِ، لَا إِلَهَ إِلَّا أَنْتَ",
                latin: `Allaahumma innii a'uudzu bika minal-kufri wal-faqri wa a'uudzu bika min 'adzaabil-qabri laa ilaaha illa Anta.`,
                arti: `Ya Allah, aku berlindung kepada-Mu dari kekufuran dan kefakiran. Ya Allah, aku berlindung kepada-Mu dari azab kubur. Tiada tuhan selain Engkau.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "20. Sayyidul Istighfar",
                arabic: "اللَّهُمَّ أَنْتَ رَبِّي لَا إِلَهَ إِلَّا أَنْتَ، خَلَقْتَنِي وَأَنَا عَبْدُكَ، وَأَنَا عَلَى عَهْدِكَ وَوَعْدِكَ مَا اسْتَطَعْتُ، أَعُوذُ بِكَ مِنْ شَرِّ مَا صَنَعْتُ، أَبُوءُ لَكَ بِنِعْمَتِكَ عَلَيَّ، وَأَبُوءُ بِذَنْبِي فَاغْفِرْ لِي فَإِنَّهُ لَا يَغْفِرُ الذُّنُوبَ إِلَّا أَنْتَ",
                latin: `Allaahumma anta rabbii laa ilaaha illa Anta khalaqtanii wa ana 'abduka wa ana 'alaa 'ahdika wa wa'dika mastatha'tu a'uudzu bika min syarri maa shana'tu abuu'u laka bini'matika 'alayya wa abuu'u bidzambii faghfirlii fainnahu laa yaghfirudz-dzunuuba illaa Anta.`,
                arti: `Ya Allah, Engkau adalah Tuhanku, tiada tuhan selain Engkau. Engkaulah yang menciptakan aku dan aku adalah hamba-Mu. Aku akan setia pada perjanjianku dengan-Mu semampuku. Aku berlindung kepada-Mu dari keburukan yang kuperbuat. Aku mengakui nikmat-Mu kepadaku dan aku mengakui dosaku, maka ampunilah aku. Sesungguhnya tiada yang mengampuni dosa selain Engkau.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "21. Istighfar & Taubat",
                arabic: "أَسْتَغْفِرُ اللهَ وَأَتُوبُ إِلَيْهِ",
                latin: `Astaghfirullaaha wa atuubu ilaih.`,
                arti: `Aku memohon ampun kepada Allah dan aku bertaubat kepada-Nya.`,
                target: 1
            },
            {
                title: "22. Shalawat Nabi",
                arabic: "اللَّهُمَّ صَلِّ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ كَمَا صَلَّيْتَ عَلَى سَيِّدِنَا إِبْرَاهِيمَ وَعَلَى آلِ سَيِّدِنَا إِبْرَاهِيمَ وَبَارِكْ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ كَمَا بَارَكْتَ عَلَى سَيِّدِنَا إِبْرَاهِيمَ وَعَلَى آلِ سَيِّدِنَا إِبْرَاهِيمَ فِي الْعَالَمِينَ إِنَّكَ حَمِيدٌ مَجِيدٌ",
                latin: `Allaahumma shalli 'alaa sayyidinaa muhammadin wa 'alaa aali sayyidinaa muhammadin kamaa shallaita 'alaa sayyidinaa ibraahiima wa 'alaa aali sayyidinaa ibraahiima wa baarik 'alaa sayyidinaa muhammadin wa 'alaa aali sayyidinaa muhammadin kamaa baarakta 'alaa sayyidinaa ibraahiima wa 'alaa aali sayyidinaa ibraahiima fil-'aalamiina innaka hamiidum-majiid.`,
                arti: `Ya Allah, limpahkanlah rahmat kepada junjungan kami Nabi Muhammad beserta keluarganya sebagaimana Engkau limpahkan rahmat kepada Nabi Ibrahim beserta keluarganya, dan berkahilah junjungan kami Nabi Muhammad beserta keluarganya sebagaimana Engkau berkahi Nabi Ibrahim beserta keluarganya, di seluruh alam semesta, sesungguhnya Engkau Maha Terpuji lagi Maha Mulia.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "23. Doa Al-Matsurat (Doa Rabithah)",
                arabic: "اَللَّهُمَّ إِنَّكَ تَعْلَمُ أَنَّ هَذِهِ الْقُلُوبَ قَدِ اجْتَمَعَتْ عَلَى مَحَبَّتِكَ، وَالْتَقَتْ عَلَى طَاعَتِكَ، وَتَوَحَّدَتْ عَلَى دَعْوَتِكَ، وَتَعَاهَدَتْ عَلَى نُصْرَةِ شَرِيعَتِكَ. فَوَثِّقِ اللَّهُمَّ رَابِطَتَهَا، وَأَدِمْ وُدَّهَا، وَاهْدِهَا سُبُلَهَا، وَامْلَأْهَا بِنُورِكَ الَّذِي لَا يَخْبُو، وَاشْرَحْ صُدُورَهَا بِفَيْضِ الْإِيمَانِ بِكَ، وَجَمِيلِ Tوَّكُّلِ عَلَيْكَ، وَأَحْيِهَا بِمَعْرِفَتِكَ، وَأَمِتْهَا عَلَى الشَّهَادَةِ فِي سَبِيلِكَ. إِنَّكَ نِعْمَ الْمَوْلَى وَنِعْمَ النَّصِيرُ. اَللَّهُمَّ أَمِينَ، وَصَلِّ اللَّهُمَّ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِهِ وَصَحْبِهِ وَسَلِّمْ.",
                latin: "Allaahumma innaka ta'lamu anna haadzihil-quluuba qadij-tama'at 'alaa mahabbatik, wal-taqat 'alaa thaa'atik, wa tawahhadat 'alaa da'watik, wa ta'ahadat 'alaa nushrati syarii'atik. Fawats-tsiqillaahumma raabithatahaa, wa adim wuddahaa, wahdihaa subulahaa, wamla'haa binuurikal-ladzii laa yakhbuu, wasyrah shuduurahaa bifaidhil-iimaani bik, wa jamiilit-tawakkuli 'alaik, wa ahyihaa bima'rifatik, wa amithaa 'alasy-syahaadati fii sabiilik. Innaka ni'mal-maulaa wa ni'man-nashiir. Allaahumma aamiin, wa shallillaahumma 'alaa sayyidinaa muhammadiw-wa 'alaa aalihii wa shahbihii wa sallim.",
                arti: "Ya Allah, sesungguhnya Engkau mengetahui bahwa hati-hati ini telah berkumpul atas dasar kecintaan kepada-Mu, bertemu atas dasar ketaatan pada-Mu, bersatu atas dasar dakwah-Mu, dan berjanji setia untuk membela syariat-Mu. Maka kuatkanlah ikatannya, kekalkanlah kasih sayangnya, tunjukkanlah jalannya, dan penuhilah ia dengan cahaya-Mu yang tidak pernah redup. Lapangkanlah dadanya dengan limpahan iman kepada-Mu dan keindahan tawakal kepada-Mu. Hidupkanlah ia dengan ma'rifat-Mu, dan matikanlah ia dalam keadaan syahid di jalan-Mu. Sesungguhnya Engkau adalah sebaik-baik pelindung dan penolong. Ya Allah, kabulkanlah. Dan limpahkanlah rahmat kepada junjungan kami Nabi Muhammad, beserta keluarga dan para sahabatnya.",
                target: 1,
                fullWidth: true
            }
        ],
        yasin: [
            {
                title: "QS. Yasin (Ayat 1-12)",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. يٰسۤ ۚ. وَالْقُرْاٰنِ الْحَكِيْمِ ۙ. اِنَّكَ لَمِنَ الْمُرْسَلِيْنَ ۙ. عَلٰى صِرَاطٍ مُّسْتَقِيْمٍ ۗ. تَنْزِيْلَ الْعَزِيْزِ الرَّحِيْمِ ۙ. لِتُنْذِرَ قَوْمًا مَّآ اُنْزِلَ اٰبَاۤؤُهُمْ فَهُمْ غٰfِلُوْنَ. لَقَدْ حَقَّ الْقَوْلُ عَلٰٓى اَكْثَرِهِمْ فَهُمْ لَا يُؤْمِنُوْنَ. اِنَّا جَعَلْنَا فِيْٓ اَعْنَاقِهِمْ اَغْلٰلًا فَهِيَ اِلَى الْاَذْقَانِ فَهُمْ مُّقْمَحُوْنَ. وَجَعَلْنَا مِنْۢ بَيْنِ اَيْدِيْهِمْ سَدًّا وَّمِنْ خَلْفِهِمْ سَدًّا فَاَغْشَيْنٰهُمْ فَهُمْ لَا يُبْصِرُوْنَ. وَسَوَاۤءٌ عَلَيْهِمْ ءَاَنْذَرْتَهُمْ اَمْ لَم * ُتْنُذِرْهُمْ لَا يُؤْمِنُوْنَ. اِنَّمَا تُنْذِرُ مَنِ اتَّبَعَ الذِّكْرَ وَخَشِيَ الرَّحْمٰنَ بِالْغَيْبِۚ فَبَشِّرْهُ بِمَغْفِرَةٍ وَّاَجْرٍ كَرِيْمٍ. اِنَّآ نَحْنُ نُحْيِ الْمَوْتٰى وَنَكْتُبُ مَا قَدَّمُوْا وَاٰثَارَهُمْۗ وَكُلَّ شَيْءٍ اَحْصَيْنٰهُ فِيْٓ اِمَامٍ مُّبِيْنٍ",
                latin: "Bismillaahir-rahmaanir-rahiim. Yaasiin. Wal-qur-aanil-hakiim. Innaka laminal-mursaliin. 'Alaa shiraathim-mustaqiim. Tanziilal-'aziizir-rahiim. Litundzira qaumam-maaa undzira aabaaa'uhum fahum ghaafiluun. Laqad haqqal-qaulu 'alaaa aktsarihim fahum laa yu'minuun. Innaa ja'alnaa fii a'naaqihim aghlaalan fahiya ilal-adzqaani fahum muqmahuun. Wa ja'alnaa mim-baini aidiihim saddaw-wa min khalfihim saddan fa-aghsyainaahum fahum laa yubshiruun. Wa sawaaa'un 'alaihim 'a-andzartahum am lam tundzirhum laa yu'minuun. Innamaa tundziru manit-taba'adz-dzikra wa khasyiyar-rahmaana bil-ghaib, fabasysyirhu bimaghfiratiw-wa ajrinkariim. Innaa nahnu nuhyil-mautaa wanaktubu maa qaddamuu wa aatsaarahum, wa kulla syai'in ahsainaahu fii imaamim-mubiyn.",
                arti: "Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Yasin. Demi Al-Qur'an yang penuh hikmah. Sungguh, engkau (Muhammad) adalah salah seorang dari rasul-rasul, (yang berada) di atas jalan yang lurus, (sebagai wahyu) yang diturunkan oleh (Allah) Yang Maha Perkasa, Maha Penyayang, agar engkau memberi peringatan kepada suatu kaum yang nenek moyangnya belum pernah diberi peringatan, karena itu mereka lalai. Sungguh, keputusan (berlaku) terhadap kebanyakan mereka, karena mereka tidak beriman. Sungguh, Kami telah memasang belenggu di leher mereka, lalu tangan mereka (diangkat) ke dagu, karena itu mereka tertengadah. Dan Kami jadikan dinding di hadapan mereka dan di belakang mereka dinding (pula), dan Kami tutup (mata) mereka sehingga mereka tidak dapat melihat. Dan sama saja bagi mereka, apakah engkau memberi peringatan kepada mereka atau engkau tidak memberi peringatan kepada mereka, mereka tidak akan beriman. Sesungguhnya engkau hanya memberi peringatan kepada orang-orang yang mau mengikuti peringatan dan yang takut kepada Tuhan Yang Maha Pengasih, walaupun mereka tidak melihat-Nya. Maka berilah mereka kabar gembira dengan ampunan dan pahala yang mulia. Sungguh, Kamilah yang menghidupkan orang-orang yang mati dan Kamilah yang mencatat apa yang telah mereka kerjakan dan bekas-bekas yang mereka tinggalkan. Dan segala sesuatu Kami kumpulkan dalam Kitab Induk yang nyata (Lauh Mahfuzh).",
                target: 1,
                fullWidth: true
            },
            {
                title: "QS. Yasin (Ayat 82-83) & Doa Penutup",
                arabic: "إِنَّمَا أَمْرُهُ إِذَا أَرَادَ شَيْئًا أَنْ يَقُولَ لَهُ كُنْ فَيَكُونُ. فَسُبْحَانَ الَّذِي بِيَدِهِ مَلَكُوتُ كُلِّ شَيْءٍ وَإِلَيْهِ تُرْجَعُونَ",
                latin: "Innamaa amruhuu idzaa araada syai'an ay-yaquula lahuu kun fayakuun. Fasubhaanalladzii biyadihii malakuutu kulli syai'iw-wa ilaihi turja'uun.",
                arti: "Sesungguhnya urusan-Nya apabila Dia menghendaki sesuatu Dia hanya berkata kepadanya, 'Jadilah!' Maka jadilah sesuatu itu. Maka Maha Suci Allah yang di tangan-Nya kekuasaan atas segala sesuatu dan kepada-Nya kamu dikembalikan.",
                target: 1,
                fullWidth: true
            }
        ],
        tahlil: [
            {
                title: "1. Tawasul / Pengantar Al-Fatihah",
                arabic: "إِلَى حَضْرَةِ النَّبِيِّ الْمُصْطَفَى سَيِّدِنَا مُحَمَّدٍ صَلَّى اللهُ عَلَيْهِ وَسَلَّمَ وَآلِهِ وَأَصْحَابِهِ وَأَزْوَاجِهِ وَأَوْلَادِهِ وَذُرِّيَّاتِهِ، ثُمَّ إِلَى أَرْوَاحِ إِخْوَانِهِ مِنَ الْأَنْبِيَاءِ وَالْمُرْسَلِينَ وَالْأَوْلِيَاءِ وَالشُّهَدَاءِ وَالصَّالِحِينَ وَالصَّحَابَةِ وَالتَّابِعِينَ وَالْعُلَمَاءِ الْعَامِلِينَ وَالْمُصَنِّفِينَ الْمُخْلِصِينَ وَجَمِيعِ الْمَلَائِكَةِ الْمُقَرَّبِينَ، ثُمَّ إِلَى أَرْوَاحِ أَهْلِ الْقُبُورِ مِنَ الْمُسْلِمِينَ وَالْمُسْلِمَاتِ وَالْمُؤمِنِينَ وَالْمُؤمِنَاتِ مِنْ مَشَارِقِ الْأَرْضِ إِلَى مَغَارِبِهَا بَرِّهَا وَبَحْرِهَا، خُصُوصًا إِلَى آبَائِنَا وَأُمَّهَاتِنَا وَأَجْدَادِنَا وَجَدَّاتِنَا وَمَشَايِخِنَا وَمَشَايِخِ مَشَايِخِنَا وَأَسَاتِذَتِنَا وَأَسَاتِذَةِ أَسَاتِذَةِ أَسَاتِذَتِنَا وَلِمَنِ اجْتَمَعْنَا هَهُنَا بِسَبَبِهِ، شَيْءٌ لِلهِ لَهُمُ الْفَاتِحَةُ",
                latin: `Ilaa hadhratin-nabiyyil-mushthafaa sayyidinaa muhammadin shallallaahu 'alaihi wa sallama wa aalihi wa ash-haabihi wa azwaajihi wa aulaadihi wa dzurriyaatihi, tsumma ilaa arwaahi ikhwaanihi minal-anbiyaai wal-mursaliina wal-auliyaai wasy-syuhadaai wash-shaalihiina wash-shahaabati wat-taabi'iina wal-'ulamaail-'aamiliina wal-mushannifiinal-mukhlishiina wa jamii'il-malaaikatil-muqarrabiina, tsumma ilaa arwaahi ahlil-qubuuri minal-muslimiina wal-muslimaati wal-mu'miniina wal-mu'minaati min masyaariqil-ardhi ilaa maghaaribihaa barrihaa wa bahrihaa khushuushan ilaa aabaainaa wa ummahaatinaa wa ajdaadinaa wa jaddaatinaa wa masyaayikhonaa wa masyaayikhi masyaayikhinaa wa asaatidzatinaa wa asaatidzaati asaatidzatinaa wa liman ahsana ilainaa wa limanij-tama'naa haahunaa bisababihi, syai'ul-lillaahi lahumul-faatihah.`,
                arti: `Untuk yang terhormat Nabi Muhammad SAW, segenap keluarga, sahabat, istri, anak, dan keturunannya. Kemudian kepada arwah para nabi, rasul, wali, syuhada, orang saleh, sahabat, tabi'in, ulama yang mengamalkan ilmunya, penulis yang ikhlas, dan semua malaikat yang didekatkan. Kemudian untuk ahli kubur muslimin, muslimat, mukminin, mukminat dari Timur ke Barat, di darat maupun di laut, khususnya bapak-ibu, kakek-nenek, guru-guru kami, pengajar dari guru kami, ustadz kami, pengajar ustadz kami, mereka yang berbuat baik kepada kami, dan orang yang membuat kami berkumpul di sini. Segala urusan milik Allah, bagi mereka Al-Fatihah.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "2. QS. Al-Fatihah",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. اَلْحَمْدُ لِلّٰهِ رَبِّ الْعٰلَمِيْنَۙ. الرَّحْمٰنِ الرَّحِيْمِۙ. مٰلِكِ يَوْمِ الدِّيْنِۗ. اِيَّاكَ نَعْبُدُ وَاِيَّاكَ نَسْتَعِيْنُۗ. اِهْدِنَا الصِّرَاطَ الْمُسْتَقِيْمَۙ. صِرَاطَ الَّذِيْنَ اَنْعَمْتَ عَلَيْهِمْ ەۙ غَيْرِ الْمَغْضُوْبِ عَلَيْهِمْ وَلَا الضَّالِّينَ۠",
                latin: `Bismillaahir-rahmaanir-rahiim. Al-hamdu lillaahi rabbil-'aalamiin. Ar-rahmaanir-rahiim. Maaliki yaumid-diin. Iyyaaka na'budu wa iyyaaka nasta'iin. Ihdinas-shiraathal-mustaqiim. Shiraathal-ladziina an'amta 'alaihim ghairil-maghghuubi 'alaihim waladh-dhaalliin.`,
                arti: `Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Segala puji bagi Allah, Tuhan semesta alam. Yang Maha Pengasih lagi Maha Penyayang. Pemilik hari pembalasan. Hanya kepada-Mu kami menyembah dan hanya kepada-Mu kami memohon pertolongan. Tunjukkanlah kami jalan yang lurus, (yaitu) jalan orang-orang yang telah Engkau beri nikmat kepadanya; bukan (jalan) mereka yang dimurkai, dan bukan (pula jalan) mereka yang sesat.`,
                target: 1
            },
            {
                title: "3. QS. Al-Ikhlas (3x)",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. قُلْ هُوَ اللّٰهُ اَحَدٌۚ. اَللّٰهُ الصَّمَدُۚ. لَمْ يَلِدْ وَلَمْ يُوْلَدْۙ. وَلَمْ يَكُنْ لَّهٗ كُفُوًا اَحَدٌ",
                latin: `Bismillaahir-rahmaanir-rahiim. Qul huwallaahu ahad. Allaahus-shamad. Lam yalid wa lam yuulad. Wa lam yakul-lahuu kufuwan ahad.`,
                arti: `Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Katakanlah (Muhammad), 'Dialah Allah, Yang Maha Esa. Allah tempat meminta segala sesuatu. Allah tidak beranak dan tidak pula diperanakkan. Dan tidak ada sesuatu yang setara dengan Dia.'`,
                target: 3
            },
            {
                title: "4. Tahlil & Takbir",
                arabic: "لَآ اِلٰهَ اِلَّا اللّٰهُ وَاللّٰهُ اَكْبَرُ",
                latin: `Laa ilaaha illallaahu wallaahu akbar`,
                arti: `Tiada Tuhan selain Allah, dan Allah Maha Besar.`,
                target: 1
            },
            {
                title: "5. QS. Al-Falaq",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. قُلْ اَعُوْذُ بِرَبِّ الْفَلَقِۙ. مِنْ شَرِّ مَا خَلَقَۙ. وَمِنْ شَرِّ غَاسِقٍ اِذَا وَقَبَۙ. وَمِنْ شَرِّ النَّفّٰثٰtِ فِى الْعُقَدِۙ. وَمِنْ شَرِّ حَاسِدٍ اِذَا حَسَدَ",
                latin: `Bismillaahir-rahmaanir-rahiim. Qul a'uudzu birabbil-falaq. Min syarri maa khalaq. Wa min syarri ghaasiqin idzaa waqab. Wa min syarri-naffaatsaati fil-'uqad. Wa min syarri haasidin idzaa hasad.`,
                arti: `Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Katakanlah, 'Aku berlindung kepada Tuhan yang menguasai subuh, dari kejahatan (makhluk yang) Dia ciptakan, dan dari kejahatan malam apabila telah gelap gulita, dan dari kejahatan (perempuan-perempuan) penyihir yang meniup pada buhul-buhul (talinya), dan dari kejahatan orang yang dengki apabila dia dengki.'`,
                target: 1
            },
            {
                title: "6. Tahlil & Takbir",
                arabic: "لَآ اِلٰهَ اِلَّا اللّٰهُ وَاللّٰهُ اَكْبَرُ",
                latin: `Laa ilaaha illallaahu wallaahu akbar`,
                arti: `Tiada Tuhan selain Allah, dan Allah Maha Besar.`,
                target: 1
            },
            {
                title: "7. QS. An-Nas",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. قُلْ اَعُوْذُ بِرَبِّ النَّاسِۙ. مَلِكِ النَّاسِۙ. اِلٰهِ النَّاسِۙ. مِنْ شَرِّ الْوَسْوَاسِ ەۙ الْخَنَّاسِۖ. الَّذِيْ يُوَسْوِسُ فِيْ صُدُوْرِ النَّاسِۙ. مِنَ الْجِنَّةِ وَالنَّاسِ",
                latin: `Bismillaahir-rahmaanir-rahiim. Qul a'uudzu birabbin-naas. Malikin-naas. Ilaahin-naas. Min syarril-waswaasil-khannaas. Al-ladzii yuwaswisu fii shuduurin-naas. Minal-jinnati wan-naas.`,
                arti: `Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Katakanlah, 'Aku berlindung kepada Tuhannya manusia, Raja manusia, Sembahan manusia, dari kejahatan (bisikan) setan yang bersembunyi, yang membisikkan (kejahatan) ke dalam dada manusia, dari (golongan) jin dan manusia.'`,
                target: 1
            },
            {
                title: "8. Tahlil & Takbir Lengkap",
                arabic: "لَآ اِلٰهَ اِلَّا اللّٰهُ وَاللّٰهُ اَكْبَرُ وَلِلّٰهِ الْحَمْدُ",
                latin: `Laa ilaaha illallaahu wallaahu akbar walillaahil-hamd`,
                arti: `Tiada Tuhan selain Allah, Allah Maha Besar, dan bagi Allah segala puji.`,
                target: 1
            },
            {
                title: "9. QS. Al-Baqarah : 1 – 5",
                arabic: "بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ. الۤمّۤۚ. ذٰلِكَ الْكِتٰبُ لَا رَيْبَ ۛ فِيْهِ ۛ هُدًى لِّلْمُتَّقِيْنَۙ. الَّذِيْنَ يُؤْمِنُوْنَ بِالْغَيْبِ وَيُقِيْمُوْنَ الصَّلٰوةَ وَمِمَّا رَزَقْنٰهُمْ يُنْفِقُوْنَۙ. وَالَّذِيْنَ يُؤْمِنُوْنَ بِمَآ اُنْزِلَ اِلَيْكَ وَمَآ اُنْزِلَ مِنْ قَبْلِكَۚ وَبِالْاٰخِرَةِ هُمْ يُوقِنُوْنَۗ. اُولٰۤىِٕكَ عَلٰى هُدًى مِّنْ رَّبِّهِمْ ۙ وَاُولٰۤىِٕكَ هُمُ الْمُفْلِحُوْنَ",
                latin: `Bismillaahir-rahmaanir-rahiim. Alif-laam-miim. Dzaalikal-kitaabu laa raiba fiihi hudan lil-muttaqiin. Al-ladziina yu'minuuna bil-ghaibi wa yuqiimuunas-shalaata wa mimmaa razaqnaahum yunfiquun. Wal-ladziina yu'minuuna bimaa unzila ilaika wa maa unzila min qablika wa bil-aakhirati hum yuuqinuun. Ulaa'ika 'alaa hudam mir-rabbihim wa ulaa'ika humul-muflihuun.`,
                arti: `Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Alif Lam Mim. Kitab (Al-Qur'an) ini tidak ada keraguan padanya; petunjuk bagi mereka yang bertakwa, (yaitu) mereka yang beriman kepada yang gaib, melaksanakan shalat, dan menginfakkan sebagian rezeki yang Kami berikan kepada mereka, dan mereka yang beriman kepada (Al-Qur'an) yang diturunkan kepamadamu (Muhammad) dan (kitab-kitab) yang diturunkan sebelum engkau, dan mereka yakin akan adanya akhirat. Merekalah yang mendapat petunjuk dari Tuhannya, dan mereka itulah orang-orang yang beruntung.`,
                target: 1
            },
            {
                title: "10. Ayat Kursi",
                arabic: "اللّٰهُ لَآ اِلٰهَ اِلَّا هُوَ الْحَيُّ الْقَيُّوْمُۚ لَا تَأْخُذُهٗ سِنَةٌ وَلَا نَوْمٌۗ لَهٗ مَا فِى السَّمٰوٰتِ وَمَا فِى الْاَرْضِۗ مَنْ ذَا الَّذِيْ يَشْفَعُ عِنْدَهٗٓ اِلَّا بِاِذْنِهٖۗ يَعْلَمُ مَا بَيْنَ اَيْدِيْهِمْ وَمَا خَلْفَهُمْۚ وَلَا يُحِيْطُوْنَ بِشَيْءٍ مِّنْ عِلْمِهٖٓ اِلَّا بِاِذْنِهٖ يَعْلَمُ مَا بَيْنَ اَيْدِيْهِمْ وَمَا خَلْفَهُمْۚ وَلَا يُحِيْطُوْنَ بِشَيْءٍ مِّنْ عِلْمِهٖٓ اِلَّا بِاِذْنِهٖ يَعْلَمُ مَا بَيْنَ اَيْدِيْهِمْ وَمَا خَلْفَهُمْۚ وَلَا يُحِيْطُوْنَ بِشَيْءٍ مِّنْ عِلْمِهٖٓ اِلَّا بِبَعْضِ عِلْمِهِ اِلَّا بِمَا شَاۤءَۚ وَسِعَ كُرْسِيُّهُ السَّمٰوٰتِ وَالْاَرْضَۚ وَلَا يَـُٔوْdُهٗ حِفْظُهُمَاۚ وَهوَ الْعَلِيُّ الْعَظِيْمُ",
                latin: `Allaahu laa ilaaha illa huwal-hayyul-qayyuum, laa ta'khudzuhuu sinatuw-wa laa naum, lahuu maa fis-samaawaati wa maa fil-ardh, man dzal-ladzii yasyfa'u 'indahuu illa bi idznih, ya'lamu maa baina aidiihim wa maa khalfahum, wa laa yuhiithuuna bisyai'im-min 'ilmihii illa bimaa syaa', wasi'a kursiyyuhus-samaawaati wal-ardh, wa laa ya'uuduhuu hifdhuhumaa wa huwal-'aliyyul-'adhiim.`,
                arti: `Allah, tidak ada tuhan selain Dia. Yang Maha Hidup, yang terus-menerus mengurus (makhluk-Nya), tidak mengantuk dan tidak tidur. Milik-Nya apa yang ada di langit dan apa yang ada di bumi. Tidak ada yang dapat memberi syafaat di sisi-Nya tanpa izin-Nya. Dia mengetahui apa yang ada di frente a mereka dan apa yang ada di belakang mereka, dan mereka tidak mengetahui sesuatu pun dari ilmu-Nya melainkan apa yang Dia kehendaki. Kursi-Nya meliputi langit dan bumi. Dan Dia tidak merasa berat memelihara keduanya, dan Dia Maha Tinggi lagi Maha Agung.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "11. QS. Al-Baqarah : 284 – 286",
                arabic: "لِّلَّهِ مَا فِى ٱلسَّمَٰوَٰتِ وَمَا فِى ٱلْأَرْضِۗ وَإِن تُبْدُوا۟ مَا فِىٓ أَنفُسِكُمْ أَوْ تُخْفُوهُ يُحَاسِبْكُم بِهِ ٱللَّهُۖ فَيَغْفِرُ لِمَن يَشَآءُ وَyُعَذِّبُ مَن يَشَآءُۗ وَٱللَّهُ عَلَىٰ كُلِّ شَىْءٍ قَدِيرٌ. اٰمَنَ Rَّسُوْلُ بِمَآ اُنْزِلَ اِلَيْهِ مِنْ رَّبِّهٖ وَالْمُؤْمِنُوْنَۗ كُلٌّ اٰمَنَ بِاللّٰهِ وَمَلٰۤىِٕكَتِهٖ وَكُtُبِهٖ وَرُسُلِهٖۗ لَا nُفَرِّقُ بَيْنَ اَحَدٍ مِّنْ رُّسُلِهٖۗ وَقَالُوْا سَمِعْنَا وَاَطَعْنَا غُفْرَانَكَ رَبَّنَا وَاِلَيْكَ الْمَصِيْرُ. لَا يُكَلِّفُ اللّٰه * نَفْسًا اِلَّا وُسْعَهَاۗ لَهَا مَا كَسَبَتْ وَعَلَيْهَا مَا اكْتَسَبَتْۗ رَبَّنَا لَا تُؤَاخِذْنَآ اِنْ نَّسِيْنَآ اَوْ اَخْطَأْنَاۚ رَبَّنَا وَلَا تَحْمِل * عَلَيْنَآ اِصْرًا كَمَا حَمَلْتَهٗ عَلَى الَّذِينَ مِنْ قَبْلِنَاۚ رَبَّنَا وَلَا تُحَمِّلْنَا مَا لَا طَاقَةَ لَنَا بِهٖۚ وَاعْفُ عَنَّاۗ وَاغْفِرْ لَنَاۗ وَارْحَمْنَاۗ اَنْتَ مَوْلٰىنَا فَانْصُرْنَا عَلَى الْقَوْمِ الْكَافِرِيْنَ",
                latin: `Lillāhi mā fis-samāwāti wa mā fil-arḍ, wa in tubdụ mā fī anfusikum au tukhfụhu yuḥāsibkum bihillāh, fa yagfiru limay yasyā\`u wa yu'ażżibu may yasyā\`, wallāhu 'alā kulli syai\`ing qadīr. Aamanar-rasuulu bimaa unzila ilaihi mir-rabbihii wal-mu'minuun, kullun aamana billaahi wa malaaikatihii wa kutubihii wa rusulih, laa nufarriqu baina ahadim-mir-rusulih, wa qaaluu sami'naa wa atha'naa ghufraanaka rabbanaa wa ilaikal-mashiir. Laa yukallifullaahu nafsan illaa wus'ahaa, lahaa maa kasabat wa 'alaihaa maktasabat, rabbanaa laa tu'aakhidznaa in-nasiinaa au akhtha'naa, rabbanaa wa laa tahmil 'alainaa ishran kamaa hamaltahuu 'alalladziina min qablinaa, rabbanaa wa laa tuhammilnaa maa laa thaaqata lanaa bih, wa'fu 'annaa, waghfir lanaa, warhamnaa, anta maulaanaa fanshurnaa 'alal-qaumil-kaafiriin.`,
                arti: `Milik Allah-lah apa yang ada di langit dan apa yang ada di bumi. Dan jika kamu nyatakan apa yang ada di dalam hatimu atau kamu sembunyikan... Rasul (Muhammad) beriman kepada apa yang diturunkan kepadanya dari Tuhannya, demikian pula orang-orang yang beriman... Allah tidak membebani seseorang melainkan sesuai dengan kesanggupannya...`,
                target: 1,
                fullWidth: true
            },
            {
                title: "12. Ayat Rahmat (QS. Hud : 73)",
                arabic: "رَحْمَتُ اللهِ وَبَرَكَاتُهُ عَلَيْكُمْ أَهْلَ الْبَيْتِ إِنَّهُ حَمِيدٌ مَّجِيدٌ",
                latin: `Rahmatullāhi wa barakātuhū ‘alaikum ahlal-baiti innahū ḥamīdum majīd.`,
                arti: `Rahmat Allah dan keberkahan-Nya (kami harapkan) tercurah kepada kalian, wahai Ahlul Bait. Sesungguhnya Dia Maha Terpuji lagi Maha Pemurah.`,
                target: 1
            },
            {
                title: "13. Keutamaan Ahlul Bait (QS. Al-Ahzab : 33)",
                arabic: "إِنَّمَا يُرِيْدُ اللهُ لِيُذْهِبَ عَنْكُمُ الرِّجْسَ أَهْلَ الْبَيْتِ وَيُطَهِّرَكُمْ تَطْهِيْرًا",
                latin: `Innamā yurīdullāhu liyudzhiba ‘ankumur-rijsa ahlal-baiti wa yuṭahhirakum taṭhīrā.`,
                arti: `Sesungguhnya Allah bermaksud hendak menghilangkan dosa dari kamu, wahai ahlul bait, dan membersihkan kamu sebersih-bersihnya.`,
                target: 1
            },
            {
                title: "14. Ayat Shalawat (QS. Al-Ahzab : 56)",
                arabic: "إِنَّ اللَّهَ وَمَلَائِكَتَهُ يُصَلُّونَ عَلَى النَّبِيِّ ۚ يَا أَيُّهَا الَّذِينَ آمَنُوا صَلُّوا عَلَيْهِ وَسَلِّمُوا تَسْلِيمًا",
                latin: `Innallāha wa malā\`ikatahū yuṣallūna 'alan-nabiyy, yā ayyuhallażīna āmanū ṣallū 'alaihi wa sallimū taslīmā.`,
                arti: `Sesungguhnya Allah dan para malaikat-Nya bershalawat untuk Nabi. Wahai orang-orang yang beriman! Bershalawatlah kamu untuk Nabi dan ucapkanlah salam dengan penuh penghormatan kepadanya.`,
                target: 1
            },
            {
                title: "15. Shalawat Afdhalash-Shalati",
                arabic: "اَللّٰهُمَّ صَلِّ أَفْضَلَ الصَّلَاةِ عَلَى أَسْعَدِ مَخْلُوْقَاتِكَ نُوْرِ الْهُدَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى اٰلِهِ وَصَحْبِهِ وَسَلِّمْ، عَدَدَ مَعْلُوْمَاتِكَ وَمِدَادَ كَلِمَاتِكَ كُلَّمَا ذَكَرَكَ الذَّاكِرُوْنَ وَغَفَلَ عَنْ ذِكْرِكَ الْغَافِلُوْنَ",
                latin: `Allâhumma shalli afdlalash-shalâti 'alâ as'adi makhlûqôtika nûril-hudâ sayyidinâ Muḫammadin wa 'alâ âlihi wa shaḫbihi wa sallim, 'adada ma'lûmâtika wa midâda kalimâtika kullamâ dzakaradzd zâkirûna wa ghafala 'an dzikrikal ghâfilûn.`,
                arti: `Ya Allah, limpahkanlah rahmat dengan sholawat yang paling utama kepada makhluk-Mu yang paling bahagia, yaitu cahaya petunjuk, junjungan kami Nabi Muhammad, beserta keluarga dan para sahabatnya, sebanyak hitungan ilmu-Mu dan sebanyak tinta kalimat-kalimat-Mu, setiap kali orang-orang yang ingat menyebut-Mu dan orang-orang yang lalai melupakan-Mu.`,
                target: 3
            },
            {
                title: "16. Salam & Sahabat Nabi",
                arabic: "وَسَلِّمْ وَرَضِيَ اللهُ تَعَالَى عَنْ سَادَاتِنَا أَصْحَابِ رَسُولِ اللهِ أَجْمَعِينَ",
                latin: `Wa sallim wa radhiyallaahu ta'aalaa 'an saadaatinaa ash-haabi rasuulillaahi ajma'iin.`,
                arti: `Dan limpahkanlah keselamatan, serta ridha Allah Ta'ala semoga tercurah kepada junjungan kami, para sahabat Rasulullah semuanya.`,
                target: 1
            },
            {
                title: "17. Hasbunallah Wanikmal Wakil",
                arabic: "حَسْبُنَا اللهُ وَنِعْمَ الْوَكِيلُ نِعْمَ الْمَوْلَى وَنِعْمَ النَّصِيرُ",
                latin: `Hasbunallaahu wa ni'mal-wakiil, ni'mal-maulaa wa ni'man-nashiir.`,
                arti: `Cukuplah Allah bagi kami dan Dia adalah sebaik-baik penolong, sebaik-baik pelindung dan sebaik-baik penolong.`,
                target: 3
            },
            {
                title: "18. Hauqalah",
                arabic: "وَلَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللهِ الْعَلِيِّ الْعَظِيمِ",
                latin: `Wa laa hawla wa laa quwwata illaa billaahil-'aliyyil-'azhiim.`,
                arti: `Dan tidak ada daya dan upaya kecuali dengan kekuatan Allah Yang Maha Tinggi lagi Maha Agung.`,
                target: 3
            },
            {
                title: "19. Istighfar",
                arabic: "أَسْتَغْفِرُ اللهَ الْعَظِيمَ",
                latin: `Astaghfirullaahal-'azhiim`,
                arti: `Saya mohon ampun kepada Allah Yang Maha Agung.`,
                target: 3
            },
            {
                title: "20. Afdhaludz-Dzikri",
                arabic: "أَفْضَلُ الذِّكْرِ فَاعْلَمْ أَنَّهُ لَا إِلٰهَ إِلَّا اللهُ حَيٌّ مَوْجُوْدٌ. لَا إِلٰهَ إِلَّا اللهُ حَيٌّ مَعْبُوْدٌ. لَا إِلٰهَ إِلَّا اللهُ حَيٌّ بَاقٍ الَّذِيْ لَا يَمُوْتُ",
                latin: `Afdhaludz dzikri fa’lam annahu laa ilaaha illallaah, hayyun maujuud. Laa ilaaha illallaah, hayyun ma'buud. Laa ilaaha illallaah, hayyun baaqin alladzii laa yamuut.`,
                arti: `Sebaik-baik dzikir—ketahuilah—adalah lafal 'Tiada Tuhan selain Allah', yang Maha Wujud. Tiada Tuhan selain Allah, yang Maha Disembah. Tiada Tuhan selain Allah, yang Maha Kekal yang tidak mati.`,
                target: 1,
                fullWidth: true
            },
            {
                title: "21. Tahlil",
                arabic: "لَا اِلٰهَ اِلَّا اللهُ",
                latin: `Laa ilaaha illallaah`,
                arti: `Tiada Tuhan selain Allah.`,
                target: 33
            },
            {
                title: "22. Kalimat Penutup Tahlil",
                arabic: "لَا اِلٰهَ اِلَّا اللهُ سَيِّدُنَا مُحَمَّدٌ رَسُوْلُ اللهِ صَلَّى اللهُ عَلَيْهِ وَسَلَّمَ",
                latin: `Laa ilaaha illallaah Sayyidinaa Muhammadur Rasuulullaahi shallallaahu 'alaihi wa sallam.`,
                arti: `Tiada Tuhan selain Allah, junjungan kami Nabi Muhammad adalah utusan Allah, semoga Allah memberikan rahmat dan keselamatan kepadanya.`,
                target: 1
            },
            {
                title: "23. Shalawat Habibika",
                arabic: "اَللّٰهُمَّ صَلِّ عَلَى حَبِيْبِكَ سَيِّدِنَا مُحَمَّدٍ وَعَلَى اٰلِهِ وَصَحْبِهِ وَسَلِّمْ",
                latin: `Allaahumma shalli 'alaa habiibika Sayyidinaa Muhammadiw-wa 'alaa aalihii wa shahbihii wa sallim.`,
                arti: `Ya Allah, limpahkanlah rahmat takzim dan keselamatan kepada kekasih-Mu, junjungan kami Nabi Muhammad, keluarga, dan para sahabatnya.`,
                target: 3
            },
            {
                title: "24. Doa Tahlil (Doa Arwah)",
                arabic: "بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيْمِ. اَلْحَمْدُ للهِ رَبِّ الْعَالَمِيْنَ حَمْدًا يُوَافِيْ نِعَمَهُ وَيُكَافِئُ مَزِيْدَهُ. يَا رَبَّنَا لَكَ الْحَمْدُ كَمَا يَنْبَغِيْ لِجَلَالِ وَجْهِكَ وَعَظِيْمِ سُلْطَانِكَ. اَللَّهُمَّ صَلِّ وَسَلِّمْ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ. اَللَّهُمَّ تَقَبَّلْ وَأَوْصِلْ ثَوَابَ مَا قَرَأْنَاهُ مِنَ الْقُرْآنِ الْعَظِيْمِ وَمَا هَلَّلْنَاهُ وَمَا سَبَّحْنَاهُ وَمَا اسْتَغْفَرْنَاهُ وَمَا صَلَّيْنَاهُ عَلَى سَيِّدِنَا مُحَمَّدٍ صَلَّى اللهُ عَلَيْهِ وَسَلَّمَ هَدِيَّةً وَاصِلَةً وَرَحْمَةً نَازِلَةً وَبَرَكَةً شَامِلَةً إِلَى حَضْرَةِ حَبِيْبِنَا وَشَفِيْعِنَا وَقُرَّةِ أَعْيُنِنَا سَيِّدِنَا وَمَوْلَانَا مُحَمَّدٍ صَلَّى اللهُ عَلَيْهِ وَسَلَّمَ، وَإِلَى أَرْوَاحِ جَمِيْعِ إِخْوَانِهِ مِنَ الْأَنْبِيَاءِ وَالْمُرْسَلِينَ وَالْأَوْلِيَاءِ وَالشُّهَدَاءِ وَالصَّالِحِينَ وَالصَّحَابَةِ وَالتَّابِعِينَ وَالْعُلَمَاءِ الْعَامِلِينَ وَالْمُصَنِّفِينَ الْمُخْلِصِينَ وَجَمِيعِ الْمُجَاهِدِينَ فِي سَبِيلِ اللهِ رَبِّ الْعَالَمِيْنَ وَالْمَلَائِكَةِ الْمُقَرَّبِينَ، خُصُوصًا إِلَى سَيِّدِنَا الشَّيْخِ عَبْدِ الْقَادِرِ الْجِيلَانِيِّ. ثُمَّ اِلَى أَرْوَاحِ جَمِيْعِ أَهْلِ الْقُبُورِ مِنَ الْمُسْلِمِينَ وَالْمُسْلِمَاتِ وَالْمُؤْمِنِينَ وَالْمُؤمِنَاتِ مِنْ مَشَارِقِ الْأَرْضِ إِلَى مَغَارِبِهَا بَرِّهَا وَبَحْرِهَا، خُصُوصًا إِلَى آبَائِنَا وَأُمَّهَاتِنَا وَأَجْدَادِنَا وَجَدَّاتِنَا، وَخُصُوصًا إِلَى الرُّوحِ... اَللَّهُمَّ اغْفِرْ لَهُمْ وَارْحَمْهُمْ وَعَافِهِمْ وَاعْفُ عَنْهُمْ. اَللَّهُمَّ أَنْزِلِ الرَّحْمَةَ وَالْمَغْفِرَةَ عَلَى أَهْلِ الْقُبُوْرِ مِنْ أَهْلِ لَآ اِلٰهَ اِلَّا اللهُ مُحَمَّدٌ رَسُوْلُ اللهِ. رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً وَفِي الْآخِرَةِ حَسَنَةً وَقِنَا عَذَابَ النَّارِ. سُبْحَانَ رَبِّكَ رَبِّ الْعِزَّةِ عَمَّا يَصِفُونَ، وَسَلَامٌ عَلَى الْمُرْسَلِينَ، وَالْحَمْدُ للهِ رَبِّ الْعَالَمِيْنَ",
                latin: `Bismillaahir-rahmaanir-rahiim. Alhamdu lillaahi rabbil-'aalamiin hamday-yuwaafii ni'amahuu wa yukaafi'u maziidah. Yaa rabbanaa lakal-hamdu kamaa yambaghii lijalaali wajhika wa 'adhiimi sulthaanik. Allaahumma shalli wa sallim 'alaa sayyidinaa muhammadin wa 'alaa aali sayyidinaa muhammad... Allaahummaghfir lahum warhamhum wa 'aafihim wa'fu 'anhum... Rabbanaa aatinaa fid-dunyaa hasanataw-wa fil-aakhirati hasanataw-wa qinaa 'adzaaban-naar...`,
                arti: `Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang. Segala puji bagi Allah Tuhan semesta alam, pujian yang sebanding dengan nikmat-nikmat-Nya dan menjamin tambahannya. Wahai Tuhan kami, bagi-Mu segala puji sebagaimana seyogianya bagi kemuliaan wajah-Mu dan keagungan kekuasaan-Mu. Ya Allah, limpahkanlah rahmat dan keselamatan kepada junjungan kami Nabi Muhammad beserta keluarganya. Ya Allah, terimalah dan sampaikanlah pahala Al-Qur'an yang kami baca, tahlil kami, tasbih kami, istighfar kami, dan shalawat kami kepada junjungan kami Nabi Muhammad SAW sebagai hadiah yang sampai, rahmat yang turun, dan keberkahan yang menyebar... Ya Allah ampunilah mereka, kasihanilah mereka, sejestrakanlah mereka, dan maafkanlah mereka... Ya Tuhan kami, berilah kami kebaikan di dunia dan kebaikan di akhirat, dan peliharalah kami dari siksa neraka...`,
                target: 1,
                fullWidth: true
            }
        ]
    };

    let currentGlobalCount = 0;
    let activeTab = 'pagi';

    function loadProgress(type, index) { return parseInt(localStorage.getItem(`zikir_${type}_${index}`) || 0); }
    function saveProgress(type, index, value) { localStorage.setItem(`zikir_${type}_${index}`, value); }

    function resetAllProgress() {
        if (confirm('Atur ulang seluruh kemajuan hari ini?')) {
            localStorage.clear();
            switchTab(activeTab);
        }
    }

    function incrementProgress(index) {
        const currentItem = zikirData[activeTab][index];
        let current = loadProgress(activeTab, index);

        if (current < currentItem.target) {
            current++;
            saveProgress(activeTab, index, current);
            renderProgress(index, current, currentItem.target);
            if (window.navigator && window.navigator.vibrate) window.navigator.vibrate(50);
        }
    }

    function renderProgress(index, current, target) {
        const card = document.getElementById(`card-${index}`);
        const progressText = document.getElementById(`progress-text-${index}`);
        const progressBar = document.getElementById(`progress-bar-${index}`);

        progressText.innerText = `${current}/${target}`;
        const percent = (current / target) * 100;
        progressBar.style.width = `${percent}%`;

        if (current >= target) { card.classList.add('completed'); }
        else { card.classList.remove('completed'); }
    }

    function switchTab(type) {
        activeTab = type;
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('tab-active'));
        const activeBtn = document.getElementById(`btn-${type}`);
        if (activeBtn) activeBtn.classList.add('tab-active');

        const container = document.getElementById('zikir-container');
        container.innerHTML = '';

        if (zikirData[type]) {
            zikirData[type].forEach((item, index) => {
                const current = loadProgress(type, index);
                const isCompleted = current >= item.target;
                const percent = (current / item.target) * 100;
                const isFullWidth = item.fullWidth ? 'md:col-span-2' : '';

                container.innerHTML += `
                    <div id="card-${index}" onclick="incrementProgress(${index})"
                         class="zikir-card bg-white p-6 border-3 border-on-background neobrutal-shadow rounded-xl animate-fade-in relative overflow-hidden cursor-pointer hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-all ${isFullWidth} ${isCompleted ? 'completed' : ''}">

                        <div class="absolute bottom-0 left-0 h-2 bg-secondary progress-bar" id="progress-bar-${index}" style="width: ${percent}%"></div>

                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <h4 class="font-label-sm text-label-sm uppercase bg-tertiary-fixed text-on-tertiary-fixed-variant border-2 border-on-background px-3 py-1 rounded-lg">${item.title}</h4>
                            <div class="text-right">
                                <span id="progress-text-${index}" class="text-xl font-black block text-primary">${current}/${item.target}</span>
                            </div>
                        </div>

                        <p class="arabic text-3xl font-bold leading-relaxed text-right mb-6 mt-4">${item.arabic}</p>
                        <p class="text-sm font-bold text-secondary leading-relaxed mb-4 italic">${item.latin || ''}</p>
                        <div class="pt-4 border-t-3 border-on-background">
                            <p class="text-xs font-bold text-on-surface-variant leading-relaxed italic">"${item.arti}"</p>
                        </div>
                    </div>
                `;
            });
        }
    }

    let syncTimeout = null;
    let unsyncedCount = 0;

    function toggleTasbih() { document.getElementById('tasbih-container').classList.toggle('hidden'); }
    
    function incrementGlobalCounter() {
        currentGlobalCount++;
        unsyncedCount++;
        document.getElementById('counter-val').innerText = currentGlobalCount;
        if (window.navigator && window.navigator.vibrate) window.navigator.vibrate(50);
        
        // Debounce syncing to database
        clearTimeout(syncTimeout);
        syncTimeout = setTimeout(syncZikirCount, 1500);
    }

    function syncZikirCount() {
        if (unsyncedCount === 0) return;
        
        fetch('{{ route("zikir.sync") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ count: unsyncedCount })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Zikir synced successfully. New total: ' + data.total_zikir);
                unsyncedCount = 0;
                const totalEl = document.getElementById('total-zikir-accumulated');
                if (totalEl) totalEl.innerText = data.total_zikir;
            }
        })
        .catch(err => console.error('Error syncing zikir:', err));
    }

    function resetGlobalCounter() {
        if(confirm('Reset hitungan tasbih global?')) {
            syncZikirCount();
            currentGlobalCount = 0;
            unsyncedCount = 0;
            document.getElementById('counter-val').innerText = currentGlobalCount;
        }
    }

    document.addEventListener('DOMContentLoaded', () => { switchTab('pagi'); });

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
