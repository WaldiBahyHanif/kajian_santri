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
    <title>Refleksi Harian - Daaru Hiraa</title>
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

        .neobrutal-shadow-active:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px rgba(var(--neobrutal-shadow-color), 1);
        }

        .neobrutal-shadow-none:active {
            transform: translate(6px, 6px);
            box-shadow: none;
        }

        .border-3 {
            border-width: 3px;
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

        <!-- Profile & Notification Area (Visible on Desktop & Mobile) -->
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

    <x-sidebar active="refleksi" />

<!-- Main Content Canvas -->
<main class="pt-24 pb-24 md:pl-72 md:pr-10 px-4">
    <div class="max-w-5xl mx-auto space-y-8">
        
        <!-- Header -->
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                @php
                    $firstName = explode(' ', auth()->user()->name)[0];
                    \Carbon\Carbon::setLocale('id');
                @endphp
                <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary tracking-tight">Refleksi Harian</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">Tuliskan refleksi harianmu, evaluasi diri, dan syukuri nikmat Allah hari ini.</p>
            </div>
            <div class="flex items-center gap-2 bg-tertiary-fixed border-2 border-on-background px-4 py-2 rounded-lg neobrutal-shadow-sm">
                <span class="material-symbols-outlined text-tertiary">edit_note</span>
                <span class="font-label-sm text-label-sm text-tertiary">{{ $reflections->count() }} Refleksi</span>
            </div>
        </section>

        <!-- Alerts -->
        @if(session('success'))
            <div class="bg-secondary-container border-3 border-on-background neobrutal-shadow-sm text-on-secondary-container p-4 rounded-xl font-bold flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-error-container border-3 border-on-background neobrutal-shadow-sm text-on-error-container p-4 rounded-xl font-bold flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-error-container border-3 border-on-background neobrutal-shadow-sm text-on-error-container p-4 rounded-xl font-bold flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif

        <!-- Write Reflection Form -->
        <section class="bg-white border-3 border-on-background rounded-xl p-6 neobrutal-shadow">
            <form action="{{ route('refleksi.store') }}" method="POST">
                @csrf
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-symbols-outlined text-3xl text-primary p-2 bg-secondary-container border-2 border-on-background rounded-lg" style="font-variation-settings:'FILL' 1;">edit_note</span>
                    <div>
                        <h3 class="font-headline-md text-headline-md text-primary">Tulis Refleksi Hari Ini</h3>
                        <p class="font-label-sm text-label-sm text-on-surface-variant">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                </div>

                @if($alreadyAttendedToday)
                    <div class="flex items-center gap-2 bg-secondary-container border-2 border-on-background text-on-secondary-container px-3 py-2 rounded-lg text-xs font-bold mb-4">
                        <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1;">check_circle</span>
                        Kamu sudah absen Kajian Pagi hari ini. Refleksi ini akan tersimpan sebagai jurnal tambahan.
                    </div>
                @elseif($isWithinAttendanceWindow ?? false)
                    <div class="flex items-center gap-2 bg-secondary-container border-2 border-on-background text-on-secondary-container px-3 py-2 rounded-lg text-xs font-bold mb-4">
                        <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1;">schedule</span>
                        Absen Kajian Pagi via refleksi aktif sampai pukul 07:00 WIB. Isi refleksi sekarang untuk otomatis tercatat Hadir!
                    </div>
                @else
                    <div class="flex items-center gap-2 bg-tertiary-fixed border-2 border-on-background text-on-tertiary-fixed px-3 py-2 rounded-lg text-xs font-bold mb-4">
                        <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1;">info</span>
                        Batas absen via refleksi (07:00 WIB) telah lewat. Kamu tetap bisa menulis refleksi harian, namun tidak dihitung sebagai absen kehadiran.
                    </div>
                @endif

                <div class="mb-4">
                    <label class="font-label-sm text-label-sm text-on-surface-variant mb-1 block">Kitab yang dikaji hari ini</label>
                    @if($todayTopic)
                        <select disabled class="w-full bg-surface border-3 border-on-background px-4 py-3 rounded-lg font-bold text-on-background opacity-80">
                            <option>{{ $todayTopic->title }}</option>
                        </select>
                        <input type="hidden" name="topic_id" value="{{ $todayTopic->id }}">
                    @else
                        <div class="flex items-center gap-2 bg-error-container border-2 border-on-background text-on-error-container px-3 py-2 rounded-lg text-xs font-bold">
                            <span class="material-symbols-outlined text-base">info</span>
                            Belum ada topic kajian pagi terjadwal untuk hari ini. Refleksi belum bisa disimpan — hubungi admin.
                        </div>
                    @endif
                </div>

                <textarea name="content" rows="5" @disabled(!$todayTopic) class="w-full bg-surface border-3 border-on-background px-4 py-3 rounded-lg focus:outline-none focus:ring-0 font-body-md resize-none disabled:opacity-60" placeholder="Apa yang kamu syukuri hari ini? Apa yang ingin kamu perbaiki? Tulis refleksi singkatmu di sini..."></textarea>
                <div class="flex justify-between items-center mt-4">
                    <span class="font-label-sm text-label-sm text-on-surface-variant" id="char-count">0 / 2000 karakter (minimal 1 kalimat, &plusmn;10 karakter)</span>
                    <button type="submit" @disabled(!$todayTopic) class="bg-primary text-on-primary border-3 border-on-background neobrutal-shadow-active px-6 py-3 rounded-lg font-bold transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        Simpan Refleksi
                    </button>
                </div>
            </form>
        </section>

        <!-- Reflection Prompts -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-tertiary-fixed border-3 border-on-background rounded-xl p-4 neobrutal-shadow-sm">
                <span class="material-symbols-outlined text-2xl text-tertiary mb-2" style="font-variation-settings:'FILL' 1;">volunteer_activism</span>
                <h4 class="font-bold text-tertiary text-sm">Syukur Hari Ini</h4>
                <p class="text-xs text-tertiary/80 mt-1">Apa nikmat terbesar yang kamu rasakan hari ini?</p>
            </div>
            <div class="bg-primary-fixed-dim border-3 border-on-background rounded-xl p-4 neobrutal-shadow-sm">
                <span class="material-symbols-outlined text-2xl text-primary mb-2" style="font-variation-settings:'FILL' 1;">psychology</span>
                <h4 class="font-bold text-primary text-sm">Evaluasi Diri</h4>
                <p class="text-xs text-primary/80 mt-1">Apa yang bisa kamu perbaiki dari hari ini?</p>
            </div>
            <div class="bg-secondary-container border-3 border-on-background rounded-xl p-4 neobrutal-shadow-sm">
                <span class="material-symbols-outlined text-2xl text-on-secondary-container mb-2" style="font-variation-settings:'FILL' 1;">flag</span>
                <h4 class="font-bold text-on-secondary-container text-sm">Target Besok</h4>
                <p class="text-xs text-on-secondary-container/80 mt-1">Apa yang ingin kamu capai besok?</p>
            </div>
        </section>

        <!-- Reflection History -->
        <section>
            <h3 class="font-headline-md text-headline-md text-primary mb-6">Riwayat Refleksi</h3>
            <div class="space-y-4">
                @forelse($reflections as $reflection)
                    <div class="bg-white border-3 border-on-background rounded-xl p-6 neobrutal-shadow-sm hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-all">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">event</span>
                                <span class="font-label-sm text-label-sm text-on-surface-variant font-bold">
                                    {{ \Carbon\Carbon::parse($reflection->created_at)->isoFormat('dddd, D MMMM Y') }}
                                </span>
                                @if($reflection->topic)
                                    <span class="inline-flex items-center gap-1 bg-tertiary-fixed border-2 border-on-background text-tertiary px-2 py-0.5 rounded-md text-[10px] font-bold">
                                        <span class="material-symbols-outlined text-xs">menu_book</span>
                                        {{ $reflection->topic->title }}
                                    </span>
                                @endif
                            </div>
                            <form method="POST" action="{{ route('refleksi.destroy', $reflection->id) }}" onsubmit="return confirm('Yakin ingin menghapus refleksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-error hover:bg-error-container p-1 rounded transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                        <p class="font-body-md text-body-md text-on-surface whitespace-pre-wrap leading-relaxed">{{ $reflection->content }}</p>
                        <div class="mt-4 pt-3 border-t-2 border-on-background/10 flex items-center gap-2 text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">schedule</span>
                            <span class="font-label-sm text-label-sm">{{ \Carbon\Carbon::parse($reflection->created_at)->format('H:i') }} WIB</span>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center p-12 bg-surface border-3 border-on-background border-dashed rounded-xl">
                        <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">auto_stories</span>
                        <p class="font-bold text-on-surface-variant text-center">Belum ada refleksi. Mulai tulis refleksi pertamamu di atas!</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</main>

<script>
// Character counter for textarea
const textarea = document.querySelector('textarea[name="content"]');
const charCount = document.getElementById('char-count');
if (textarea && charCount) {
    textarea.addEventListener('input', function() {
        charCount.textContent = this.value.length + ' / 2000 karakter';
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
    sidebarClose.addEventListener('click', sidebarClose);
}
if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', sidebarClose);
}
</script>

<x-calendar-modal />

</body>
</html>
