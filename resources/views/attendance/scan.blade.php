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
    <title>Scan Absensi - Daaru Hiraa</title>
                <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
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
        
        .dark input {
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

    <x-sidebar active="attendance.scan" />

<!-- Main Content Canvas -->
<main class="pt-24 pb-24 md:pl-72 md:pr-10 px-4">
    <div class="max-w-5xl mx-auto">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="bg-secondary-container border-3 border-on-background neobrutal-shadow-sm text-on-secondary-container p-4 rounded-xl mb-6 font-bold flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-error-container border-3 border-on-background neobrutal-shadow-sm text-on-error-container p-4 rounded-xl mb-6 font-bold flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif
        @if(session('info'))
            <div class="bg-tertiary-fixed border-3 border-on-background neobrutal-shadow-sm text-on-tertiary-fixed p-4 rounded-xl mb-6 font-bold flex items-center gap-3">
                <span class="material-symbols-outlined">info</span>
                {{ session('info') }}
            </div>
        @endif

        <!-- Header Section -->
        <section class="mb-10">
            <h2 class="font-headline-lg text-headline-lg mb-2">QR Attendance</h2>
            <p class="text-on-surface-variant font-body-md">Scan QR code yang ditampilkan oleh Muallim untuk mencatat kehadiran Anda.</p>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            
            <!-- Left Column: Scanning Area -->
            <div class="lg:col-span-7 space-y-gutter">
                <!-- QR Area Card -->
                <div class="bg-white border-3 border-on-background rounded-xl p-6 md:p-8 neobrutal-shadow flex flex-col items-center">
                    <div class="w-full flex justify-between items-center mb-6">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-secondary animate-pulse" id="scanner-status-dot"></span>
                            <span class="font-label-sm text-label-sm text-secondary" id="scanner-status-text">Scanner Siap</span>
                        </div>
                        <span class="text-on-surface-variant font-label-sm text-label-sm" id="live-time">{{ date('H:i') }} WIB</span>
                    </div>

                    <!-- Navigation Tabs for Scanner Mode -->
                    <div class="flex w-full mb-6 border-3 border-on-background rounded-xl overflow-hidden bg-surface-variant">
                        <button id="tab-camera" type="button" onclick="switchMode('camera')" class="flex-1 py-3 text-center font-cartoon font-bold bg-primary text-on-primary border-r-3 border-on-background transition-colors focus:outline-none">
                            📷 Kamera
                        </button>
                        <button id="tab-file" type="button" onclick="switchMode('file')" class="flex-1 py-3 text-center font-cartoon font-bold text-on-surface hover:bg-surface-container-high transition-colors focus:outline-none">
                            📁 Upload File
                        </button>
                    </div>

                    <!-- Scanner Viewports -->
                    <div class="w-full flex flex-col items-center">
                        <!-- Mode 1: Camera Scanner -->
                        <div id="camera-scanner-wrapper" class="w-full flex flex-col items-center">
                            <!-- Styled Container for Reader -->
                            <div class="relative w-full aspect-square max-w-[340px] bg-secondary-container border-3 border-on-background rounded-xl overflow-hidden mb-6 p-2 neobrutal-shadow-sm">
                                <div id="reader" class="w-full h-full bg-black rounded-lg overflow-hidden border-2 border-on-background"></div>
                                
                                <!-- Placeholder Overlay when camera is off -->
                                <div id="reader-placeholder" class="absolute inset-2 bg-white flex flex-col items-center justify-center text-center p-4">
                                    <span class="material-symbols-outlined text-[90px] text-primary mb-3">qr_code_scanner</span>
                                    <p class="font-bold text-sm text-on-background mb-1">Kamera Dinonaktifkan</p>
                                    <p class="text-xs text-on-surface-variant max-w-[200px]">Aktifkan kamera untuk memindai kode QR dari layar Muallim.</p>
                                </div>
                            </div>
                            
                            <!-- Start / Stop Button -->
                            <button id="btn-toggle-camera" type="button" onclick="toggleCamera()" class="w-full max-w-[340px] py-4 bg-secondary text-on-secondary font-headline-md text-headline-md border-3 border-on-background neobrutal-shadow neobrutal-shadow-active transition-all rounded-lg mb-6 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">videocam</span>
                                <span>Mulai Kamera</span>
                            </button>
                        </div>

                        <!-- Mode 2: File Upload Scanner -->
                        <div id="file-scanner-wrapper" class="w-full hidden flex flex-col items-center">
                            <div class="w-full max-w-[340px] aspect-square bg-secondary-container border-3 border-on-background rounded-xl p-4 mb-6 neobrutal-shadow-sm flex flex-col items-center justify-center relative cursor-pointer group hover:bg-secondary-container/80 transition-colors" onclick="document.getElementById('qr-image-input').click()">
                                <input type="file" id="qr-image-input" accept="image/*" class="hidden">
                                <div class="w-full h-full border-3 border-dashed border-on-background flex flex-col items-center justify-center bg-white rounded-lg p-4 text-center">
                                    <span class="material-symbols-outlined text-[80px] text-primary mb-2 group-hover:scale-105 transition-transform">cloud_upload</span>
                                    <p class="font-bold text-sm text-on-background mb-1">Pilih Gambar QR</p>
                                    <p class="text-[10px] text-on-surface-variant max-w-[200px]">Klik untuk mencari gambar tangkapan layar/foto QR absensi.</p>
                                    
                                    <!-- Image Preview Container -->
                                    <img id="qr-image-preview" class="hidden max-h-[140px] rounded-lg mt-3 border-2 border-on-background object-contain">
                                </div>
                            </div>

                            <button type="button" onclick="document.getElementById('qr-image-input').click()" class="w-full max-w-[340px] py-4 bg-secondary text-on-secondary font-headline-md text-headline-md border-3 border-on-background neobrutal-shadow neobrutal-shadow-active transition-all rounded-lg mb-6 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">attach_file</span>
                                <span>Unggah Gambar</span>
                            </button>
                        </div>
                    </div>

                    <!-- Hidden Form to process scanner result -->
                    <form id="attendance-form" action="{{ route('attendance.process') }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="qr_token" id="qr-token-input">
                    </form>

                    <!-- Manual Input Fallback -->
                    <div class="w-full border-t-3 border-on-background pt-6 mt-2">
                        <div class="flex justify-center">
                            <button type="button" onclick="toggleManualInput()" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">keyboard</span>
                                <span>Input token secara manual</span>
                            </button>
                        </div>

                        <form id="manual-scan-form" action="{{ route('attendance.process') }}" method="POST" class="w-full mt-4 hidden">
                            @csrf
                            <div class="flex flex-col gap-2">
                                <label class="font-label-sm text-primary">Masukkan Token Presensi</label>
                                <div class="flex gap-2">
                                    <input type="text" name="qr_token" required placeholder="Contoh: KAJIAN-ABC-123" class="flex-1 bg-surface border-3 border-on-background px-4 py-2.5 rounded-lg focus:outline-none focus:ring-0">
                                    <button type="submit" class="px-5 py-2.5 bg-primary text-on-primary font-bold border-3 border-on-background neobrutal-shadow-active transition-all rounded-lg">
                                        Proses
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Disclaimer -->
                <div class="bg-tertiary-fixed border-3 border-on-background rounded-xl p-6 neobrutal-shadow-sm flex gap-4">
                    <span class="material-symbols-outlined text-tertiary text-3xl">security</span>
                    <div>
                        <h4 class="font-label-sm text-label-sm text-tertiary mb-1">Dynamic Security Token</h4>
                        <p class="text-body-md text-tertiary/80 leading-snug">Token absen diperbarui setiap 30 detik. Tangkapan layar atau foto kode QR tidak akan valid. Pastikan memindai langsung dari layar Muallim.</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Selector & History -->
            <div class="lg:col-span-5 space-y-gutter">
                <!-- Session Selector Card -->
                <div class="bg-white border-3 border-on-background rounded-xl p-6 neobrutal-shadow-sm">
                    <h3 class="font-headline-md text-headline-md mb-4">Pilih Sesi</h3>
                    <div class="space-y-3">
                        @php
                            $now = \Carbon\Carbon::now();
                            $hour = $now->hour;
                            
                            $kajianActive = ($hour >= 18 && $hour <= 21);
                            $subuhActive = ($hour >= 4 && $hour <= 6);
                            $tahsinActive = ($hour >= 15 && $hour <= 17);
                        @endphp
                        
                        <!-- Kajian Malam -->
                        <div class="flex items-center justify-between p-4 {{ $kajianActive ? 'bg-secondary-container border-on-background neobrutal-shadow-sm' : 'bg-surface border-transparent hover:border-on-background opacity-60' }} border-3 rounded-lg transition-all cursor-pointer">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined {{ $kajianActive ? 'bg-on-secondary-container text-white' : 'bg-surface-container-high' }} p-2 rounded-md">nights_stay</span>
                                <div>
                                    <p class="font-bold">Kajian Malam</p>
                                    <p class="text-xs {{ $kajianActive ? 'text-on-secondary-container' : 'text-on-surface-variant' }}">{{ $kajianActive ? 'Aktif • Masjid Utama' : 'Dijadwalkan • 18:00 WIB' }}</p>
                                </div>
                            </div>
                            @if($kajianActive)
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            @endif
                        </div>
                        
                        <!-- Jamaah Subuh -->
                        <div class="flex items-center justify-between p-4 {{ $subuhActive ? 'bg-secondary-container border-on-background neobrutal-shadow-sm' : 'bg-surface border-transparent hover:border-on-background opacity-60' }} border-3 rounded-lg transition-all cursor-pointer">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined {{ $subuhActive ? 'bg-on-secondary-container text-white' : 'bg-surface-container-high' }} p-2 rounded-md">light_mode</span>
                                <div>
                                    <p class="font-bold">Jamaah Subuh</p>
                                    <p class="text-xs {{ $subuhActive ? 'text-on-secondary-container' : 'text-on-surface-variant' }}">{{ $subuhActive ? 'Aktif • Masjid Utama' : 'Dijadwalkan • 04:30 WIB' }}</p>
                                </div>
                            </div>
                            @if($subuhActive)
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            @endif
                        </div>
                        
                        <!-- Tahsin -->
                        <div class="flex items-center justify-between p-4 {{ $tahsinActive ? 'bg-secondary-container border-on-background neobrutal-shadow-sm' : 'bg-surface border-transparent hover:border-on-background opacity-60' }} border-3 rounded-lg transition-all cursor-pointer">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined {{ $tahsinActive ? 'bg-on-secondary-container text-white' : 'bg-surface-container-high' }} p-2 rounded-md">menu_book</span>
                                <div>
                                    <p class="font-bold">Tahsin</p>
                                    <p class="text-xs {{ $tahsinActive ? 'text-on-secondary-container' : 'text-on-surface-variant' }}">{{ $tahsinActive ? 'Aktif • Kelas A' : 'Dijadwalkan • 15:30 WIB' }}</p>
                                </div>
                            </div>
                            @if($tahsinActive)
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- History List -->
                <div class="bg-white border-3 border-on-background rounded-xl overflow-hidden neobrutal-shadow-sm">
                    <div class="p-4 border-b-3 border-on-background bg-surface-container flex justify-between items-center">
                        <h3 class="font-headline-md text-headline-md">Riwayat Scan</h3>
                        <span class="material-symbols-outlined text-primary">history</span>
                    </div>
                    
                    <div class="divide-y-3 divide-on-background">
                        @php
                            $historyLogs = auth()->user()->attendanceLogs()->orderBy('attendance_date', 'desc')->orderBy('attendance_time', 'desc')->limit(5)->get();
                        @endphp
                        
                        @forelse($historyLogs as $log)
                            <div class="p-4 flex justify-between items-center bg-white">
                                <div>
                                    <p class="font-bold">{{ $log->session_type }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ \Carbon\Carbon::parse($log->attendance_date)->isoFormat('D MMM Y') }} • {{ \Carbon\Carbon::parse($log->attendance_time)->format('H:i') }}</p>
                                </div>
                                @if($log->status == 'H')
                                    <div class="px-3 py-1 bg-secondary-fixed text-on-secondary-fixed border-2 border-on-background rounded-full font-label-sm text-label-sm">Hadir</div>
                                @elseif($log->status == 'I')
                                    <div class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed border-2 border-on-background rounded-full font-label-sm text-label-sm">Izin</div>
                                @else
                                    <div class="px-3 py-1 bg-error-container text-on-error-container border-2 border-on-background rounded-full font-label-sm text-label-sm">Alpha</div>
                                @endif
                            </div>
                        @empty
                            <div class="p-6 text-center bg-white">
                                <span class="material-symbols-outlined text-4xl text-outline-variant mb-2">history_toggle_off</span>
                                <p class="text-on-surface-variant font-medium">Belum ada riwayat absensi.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- BottomNavBar Removed -->

<script>
    // Live Clock functionality
    setInterval(() => {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';
        const liveTimeEl = document.getElementById('live-time');
        if (liveTimeEl) liveTimeEl.innerText = timeString;
    }, 1000);

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

    // HTML5-QRCode Scanner Logic
    let activeMode = 'camera';
    let html5QrCode = null;
    let cameraRunning = false;

    // Switch between Camera scan and File Upload scan modes
    function switchMode(mode) {
        if (mode === activeMode) return;
        activeMode = mode;

        const tabCamera = document.getElementById('tab-camera');
        const tabFile = document.getElementById('tab-file');
        const cameraWrapper = document.getElementById('camera-scanner-wrapper');
        const fileWrapper = document.getElementById('file-scanner-wrapper');
        const statusDot = document.getElementById('scanner-status-dot');
        const statusText = document.getElementById('scanner-status-text');

        if (mode === 'camera') {
            tabCamera.className = "flex-1 py-3 text-center font-cartoon font-bold bg-primary text-on-primary border-r-3 border-on-background transition-colors focus:outline-none";
            tabFile.className = "flex-1 py-3 text-center font-cartoon font-bold text-on-surface hover:bg-surface-container-high transition-colors focus:outline-none";
            cameraWrapper.classList.remove('hidden');
            fileWrapper.classList.add('hidden');
            statusDot.className = "w-3 h-3 rounded-full bg-secondary animate-pulse";
            statusText.innerText = cameraRunning ? "Scanner Aktif" : "Scanner Siap";
        } else {
            // Stop camera if running
            if (cameraRunning) {
                stopCamera();
            }
            tabCamera.className = "flex-1 py-3 text-center font-cartoon font-bold text-on-surface hover:bg-surface-container-high border-r-3 border-on-background transition-colors focus:outline-none";
            tabFile.className = "flex-1 py-3 text-center font-cartoon font-bold bg-primary text-on-primary transition-colors focus:outline-none";
            cameraWrapper.classList.add('hidden');
            fileWrapper.classList.remove('hidden');
            statusDot.className = "w-3 h-3 rounded-full bg-amber-500 animate-pulse";
            statusText.innerText = "Upload File";
        }
    }

    // Toggle camera start/stop
    function toggleCamera() {
        if (cameraRunning) {
            stopCamera();
        } else {
            startCamera();
        }
    }

    function startCamera() {
        if (!html5QrCode) {
            html5QrCode = new Html5Qrcode("reader");
        }

        const btn = document.getElementById('btn-toggle-camera');
        const placeholder = document.getElementById('reader-placeholder');
        const statusDot = document.getElementById('scanner-status-dot');
        const statusText = document.getElementById('scanner-status-text');

        placeholder.classList.add('hidden');
        btn.innerHTML = `<span class="material-symbols-outlined animate-spin">sync</span><span>Memulai...</span>`;
        btn.disabled = true;

        // Start scanning
        html5QrCode.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: (width, height) => {
                    return { width: Math.min(width * 0.7, 250), height: Math.min(height * 0.7, 250) };
                }
            },
            onScanSuccess,
            onScanFailure
        ).then(() => {
            cameraRunning = true;
            btn.innerHTML = `<span class="material-symbols-outlined">videocam_off</span><span>Stop Kamera</span>`;
            btn.className = "w-full max-w-[340px] py-4 bg-error-container text-on-error-container font-headline-md text-headline-md border-3 border-on-background neobrutal-shadow neobrutal-shadow-active transition-all rounded-lg mb-6 flex items-center justify-center gap-2";
            btn.disabled = false;
            statusDot.className = "w-3 h-3 rounded-full bg-emerald-500 animate-pulse";
            statusText.innerText = "Scanner Aktif";
        }).catch(err => {
            console.error("Camera access failed: ", err);
            placeholder.classList.remove('hidden');
            btn.innerHTML = `<span class="material-symbols-outlined">videocam</span><span>Mulai Kamera</span>`;
            btn.className = "w-full max-w-[340px] py-4 bg-secondary text-on-secondary font-headline-md text-headline-md border-3 border-on-background neobrutal-shadow neobrutal-shadow-active transition-all rounded-lg mb-6 flex items-center justify-center gap-2";
            btn.disabled = false;
            alert("Gagal mengakses kamera. Pastikan izin kamera telah diberikan.");
        });
    }

    function stopCamera() {
        if (!html5QrCode || !cameraRunning) return;

        const btn = document.getElementById('btn-toggle-camera');
        const placeholder = document.getElementById('reader-placeholder');
        const statusDot = document.getElementById('scanner-status-dot');
        const statusText = document.getElementById('scanner-status-text');

        btn.innerHTML = `<span class="material-symbols-outlined animate-spin">sync</span><span>Menghentikan...</span>`;
        btn.disabled = true;

        html5QrCode.stop().then(() => {
            cameraRunning = false;
            placeholder.classList.remove('hidden');
            btn.innerHTML = `<span class="material-symbols-outlined">videocam</span><span>Mulai Kamera</span>`;
            btn.className = "w-full max-w-[340px] py-4 bg-secondary text-on-secondary font-headline-md text-headline-md border-3 border-on-background neobrutal-shadow neobrutal-shadow-active transition-all rounded-lg mb-6 flex items-center justify-center gap-2";
            btn.disabled = false;
            statusDot.className = "w-3 h-3 rounded-full bg-secondary animate-pulse";
            statusText.innerText = "Scanner Siap";
        }).catch(err => {
            console.error("Gagal menghentikan kamera: ", err);
        });
    }

    function onScanSuccess(decodedText, decodedResult) {
        // Success scan! Stop camera and submit form
        if (cameraRunning) {
            stopCamera();
        }
        submitToken(decodedText);
    }

    function onScanFailure(error) {
        // Quietly fail as it scans continuously
    }

    function submitToken(token) {
        const input = document.getElementById('qr-token-input');
        const form = document.getElementById('attendance-form');
        input.value = token;
        form.submit();
    }

    // File Upload Scanning Logic
    const fileInput = document.getElementById('qr-image-input');
    const imgPreview = document.getElementById('qr-image-preview');

    fileInput.addEventListener('change', e => {
        if (e.target.files.length === 0) return;

        const file = e.target.files[0];
        
        // Show image preview
        const reader = new FileReader();
        reader.onload = function(event) {
            imgPreview.src = event.target.result;
            imgPreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);

        // Instantiate scanner for file if not created
        const fileScanner = new Html5Qrcode("reader");

        // Scan file
        fileScanner.scanFile(file, true)
            .then(decodedText => {
                submitToken(decodedText);
            })
            .catch(err => {
                console.error("QR Code not found in image: ", err);
                alert("❌ QR Code tidak ditemukan di dalam gambar. Silakan coba unggah gambar yang lebih jelas.");
            });
    });

    // Toggle Manual Input Form
    function toggleManualInput() {
        const form = document.getElementById('manual-scan-form');
        form.classList.toggle('hidden');
    }
</script>

<x-calendar-modal />

</body>
</html>
