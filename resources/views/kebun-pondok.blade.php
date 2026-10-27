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
    <title>Kebun Pondok - Daaru Hiraa</title>
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
            --outline: #94a3b8;
            --surface-dim: #151515;
            --on-tertiary-fixed: #ffdf9f;
            --secondary-fixed: #1b6b4f;
            --surface-container-low: #1e1e1e;
            --on-error: #ffffff;
            --error: #f87171;
            --on-surface: #f1f1f1;
            --inverse-surface: #eeeeee;
            --neobrutal-shadow-color: 0, 0, 0;
            --neobrutal-border-color: #ffffff;
        }

        body {
            font-family: 'Space Grotesk', 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--on-background);
        }

        .neobrutal-shadow {
            box-shadow: 6px 6px 0px 0px rgba(var(--neobrutal-shadow-color), 1);
        }

        .neobrutal-shadow-sm {
            box-shadow: 4px 4px 0px 0px rgba(var(--neobrutal-shadow-color), 1);
        }

        .border-3 {
            border-width: 3px;
        }

        .font-pixel {
            font-family: 'Press Start 2P', monospace;
        }

        .garden-plot {
            background-color: #86EFAC;
        }
        .dark .garden-plot {
            background-color: #065f46;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Press+Start+2P&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background font-body-md min-h-screen">

<!-- TopAppBar Shell -->
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 md:px-margin-desktop py-4 bg-surface border-b-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
    <div class="flex items-center gap-2">
        <a href="{{ url('/') }}" class="font-headline-md text-headline-md font-black text-primary tracking-tighter hover:opacity-80">Daaru Hiraa</a>
    </div>
    <div class="flex items-center gap-3">
        <button id="theme-toggle" class="flex items-center justify-center w-12 h-12 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer text-on-background" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-2xl block dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-2xl hidden dark:block">light_mode</span>
        </button>
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

<x-sidebar active="kebun.index" />

<!-- Main Content Canvas -->
<main class="pt-24 pb-24 md:pl-72 md:pr-10 px-4">
    <div class="max-w-6xl mx-auto space-y-6">

        <!-- Header -->
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary tracking-tight">Kebun Pondok 🌳</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">Setiap santri punya pohon kebaikannya sendiri. Rutin hadir kajian pagi, pohonmu makin subur!</p>
            </div>
            <div class="flex items-center gap-2 bg-tertiary-fixed border-2 border-on-background px-4 py-2 rounded-lg neobrutal-shadow-sm shrink-0">
                <span class="material-symbols-outlined text-tertiary">park</span>
                <span class="font-label-sm text-label-sm text-tertiary">{{ $students->count() }} Pohon Santri</span>
            </div>
        </section>

        <!-- Search -->
        <section>
            <div class="relative max-w-sm">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input type="text" id="kebun-search" placeholder="Cari nama santri..." class="w-full bg-white border-3 border-on-background pl-10 pr-4 py-2.5 rounded-lg focus:outline-none focus:ring-0 font-bold text-sm">
            </div>
        </section>

        <!-- Garden Grid -->
        <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="kebun-grid">
            @foreach($students as $student)
                <div class="kebun-plot-card flex flex-col items-center" data-name="{{ strtolower($student->name) }}">
                    <div class="garden-plot w-full aspect-square border-3 border-on-background rounded-xl neobrutal-shadow-sm flex items-center justify-center overflow-hidden relative p-2">
                        <x-pixel-tree :stage="$student->garden_stage" class="w-full h-full select-none pointer-events-none" />
                    </div>
                    <div class="mt-2 w-full bg-white border-2 border-on-background rounded-lg px-2 py-1.5 text-center neobrutal-shadow-sm">
                        <p class="font-pixel text-[9px] leading-tight text-on-background truncate" title="{{ $student->name }}">{{ $student->name }}</p>
                    </div>
                </div>
            @endforeach
        </section>

        <p id="kebun-empty-state" class="hidden text-center text-sm font-bold text-on-surface-variant py-10">Tidak ada santri dengan nama tersebut.</p>
    </div>
</main>

<script>
// Search filter
const kebunSearch = document.getElementById('kebun-search');
const kebunCards = document.querySelectorAll('.kebun-plot-card');
const kebunEmptyState = document.getElementById('kebun-empty-state');

if (kebunSearch) {
    kebunSearch.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();
        let visibleCount = 0;
        kebunCards.forEach(function (card) {
            const match = card.getAttribute('data-name').includes(query);
            card.classList.toggle('hidden', !match);
            if (match) visibleCount++;
        });
        kebunEmptyState.classList.toggle('hidden', visibleCount > 0);
    });
}

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
if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', closeSidebar);
}
</script>

</body>
</html>
