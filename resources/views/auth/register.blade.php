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
    <title>Daftar - Daaru Hiraa</title>
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

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .smooth-shadow {
            box-shadow: 0 10px 30px -5px rgba(0, 53, 39, 0.1), 0 4px 12px -4px rgba(0, 53, 39, 0.05);
        }
        .input-focus:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(6, 78, 59, 0.1);
            outline: none;
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
        
        .dark input {
            background-color: var(--surface-container-lowest) !important;
            color: var(--on-surface) !important;
            border-color: var(--outline-variant) !important;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .animate-slide-left {
            animation: slideInLeft 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        
        .animate-slide-right {
            animation: slideInRight 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-container-lowest text-on-surface font-body-md selection:bg-secondary-container selection:text-on-secondary-container">

<div class="fixed top-4 right-4 z-50">
    <button id="theme-toggle" class="flex items-center justify-center w-10 h-10 bg-surface text-on-background border-3 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all cursor-pointer" aria-label="Toggle Theme">
        <span class="material-symbols-outlined text-xl block dark:hidden">dark_mode</span>
        <span class="material-symbols-outlined text-xl hidden dark:block">light_mode</span>
    </button>
</div>

<main class="min-h-screen flex flex-row-reverse items-stretch overflow-hidden">
    <!-- Hero Section (Visible on Desktop) -->
    <section class="hidden lg:flex w-1/2 relative bg-primary-container items-center justify-center p-20 overflow-hidden animate-slide-left">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 rounded-full border-[40px] border-secondary-container"></div>
            <div class="absolute bottom-[-5%] right-[-5%] w-72 h-72 rounded-full border-[20px] border-primary-fixed"></div>
        </div>
        <div class="relative z-10 w-full max-w-xl">
            <div class="rounded-xl overflow-hidden smooth-shadow border-4 border-surface-container-lowest">
                <img alt="Studying Santri" class="w-full h-[600px] object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAuKcKLN6CpIxDURz14VcY59K0KotpzvruWQ2U7WxJwteWB8XrdepcUgZDJ7oY6C992KhOmSmvtKXndsyDb1ULZ3JsH64gmCD0oHL4jv83onvf4oz4jTOsBec5k7NcGvUTKMdSIpYv4a6CwCD4DglF2NxrI_f9DyN-1btmkK6rYAHI27M8-XkqQH-kWGF7rFic0-CO6qytOXILOTlnhtlDL-fmDGumJwqhUo0hRfdRKsJN_s8dhqsDAvE9vd83xZ9ktfyyaW6vkrE4"/>
            </div>
            <div class="mt-12 text-surface-container-lowest">
                <h1 class="font-display-lg text-display-lg mb-4 tracking-tight">Daaru Hiraa</h1>
                <p class="font-body-lg text-body-lg opacity-90 leading-relaxed">
                    Membangun jembatan antara tradisi keilmuan Islam klasik dan inovasi digital modern untuk generasi santri masa kini.
                </p>
            </div>
        </div>
    </section>

    <!-- Register Form Section -->
    <section class="w-full lg:w-1/2 flex items-center justify-center p-margin-mobile md:p-margin-desktop bg-surface overflow-y-auto animate-slide-right">
        <div class="w-full max-w-md py-8">
            <!-- Brand Header -->
            <div class="mb-10 text-center lg:text-left">
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center lg:justify-start gap-2 mb-6 hover:opacity-80 transition-opacity">
                    <div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center text-surface">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                    </div>
                    <span class="font-headline-md text-headline-md text-primary tracking-tighter">Daaru Hiraa</span>
                </a>
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Buat Akun Baru</h2>
                <p class="text-on-surface-variant font-body-md">Mari mulai perjalanan belajarmu bersama kami.</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                
                <div class="space-y-2">
                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest px-1" for="name">Nama Lengkap</label>
                    <input class="w-full px-5 py-4 rounded-lg border-2 {{ $errors->has('name') ? 'border-error' : 'border-outline-variant' }} bg-surface-container-lowest text-on-surface placeholder:text-outline input-focus transition-all duration-300 font-body-md" 
                           id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Fulan bin Fulan" 
                           required autofocus autocomplete="name"/>
                    @error('name')
                        <div class="px-1 text-error font-label-sm text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest px-1" for="username">Username</label>
                    <input class="w-full px-5 py-4 rounded-lg border-2 {{ $errors->has('username') ? 'border-error' : 'border-outline-variant' }} bg-surface-container-lowest text-on-surface placeholder:text-outline input-focus transition-all duration-300 font-body-md" 
                           id="username" 
                           type="text" 
                           name="username" 
                           value="{{ old('username') }}" 
                           placeholder="fulan123" 
                           required autocomplete="username"/>
                    @error('username')
                        <div class="px-1 text-error font-label-sm text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest px-1" for="email">Email</label>
                    <input class="w-full px-5 py-4 rounded-lg border-2 {{ $errors->has('email') ? 'border-error' : 'border-outline-variant' }} bg-surface-container-lowest text-on-surface placeholder:text-outline input-focus transition-all duration-300 font-body-md" 
                           id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="santri@kajian.com" 
                           required autocomplete="email"/>
                    @error('email')
                        <div class="px-1 text-error font-label-sm text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest px-1" for="password">Kata Sandi</label>
                    <div class="relative">
                        <input class="w-full px-5 py-4 rounded-lg border-2 {{ $errors->has('password') ? 'border-error' : 'border-outline-variant' }} bg-surface-container-lowest text-on-surface placeholder:text-outline input-focus transition-all duration-300 font-body-md" 
                               id="password" 
                               type="password" 
                               name="password" 
                               placeholder="••••••••" 
                               required autocomplete="new-password"/>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors" type="button" onclick="togglePassword('password', 'toggleIcon1')">
                            <span class="material-symbols-outlined" id="toggleIcon1">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <div class="px-1 text-error font-label-sm text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest px-1" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <input class="w-full px-5 py-4 rounded-lg border-2 {{ $errors->has('password_confirmation') ? 'border-error' : 'border-outline-variant' }} bg-surface-container-lowest text-on-surface placeholder:text-outline input-focus transition-all duration-300 font-body-md" 
                               id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               placeholder="••••••••" 
                               required autocomplete="new-password"/>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors" type="button" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                            <span class="material-symbols-outlined" id="toggleIcon2">visibility</span>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="px-1 text-error font-label-sm text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>



                <button class="w-full py-4 px-6 mt-4 bg-primary-container text-on-primary font-headline-md text-headline-md rounded-lg smooth-shadow hover:bg-primary transition-all duration-300 hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-2" type="submit">
                    <span>Daftar</span>
                    <span class="material-symbols-outlined">person_add</span>
                </button>
            </form>

            <!-- Footer Link -->
            <div class="mt-8 text-center">
                <p class="font-body-md text-on-surface-variant">
                    Sudah punya akun? 
                    <a class="text-primary font-bold hover:underline transition-all decoration-2 underline-offset-4" href="{{ route('login') }}">Masuk di sini</a>
                </p>
            </div>
        </div>
    </section>
</main>

<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.textContent = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            toggleIcon.textContent = 'visibility';
        }
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
</script>

</body>
</html>
