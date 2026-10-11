<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - Admin Daaru Hiraa</title>
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#003527">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Daaru Hiraa Admin">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Space Grotesk', sans-serif; }
        .admin-sidebar::-webkit-scrollbar { width: 6px; }
        .admin-sidebar::-webkit-scrollbar-thumb { background: #000; border-radius: 3px; }
        .nav-item { transition: all 0.15s ease; }
        .nav-item:hover { transform: translateX(4px); }
        .nav-item.active { background: #000; color: #fff; }

        /* Dark Mode Overrides for Admin Panel */
        .dark body {
            background-color: #121212 !important;
            color: #f1f5f9 !important;
        }

        .dark header {
            background-color: #1a1a1a !important;
            border-color: #ffffff !important;
            color: #ffffff !important;
        }

        .dark header h2, .dark header span {
            color: #ffffff !important;
        }

        .dark aside {
            background-color: #1a1a1a !important;
            border-color: #ffffff !important;
        }

        .dark aside .logo-box {
            background-color: #ffffff !important;
            color: #000000 !important;
        }

        .dark .admin-sidebar::-webkit-scrollbar-thumb {
            background: #ffffff !important;
        }

        /* Sidebar navigation */
        .dark .nav-item {
            color: #cbd5e1 !important;
        }

        .dark .nav-item:hover {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
        }

        .dark .nav-item.active {
            background: #ffffff !important;
            color: #000000 !important;
            border-color: #ffffff !important;
        }

        /* Neobrutalist Cards, Lists, Tables and headers */
        .dark .bg-white {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
        }

        .dark .border-black {
            border-color: #ffffff !important;
        }

        .dark .border-2.border-black {
            border-color: #ffffff !important;
        }

        .dark .border-4.border-black {
            border-color: #ffffff !important;
        }

        .dark .border-b-4.border-black {
            border-color: #ffffff !important;
        }

        .dark .border-r-4.border-black {
            border-color: #ffffff !important;
        }

        .dark .border-t-4.border-black {
            border-color: #ffffff !important;
        }

        .dark .border-l-black { border-left-color: #ffffff !important; }
        .dark .border-r-black { border-right-color: #ffffff !important; }
        .dark .border-t-black { border-top-color: #ffffff !important; }
        .dark .border-b-black { border-bottom-color: #ffffff !important; }

        .dark .shadow-\[2px_2px_0_0_\#000\] {
            box-shadow: 2px 2px 0 0 #ffffff !important;
        }

        .dark .shadow-\[4px_4px_0_0_\#000\] {
            box-shadow: 4px 4px 0 0 #ffffff !important;
        }

        .dark .shadow-\[6px_6px_0_0_\#000\] {
            box-shadow: 6px 6px 0 0 #ffffff !important;
        }

        .dark .shadow-\[8px_8px_0_0_\#000\] {
            box-shadow: 8px 8px 0 0 #ffffff !important;
        }

        .dark .shadow-\[4px_4px_0_0_\#4f46e5\] {
            box-shadow: 4px 4px 0 0 #ffffff !important;
        }

        .dark .shadow-\[4px_4px_0_0_\#facc15\] {
            box-shadow: 4px 4px 0 0 #ffffff !important;
        }

        .dark .shadow-\[4px_4px_0_0_\#FFDE00\] {
            box-shadow: 4px 4px 0 0 #ffffff !important;
        }
        
        .dark .shadow-\[2px_2px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 2px 2px 0 0 #ffffff !important;
        }
        
        .dark .shadow-\[4px_4px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 4px 4px 0 0 #ffffff !important;
        }
        
        .dark .shadow-\[6px_6px_0px_0px_rgba\(0\2c 0\2c 0\2c 1\)\] {
            box-shadow: 6px 6px 0 0 #ffffff !important;
        }

        /* Form inputs & elements */
        .dark input, 
        .dark select, 
        .dark textarea {
            background-color: #242424 !important;
            color: #ffffff !important;
            border-color: #4a5568 !important;
        }

        .dark input:focus, 
        .dark select:focus, 
        .dark textarea:focus {
            border-color: #39FF14 !important;
            box-shadow: 0 0 0 3px rgba(57, 255, 20, 0.2) !important;
        }

        .dark input::placeholder, 
        .dark textarea::placeholder {
            color: #64748b !important;
        }

        /* Inner elements / backgrounds */
        .dark .bg-gray-50 {
            background-color: #242427 !important;
            color: #ffffff !important;
        }

        .dark .bg-gray-100 {
            background-color: #27272a !important;
            color: #ffffff !important;
        }
        
        .dark .bg-black {
            background-color: #27272a !important;
            color: #ffffff !important;
            border-color: #ffffff !important;
        }

        .dark .bg-yellow-50 {
            background-color: #2e2612 !important;
            color: #ffdf9f !important;
            border-color: #f9bd22 !important;
        }

        .dark .hover\:bg-yellow-50:hover {
            background-color: #2e2612 !important;
        }

        .dark .bg-red-50 {
            background-color: #2a1215 !important;
            color: #fca5a5 !important;
        }
        .dark .bg-red-100 {
            background-color: #3f171d !important;
            color: #fca5a5 !important;
        }
        .dark .border-red-200 {
            border-color: #ef4444 !important;
        }

        .dark .text-gray-500 {
            color: #94a3b8 !important;
        }

        .dark .text-gray-600 {
            color: #cbd5e1 !important;
        }

        .dark .text-gray-400 {
            color: #64748b !important;
        }

        .dark .text-black {
            color: #ffffff !important;
        }

        .dark .text-gray-900 {
            color: #f1f5f9 !important;
        }

        .dark .text-gray-800 {
            color: #e2e8f0 !important;
        }

        .dark .text-gray-700 {
            color: #cbd5e1 !important;
        }

        .dark .text-red-600 {
            color: #f87171 !important;
        }

        .dark .text-emerald-600 {
            color: #4ade80 !important;
        }

        .dark .border-gray-200 {
            border-color: #3f3f46 !important;
        }

        .dark .border-gray-300 {
            border-color: #4a5568 !important;
        }

        .dark .border-transparent {
            border-color: transparent !important;
        }

        .dark .bg-\[\#F0F0F0\], .dark body {
            background-color: #121212 !important;
        }
    </style>
</head>
<body class="bg-[#F0F0F0] min-h-screen" x-data="{ sidebarOpen: false }">

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-black/60 z-40 lg:hidden"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="admin-sidebar fixed top-0 left-0 z-50 w-72 h-screen bg-white border-r-4 border-black overflow-y-auto lg:translate-x-0 transition-transform duration-300">
        <!-- Logo -->
        <div class="p-5 border-b-4 border-black bg-black text-white">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#FFDE00] border-2 border-white flex items-center justify-center font-black text-black text-lg">KS</div>
                <div>
                    <h1 class="font-black text-lg uppercase tracking-tight">Admin Panel</h1>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Daaru Hiraa</p>
                </div>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="p-3 space-y-1">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 pt-3 pb-1">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'dashboard' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('admin.ai.assistant') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'ai-assistant' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">smart_toy</span>
                Asisten AI Admin
            </a>

            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 pt-4 pb-1">Data Master</p>

            <a href="{{ route('admin.santri.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'santri' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">group</span>
                Kelola Santri
            </a>
            <a href="{{ route('admin.asatiz.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'asatiz' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">person</span>
                Kelola Ustadz
            </a>
            <a href="{{ route('admin.kajian.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ in_array($active, ['kajian', 'program-kajian', 'materi', 'topik']) ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">calendar_month</span>
                Kelola Kajian
            </a>

            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 pt-4 pb-1">Kehadiran</p>

            <a href="{{ route('admin.attendance.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'attendance' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">checklist</span>
                Input Absensi
            </a>
            <a href="{{ route('admin.liqo.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'liqo' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">diversity_3</span>
                Kelola Liqo
            </a>
            <a href="{{ route('admin.qr.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'qr' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">qr_code</span>
                QR Generator
            </a>
            <a href="{{ route('admin.sp.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'sp' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">warning</span>
                Surat Peringatan (SP)
            </a>

            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 pt-4 pb-1">Monitoring</p>

            <a href="{{ route('admin.refleksi.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'refleksi' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">edit_note</span>
                Refleksi Santri
            </a>
            <a href="{{ route('admin.saran.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'saran' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">feedback</span>
                Saran & Masukan
            </a>
            <a href="{{ route('admin.mitsur.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'mitsur' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">handshake</span>
                Mitsur Pairs
            </a>
            <a href="{{ route('admin.activity-log.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'activity-log' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">history</span>
                Log Aktivitas
            </a>

            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 pt-4 pb-1">Lainnya</p>

            <a href="{{ route('admin.kalender.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'kalender' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">calendar_month</span>
                Kalender Kegiatan
            </a>
            <a href="{{ route('admin.izin.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'izin' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">assignment</span>
                Izin
            </a>
            <a href="{{ route('admin.pengumuman.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'pengumuman' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">campaign</span>
                Pengumuman
            </a>
            <a href="{{ route('admin.landing-page.edit') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'landing-page' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">edit_document</span>
                Kelola Landing Page
            </a>
            <a href="{{ route('admin.pengaturan.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm border-2 border-transparent {{ $active === 'pengaturan' ? 'active' : 'text-black hover:bg-gray-100' }}">
                <span class="material-symbols-outlined text-xl">settings</span>
                Pengaturan
            </a>
        </nav>

        <!-- Logout -->
        <div class="p-3 border-t-4 border-black mt-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold text-sm text-red-600 bg-red-50 border-2 border-red-200 hover:bg-red-100 hover:border-red-400 transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-xl">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-72 min-h-screen">
        <!-- Top Bar -->
        <header class="sticky top-0 z-30 bg-white border-b-4 border-black px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden bg-black text-white p-2 rounded-lg border-2 border-black">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h2 class="font-black text-lg uppercase tracking-tight text-black">{{ $title }}</h2>
            </div>
            <div class="flex items-center gap-3">
                <button id="theme-toggle" class="flex items-center justify-center w-8 h-8 bg-white dark:bg-zinc-800 text-black dark:text-white border-2 border-black dark:border-white rounded-lg shadow-[2px_2px_0_0_#000] dark:shadow-[2px_2px_0_0_#fff] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all cursor-pointer mr-1" aria-label="Toggle Theme">
                    <span class="material-symbols-outlined text-sm block dark:hidden">dark_mode</span>
                    <span class="material-symbols-outlined text-sm hidden dark:block">light_mode</span>
                </button>
                <span class="text-sm font-bold text-gray-500 hidden sm:block">{{ Auth::guard('admin')->user()?->name ?? 'Admin' }}</span>
                <a href="{{ route('dashboard') }}" class="bg-[#FFDE00] text-black px-3 py-1.5 rounded-lg border-2 border-black font-black text-xs shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                    KE SANTRI
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4 sm:p-6 lg:p-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-[#39FF14] border-4 border-black p-4 mb-6 font-black text-center shadow-[4px_4px_0_0_#000] rounded-lg text-black" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span>
                        {{ session('success') }}
                    </div>
                    <button @click="show = false" class="mt-1 text-xs font-bold underline">Tutup</button>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-400 border-4 border-black p-4 mb-6 font-black text-center shadow-[4px_4px_0_0_#000] rounded-lg text-black" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        {{ session('error') }}
                    </div>
                    <button @click="show = false" class="mt-1 text-xs font-bold underline">Tutup</button>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

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

        // =========================================================
        // PWA Service Worker & Push Notifications for Admin
        // =========================================================
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js', { scope: '/' })
                    .then(reg => {
                        console.log('[PWA Admin] Service Worker registered:', reg.scope);
                        setupPushNotifications(reg);
                    })
                    .catch(err => console.warn('[PWA Admin] SW registration failed:', err));
            });
        }

        function setupPushNotifications(registration) {
            if (!('PushManager' in window) || !('Notification' in window)) {
                return;
            }

            if (Notification.permission === 'default') {
                setTimeout(() => {
                    Notification.requestPermission().then(permission => {
                        if (permission === 'granted') {
                            subscribeUser(registration);
                        }
                    });
                }, 5000);
            } else if (Notification.permission === 'granted') {
                subscribeUser(registration);
            }
        }

        function subscribeUser(registration) {
            const publicKey = '{{ config("webpush.vapid.public_key") }}';
            if (!publicKey) return;

            const applicationServerKey = urlBase64ToUint8Array(publicKey);
            
            registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: applicationServerKey
            })
            .then(subscription => {
                sendSubscriptionToServer(subscription);
            })
            .catch(err => {
                console.error('[PWA Push Admin] Failed to subscribe:', err);
            });
        }

        function sendSubscriptionToServer(subscription) {
            fetch('/push/subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(subscription)
            })
            .then(res => res.json())
            .then(data => console.log('[PWA Push Admin] Subscription saved:', data))
            .catch(err => console.error('[PWA Push Admin] Failed to save subscription:', err));
        }

        function urlBase64ToUint8Array(base64String) {
            const padding = '='.repeat((4 - base64String.length % 4) % 4);
            const base64 = (base64String + padding)
                .replace(/\-/g, '+')
                .replace(/_/g, '/');

            const rawData = window.atob(base64);
            const outputArray = new Uint8Array(rawData.length);

            for (let i = 0; i < rawData.length; ++i) {
                outputArray[i] = rawData.charCodeAt(i);
            }
            return outputArray;
        }
    </script>
    <x-announcement-reminder-popup />
</body>
</html>
