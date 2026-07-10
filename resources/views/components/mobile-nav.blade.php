@props(['active' => ''])

@php
    $isAdmin = (auth()->check() && auth()->user()->isAdmin()) || Auth::guard('admin')->check();
@endphp

<footer class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-3 pb-6 pt-3 md:hidden bg-surface border-t-3 border-on-background rounded-t-xl shadow-[0px_-4px_0px_0px_rgba(0,0,0,1)] gap-1.5">
    <!-- Landing Page (Beranda) -->
    <a href="{{ url('/') }}" class="flex-1 min-w-0 flex flex-col items-center justify-center transition-all duration-150 {{ $active === 'landing' ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface text-on-background hover:bg-surface-container' }} border-2 border-on-background rounded-xl py-1.5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-bold active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
        <span class="material-symbols-outlined text-2xl" style="{{ $active === 'landing' ? "font-variation-settings: 'FILL' 1;" : '' }}">explore</span>
        <span class="font-label-sm text-[9px] mt-0.5 tracking-tighter truncate w-full text-center">Beranda</span>
    </a>

    <!-- Dashboard (Home) -->
    <a href="{{ route('dashboard') }}" class="flex-1 min-w-0 flex flex-col items-center justify-center transition-all duration-150 {{ $active === 'dashboard' ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface text-on-background hover:bg-surface-container' }} border-2 border-on-background rounded-xl py-1.5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-bold active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
        <span class="material-symbols-outlined text-2xl" style="{{ $active === 'dashboard' ? "font-variation-settings: 'FILL' 1;" : '' }}">dashboard</span>
        <span class="font-label-sm text-[9px] mt-0.5 tracking-tighter truncate w-full text-center">Dashboard</span>
    </a>

    <!-- Duo -->
    <a href="{{ route('mitsur') }}" class="flex-1 min-w-0 flex flex-col items-center justify-center transition-all duration-150 {{ $active === 'mitsur' ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface text-on-background hover:bg-surface-container' }} border-2 border-on-background rounded-xl py-1.5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-bold active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
        <span class="material-symbols-outlined text-2xl" style="{{ $active === 'mitsur' ? "font-variation-settings: 'FILL' 1;" : '' }}">people</span>
        <span class="font-label-sm text-[9px] mt-0.5 tracking-tighter truncate w-full text-center">Duo</span>
    </a>

    <!-- Zikir -->
    <a href="{{ route('zikir') }}" class="flex-1 min-w-0 flex flex-col items-center justify-center transition-all duration-150 {{ $active === 'zikir' ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface text-on-background hover:bg-surface-container' }} border-2 border-on-background rounded-xl py-1.5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-bold active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
        <span class="material-symbols-outlined text-2xl" style="{{ $active === 'zikir' ? "font-variation-settings: 'FILL' 1;" : '' }}">nights_stay</span>
        <span class="font-label-sm text-[9px] mt-0.5 tracking-tighter truncate w-full text-center">Zikir</span>
    </a>

    <!-- Admin Panel (Shown conditionally) -->
    @if($isAdmin)
    <a href="{{ route('admin.dashboard') }}" class="flex-1 min-w-0 flex flex-col items-center justify-center transition-all duration-150 {{ $active === 'admin' ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface text-on-background hover:bg-surface-container' }} border-2 border-on-background rounded-xl py-1.5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-bold active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
        <span class="material-symbols-outlined text-2xl" style="{{ $active === 'admin' ? "font-variation-settings: 'FILL' 1;" : '' }}">security</span>
        <span class="font-label-sm text-[9px] mt-0.5 tracking-tighter truncate w-full text-center">Admin</span>
    </a>
    @endif

    <!-- Profil -->
    <a href="{{ route('profile.edit') }}" class="flex-1 min-w-0 flex flex-col items-center justify-center transition-all duration-150 {{ $active === 'profile' ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface text-on-background hover:bg-surface-container' }} border-2 border-on-background rounded-xl py-1.5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-bold active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
        <span class="material-symbols-outlined text-2xl" style="{{ $active === 'profile' ? "font-variation-settings: 'FILL' 1;" : '' }}">person</span>
        <span class="font-label-sm text-[9px] mt-0.5 tracking-tighter truncate w-full text-center">Profil</span>
    </a>
</footer>
