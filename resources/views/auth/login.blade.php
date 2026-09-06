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
    <title>Login - Daaru Hiraa</title>
    <style>
        :root {
            --primary-container: #064e3b;
            --surface-container-lowest: #ffffff;
            --on-tertiary-fixed: #261a00;
            --on-secondary: #ffffff;
            --on-primary: #ffffff;
            --on-tertiary: #ffffff;
            --surface-tint: #2b6954;
            --on-secondary-fixed-variant: #00513a;
            --on-error-container: #93000a;
            --tertiary-fixed: #ffdf9f;
            --surface-container: #eeeeee;
            --surface-container-highest: #e2e2e2;
            --tertiary-container: #584000;
            --on-tertiary-container: #e0a800;
            --outline: #707974;
            --on-error: #ffffff;
            --tertiary-fixed-dim: #f9bd22;
            --secondary-fixed: #a6f2cf;
            --outline-variant: #bfc9c3;
            --on-surface-variant: #404944;
            --surface: #f9f9f9;
            --surface-container-high: #e8e8e8;
            --inverse-surface: #303030;
            --primary-fixed-dim: #95d3ba;
            --on-secondary-container: #247155;
            --on-primary-fixed-variant: #0b513d;
            --background: #f9f9f9;
            --primary: #003527;
            --on-primary-container: #80bea6;
            --on-primary-fixed: #002117;
            --secondary: #1b6b4f;
            --surface-variant: #e2e2e2;
            --on-tertiary-fixed-variant: #5c4300;
            --surface-dim: #dadada;
            --inverse-primary: #95d3ba;
            --secondary-fixed-dim: #8bd6b4;
            --error: #ba1a1a;
            --surface-container-low: #f3f3f3;
            --surface-bright: #f9f9f9;
            --on-background: #1b1b1b;
            --on-surface: #1b1b1b;
            --on-secondary-fixed: #002115;
            --secondary-container: #a6f2cf;
            --primary-fixed: #b0f0d6;
            --error-container: #ffdad6;
            --inverse-on-surface: #f1f1f1;
            --tertiary: #3c2b00;
            --neobrutal-shadow-color: 0, 0, 0;
            --neobrutal-border-color: #000000;
        }

        .dark {
            --primary-container: #004d38;
            --surface-container-lowest: #1a1a1a;
            --on-tertiary-fixed: #ffdf9f;
            --on-secondary: #002115;
            --on-primary: #002117;
            --on-tertiary: #261a00;
            --surface-tint: #4ade80;
            --on-secondary-fixed-variant: #a6f2cf;
            --on-error-container: #f9cbd2;
            --tertiary-fixed: #584000;
            --surface-container: #242424;
            --surface-container-highest: #3e3e3e;
            --tertiary-container: #ffdf9f;
            --on-tertiary-container: #ffdf9f;
            --outline: #94a3b8;
            --on-error: #601410;
            --tertiary-fixed-dim: #ffdf9f;
            --secondary-fixed: #003527;
            --outline-variant: #4a5568;
            --on-surface-variant: #cbd5e1;
            --surface: #1e1e1e;
            --surface-container-high: #2d2d2d;
            --inverse-surface: #f1f1f1;
            --primary-fixed-dim: #1b6b4f;
            --on-secondary-container: #a6f2cf;
            --on-primary-fixed-variant: #b0f0d6;
            --background: #121212;
            --primary: #4ade80;
            --on-primary-container: #a6f2cf;
            --on-primary-fixed: #b0f0d6;
            --secondary: #22c55e;
            --surface-variant: #2d2d2d;
            --on-tertiary-fixed-variant: #ffdf9f;
            --surface-dim: #151515;
            --inverse-primary: #003527;
            --secondary-fixed-dim: #1b6b4f;
            --error: #f87171;
            --surface-container-low: #222222;
            --surface-bright: #1e1e1e;
            --on-background: #f1f1f1;
            --on-surface: #f1f1f1;
            --on-secondary-fixed: #a6f2cf;
            --secondary-container: #003527;
            --primary-fixed: #1b6b4f;
            --error-container: #8c1d18;
            --inverse-on-surface: #121212;
            --tertiary: #ffdf9f;
            --neobrutal-shadow-color: 255, 255, 255;
            --neobrutal-border-color: #ffffff;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* ── Colorful animated background ── */
        .bg-colorful {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #fda085 100%);
            background-size: 300% 300%;
            animation: bgShift 10s ease infinite;
        }
        .dark .bg-colorful {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e, #1a1a2e, #16213e);
            background-size: 300% 300%;
        }
        @keyframes bgShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ── Blobs ── */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.45;
            pointer-events: none;
            z-index: 0;
            animation: blobFloat 12s ease-in-out infinite alternate;
        }
        @keyframes blobFloat {
            0%   { transform: translate(0px, 0px) scale(1); }
            100% { transform: translate(30px, -20px) scale(1.08); }
        }

        /* ── Card ── */
        .login-card {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 3px solid rgba(255,255,255,0.7);
            border-radius: 28px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.2), 0 8px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
        }
        .dark .login-card {
            background: rgba(26,26,26,0.90);
            border-color: rgba(255,255,255,0.12);
        }

        /* ── Top rainbow strip ── */
        .card-rainbow {
            height: 6px;
            background: linear-gradient(90deg, #f093fb, #f5576c, #fda085, #fcb69f, #a1c4fd, #c2e9fb, #a8edea);
            background-size: 200% 100%;
            animation: rainbowShift 4s linear infinite;
        }
        @keyframes rainbowShift {
            0%   { background-position: 0% 0%; }
            100% { background-position: 200% 0%; }
        }

        /* ── Form card body ── */
        .card-body { padding: 32px 32px 28px; }
        @media (max-width: 480px) {
            .card-body { padding: 24px 20px 22px; }
        }

        /* ── Logo badge ── */
        .logo-badge {
            width: 56px; height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, #003527, #1b6b4f);
            border: 2.5px solid #000;
            box-shadow: 4px 4px 0 #000;
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            transition: transform 0.3s ease;
            animation: floatLogo 3s ease-in-out infinite;
        }
        @keyframes floatLogo {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-6px); }
        }

        /* ── Input ── */
        .field-input {
            width: 100%;
            padding: 14px 16px;
            border: 2.5px solid #d1d5db;
            border-radius: 14px;
            font-size: 15px;
            font-family: inherit;
            background: #fff;
            color: #1b1b1b;
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
            outline: none;
        }
        .field-input:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 4px rgba(118, 75, 162, 0.15);
            transform: scale(1.01);
        }
        .field-input.has-error { border-color: #f5576c !important; }
        .dark .field-input {
            background: #242424;
            color: #f1f1f1;
            border-color: #4a5568;
        }
        .dark .field-input:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 4px rgba(167,139,250,0.15);
        }

        /* ── Submit button ── */
        .btn-submit {
            width: 100%;
            padding: 15px;
            border-radius: 14px;
            border: 3px solid #000;
            font-size: 16px;
            font-weight: 800;
            font-family: inherit;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            box-shadow: 4px 4px 0 #000;
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
        }
        .btn-submit:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0 #000;
        }
        .btn-submit:active {
            transform: translate(0, 0);
            box-shadow: 4px 4px 0 #000;
        }
        .btn-submit.btn-admin {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        /* ── Admin button ── */
        .btn-admin-link {
            width: 100%;
            padding: 14px;
            border-radius: 14px;
            border: 3px solid #000;
            font-size: 15px;
            font-weight: 800;
            font-family: inherit;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            box-shadow: 4px 4px 0 #000;
            transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: #fff;
            text-decoration: none;
        }
        .btn-admin-link:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0 #000;
        }
        .btn-admin-link:active {
            transform: translate(0,0);
            box-shadow: 4px 4px 0 #000;
        }

        /* ── Label ── */
        .field-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6b7280;
            margin-bottom: 6px;
        }
        .dark .field-label { color: #9ca3af; }

        /* ── Divider ── */
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 20px 0;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1.5px;
            background: linear-gradient(90deg, transparent, #d1d5db, transparent);
        }
        .divider span {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #9ca3af;
            white-space: nowrap;
        }

        /* ── Theme toggle ── */
        .theme-btn {
            position: fixed; top: 16px; right: 16px; z-index: 100;
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(8px);
            border: 2.5px solid #000;
            border-radius: 14px;
            box-shadow: 3px 3px 0 #000;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s ease;
        }
        .theme-btn:hover { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 #000; }
        .dark .theme-btn {
            background: rgba(30,30,30,0.85);
            border-color: #fff;
            box-shadow: 3px 3px 0 #fff;
            color: #fff;
        }
        .dark .theme-btn:hover { box-shadow: 4px 4px 0 #fff; }

        /* ── Floating emoji decorations ── */
        .deco {
            position: fixed;
            font-size: 32px;
            pointer-events: none;
            z-index: 0;
            opacity: 0.6;
            animation: decoFloat 8s ease-in-out infinite alternate;
        }
        @keyframes decoFloat {
            0%   { transform: translateY(0) rotate(-5deg); }
            100% { transform: translateY(-18px) rotate(5deg); }
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity:0; transform: translateY(24px); }
            to   { opacity:1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) forwards; opacity:0; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.12s; }
        .delay-3 { animation-delay: 0.20s; }
        .delay-4 { animation-delay: 0.28s; }
        .delay-5 { animation-delay: 0.36s; }
        .delay-6 { animation-delay: 0.44s; }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800;900&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-colorful min-h-screen flex items-center justify-center p-4" style="font-family:'Space Grotesk',sans-serif;">

    {{-- Theme Toggle --}}
    <button id="theme-toggle" class="theme-btn" aria-label="Toggle Theme">
        <span class="material-symbols-outlined text-xl block dark:hidden" style="font-size:20px;">dark_mode</span>
        <span class="material-symbols-outlined text-xl hidden dark:block" style="font-size:20px;">light_mode</span>
    </button>

    {{-- Colorful blobs --}}
    <div class="blob" style="width:400px;height:400px;background:#a78bfa;top:-80px;left:-100px;animation-delay:0s;"></div>
    <div class="blob" style="width:350px;height:350px;background:#f472b6;bottom:-80px;right:-80px;animation-delay:3s;"></div>
    <div class="blob" style="width:280px;height:280px;background:#34d399;top:40%;left:60%;animation-delay:6s;"></div>

    {{-- Emoji decorations --}}
    <div class="deco" style="top:8%;left:6%;animation-delay:0s;">📖</div>
    <div class="deco" style="top:12%;right:8%;animation-delay:1.5s;font-size:26px;">🌙</div>
    <div class="deco" style="bottom:12%;left:5%;animation-delay:3s;font-size:28px;">⭐</div>
    <div class="deco" style="bottom:8%;right:6%;animation-delay:2s;font-size:24px;">🕌</div>

    {{-- Login Card --}}
    <main class="login-card relative z-10" style="animation: fadeUp 0.5s ease forwards;">
        {{-- Rainbow top strip --}}
        <div class="card-rainbow"></div>

        <div class="card-body">
            @php $isAdmin = request('admin') == '1'; @endphp

            {{-- Brand Header --}}
            <div class="text-center mb-6 fade-up delay-1">
                <a href="{{ url('/') }}" class="inline-flex flex-col items-center gap-3 hover:opacity-80 transition-opacity mb-4">
                    <div class="logo-badge">
                        <img src="{{ asset('images/logo-daar-hira.png') }}" alt="Logo" class="w-full h-full object-cover"/>
                    </div>
                    <span style="font-size:22px;font-weight:900;background:linear-gradient(135deg,#667eea,#764ba2,#f093fb);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        Daaru Hiraa
                    </span>
                </a>
                <h1 style="font-size:20px;font-weight:800;color:#1b1b1b;margin:0 0 6px;" class="dark:text-white">
                    {{ $isAdmin ? '🔐 Login Admin Pondok' : '👋 Selamat Datang Kembali!' }}
                </h1>
                <p style="font-size:13px;color:#6b7280;margin:0;" class="dark:text-gray-400">
                    {{ $isAdmin ? 'Masuk untuk mengelola data santri, absensi, dan QR.' : 'Masuk untuk melanjutkan perjalanan belajarmu.' }}
                </p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div style="background:#d1fae5;border:2px solid #059669;border-radius:12px;padding:12px;margin-bottom:16px;font-size:13px;color:#065f46;">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                @if($isAdmin)
                    <input type="hidden" name="admin" value="1">
                @endif

                {{-- Username --}}
                <div class="fade-up delay-2">
                    <label class="field-label" for="username">Username</label>
                    <input class="field-input {{ $errors->has('username') ? 'has-error' : '' }}"
                           id="username"
                           type="text"
                           name="username"
                           value="{{ old('username') }}"
                           placeholder="Masukkan username Anda"
                           required autofocus autocomplete="username"/>
                    @error('username')
                        <div style="color:#f5576c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="fade-up delay-3">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                        <label class="field-label" for="password" style="margin-bottom:0;">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size:11px;font-weight:700;color:#764ba2;text-decoration:none;" class="hover:underline">Lupa Password?</a>
                        @endif
                    </div>
                    <div style="position:relative;">
                        <input class="field-input {{ $errors->has('password') ? 'has-error' : '' }}"
                               id="password"
                               type="password"
                               name="password"
                               placeholder="••••••••"
                               style="padding-right:48px;"
                               required autocomplete="current-password"/>
                        <button type="button" onclick="togglePassword()"
                                style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#9ca3af;padding:0;">
                            <span class="material-symbols-outlined" id="toggleIcon" style="font-size:20px;">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <div style="color:#f5576c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Auto Remember Info --}}
                <div class="fade-up delay-4" style="display:flex;align-items:center;gap:8px;">
                    <span class="material-symbols-outlined" style="font-size:16px;color:#764ba2;">verified_user</span>
                    <span style="font-size:12px;color:#9ca3af;">Sesi Anda akan tersimpan otomatis selama 30 hari</span>
                </div>

                {{-- Submit --}}
                <div class="fade-up delay-5">
                    <button type="submit" class="btn-submit {{ $isAdmin ? 'btn-admin' : '' }}">
                        <span>{{ $isAdmin ? 'Masuk sebagai Admin' : 'Masuk' }}</span>
                        <span class="material-symbols-outlined" style="font-size:20px;">login</span>
                    </button>
                </div>
            </form>

            {{-- Toggle Admin/Santri --}}
            @if(!$isAdmin)
            <div class="fade-up delay-6">
                <div class="divider"><span>Admin Pondok</span></div>
                <a href="{{ route('login') }}?admin=1" class="btn-admin-link">
                    <span class="material-symbols-outlined" style="font-size:20px;font-variation-settings:'FILL' 1;">admin_panel_settings</span>
                    <span>Masuk sebagai Admin Pondok</span>
                </a>
                <p style="font-size:11px;color:#9ca3af;text-align:center;margin-top:10px;">
                    Kelola data santri, absensi, dan QR dari panel admin.
                </p>
            </div>
            @else
            <div class="fade-up delay-6" style="text-align:center;margin-top:16px;">
                <a href="{{ route('login') }}" style="font-size:13px;font-weight:700;color:#764ba2;text-decoration:none;" class="hover:underline">
                    ← Kembali ke login santri
                </a>
            </div>
            @endif
        </div>
    </main>

    <script>
        function togglePassword() {
            const p = document.getElementById('password');
            const i = document.getElementById('toggleIcon');
            if (p.type === 'password') {
                p.type = 'text';
                i.textContent = 'visibility_off';
            } else {
                p.type = 'password';
                i.textContent = 'visibility';
            }
        }

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
