@props([
    'active' => '',
    'alpine' => false
])

@php
    $navItems = [
        ['route' => 'dashboard',       'icon' => 'dashboard',       'label' => 'Dashboard'],
        ['route' => 'attendance.scan', 'icon' => 'qr_code_scanner', 'label' => 'Scan Absensi'],
        ['route' => 'mitsur',          'icon' => 'group',           'label' => 'Mitsur Duo'],
        ['route' => 'refleksi',        'icon' => 'edit_note',       'label' => 'Refleksi Harian'],
        ['route' => 'zikir',           'icon' => 'auto_awesome',    'label' => 'Tasbih Digital'],
        ['route' => 'kajian',          'icon' => 'calendar_month',  'label' => 'Kajian'],
        ['route' => 'rekap',           'icon' => 'bar_chart',       'label' => 'Rekap'],
        ['route' => 'rapor',           'icon' => 'analytics',       'label' => 'Rapor'],
        ['route' => 'izin.index',      'icon' => 'assignment',      'label' => 'Izin'],
        ['route' => 'kalender.index',  'icon' => 'calendar_today',  'label' => 'Kalender'],
        ['route' => 'alumni.index',    'icon' => 'info',            'label' => 'Info'],
    ];
@endphp

<aside 
    @if($alpine)
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    @endif
    class="fixed left-0 top-0 bottom-0 z-[60] flex flex-col py-6 md:py-24 w-64 border-r-3 border-on-background bg-surface overflow-y-auto transition-transform duration-300 md:translate-x-0 @if(!$alpine) -translate-x-full @endif"
>
    <nav class="flex-1 px-4">
        <!-- Header container with Close Button (Mobile Only) and User Info -->
        <div class="flex items-center justify-between mb-8 px-4 gap-2">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-12 h-12 rounded-lg border-2 border-on-background bg-secondary-container overflow-hidden flex items-center justify-center font-bold text-xl text-on-secondary-container flex-shrink-0">
                    @if(auth()->user()->avatar)
                        <img src="https://api.dicebear.com/9.x/micah/svg?seed={!! auth()->user()->avatar !!}&backgroundColor=transparent" class="w-full h-full object-cover" alt="User Avatar" />
                    @else
                        {{ substr(auth()->user()->name, 0, 1) }}
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="font-headline-md text-[16px] font-black text-primary truncate max-w-[100px]" title="{{ auth()->user()->name }}">{{ auth()->user()->name }}</p>
                    <p class="text-on-surface-variant text-[10px] font-label-sm truncate">{{ auth()->user()->title ?? 'Santri' }}</p>
                </div>
            </div>
            <!-- Close Button (Mobile Only) -->
            <button 
                id="sidebar-close" 
                @if($alpine) @click="sidebarOpen = false" @endif
                class="w-10 h-10 bg-surface text-on-background border-2 border-on-background rounded-lg flex md:hidden items-center justify-center hover:bg-error-container transition-colors flex-shrink-0 cursor-pointer" 
                aria-label="Tutup menu"
            >
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        @foreach($navItems as $item)
        @php
            $isActive = ($active === $item['route']) || request()->routeIs($item['route'] . '*');
        @endphp
        <a class="flex items-center gap-3 border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] p-3 my-2 rounded-lg font-bold hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all {{ $isActive ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface text-on-surface hover:bg-surface-container-high' }}" href="{{ route($item['route']) }}">
            <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
            <span class="font-label-sm text-label-sm">{{ $item['label'] }}</span>
        </a>
        @endforeach

        @if(auth()->user()->isAdmin())
        <a class="flex items-center gap-3 text-on-surface bg-surface border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] p-3 my-2 rounded-lg font-bold hover:bg-surface-container-high hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined">security</span>
            <span class="font-label-sm text-label-sm">Admin Panel</span>
        </a>
        @endif
    </nav>
    <div class="px-4 mt-auto border-t-3 border-on-background pt-4 pb-2">
        <a class="flex items-center gap-3 border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] p-3 my-1 rounded-lg font-bold hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all {{ $active === 'profile' || request()->routeIs('profile.*') ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface text-on-surface hover:bg-surface-container-high' }}" href="{{ route('profile.edit') }}">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-label-sm text-label-sm">Pengaturan Akun</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 relative z-10">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 text-error bg-error-container/30 p-3 my-1 border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] hover:bg-error-container hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] active:translate-x-0 active:translate-y-0 active:shadow-[4px_4px_0px_0px_rgba(var(--neobrutal-shadow-color),1)] transition-all rounded-lg cursor-pointer font-bold">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-label-sm text-label-sm">Keluar</span>
            </button>
        </form>
    </div>
</aside>
