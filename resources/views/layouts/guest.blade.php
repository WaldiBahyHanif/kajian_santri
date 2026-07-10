<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .dark input, 
            .dark select, 
            .dark textarea {
                background-color: #18181b !important;
                color: #f4f4f5 !important;
                border-color: #3f3f46 !important;
            }
            .dark label {
                color: #d4d4d8 !important;
            }
            .dark .text-gray-600 {
                color: #a1a1aa !important;
            }
            /* Style buttons under dark mode */
            .dark button[type="submit"]:not(.cf-turnstile button) {
                background-color: #10b981 !important;
                color: #ffffff !important;
            }
            .dark button[type="submit"]:not(.cf-turnstile button):hover {
                background-color: #059669 !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-zinc-950 transition-colors duration-200">
        <div class="fixed top-4 right-4 z-50">
            <button id="theme-toggle" class="flex items-center justify-center w-10 h-10 bg-white dark:bg-zinc-800 text-gray-800 dark:text-gray-200 border-2 border-gray-800 dark:border-gray-200 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] dark:hover:shadow-[6px_6px_0px_0px_rgba(255,255,255,1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all cursor-pointer" aria-label="Toggle Theme">
                <span class="material-symbols-outlined text-xl block dark:hidden">dark_mode</span>
                <span class="material-symbols-outlined text-xl hidden dark:block">light_mode</span>
            </button>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-zinc-950">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500 dark:text-gray-400" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-zinc-900 border-2 border-gray-800 dark:border-zinc-700 shadow-md dark:shadow-zinc-800 overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
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
        </script>
    </body>
</html>
