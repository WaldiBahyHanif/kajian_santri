<nav x-data="{ open: false }" class="bg-white border-b-4 border-black font-mono">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-black bg-black text-white px-3 py-1 border-2 border-black shadow-[4px_4px_0px_0px_rgba(255,222,0,1)]">
                        KS
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-lg font-black uppercase border-b-0 hover:bg-[#FFDE00] px-4 transition-colors">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('attendance.scan')" :active="request()->routeIs('attendance.scan')" class="text-lg font-black uppercase border-b-0 hover:bg-[#00E5FF] px-4 transition-colors">
                        {{ __('Scan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('rekap')" :active="request()->routeIs('rekap') || request()->routeIs('rekap.detail')" class="text-lg font-black uppercase border-b-0 hover:bg-[#A6F2CF] px-4 transition-colors">
                        {{ __('Rekap') }}
                    </x-nav-link>
                    <x-nav-link :href="route('rapor')" :active="request()->routeIs('rapor')" class="text-lg font-black uppercase border-b-0 hover:bg-[#39FF14] px-4 transition-colors">
                        {{ __('Rapor') }}
                    </x-nav-link>
                    <x-nav-link :href="route('zikir')" :active="request()->routeIs('zikir')" class="text-lg font-black uppercase border-b-0 hover:bg-[#FF007F] hover:text-white px-4 transition-colors">
                        {{ __('Zikir') }}
                    </x-nav-link>
                    <x-nav-link :href="route('kajian')" :active="request()->routeIs('kajian')" class="text-lg font-black uppercase border-b-0 hover:bg-[#FF9100] px-4 transition-colors">
                        {{ __('Kajian') }}
                    </x-nav-link>
                    <x-nav-link :href="route('izin.index')" :active="request()->routeIs('izin.*')" class="text-lg font-black uppercase border-b-0 hover:bg-[#A6F2CF] px-4 transition-colors">
                        {{ __('Izin') }}
                    </x-nav-link>
                    <x-nav-link :href="route('kalender.index')" :active="request()->routeIs('kalender.*')" class="text-lg font-black uppercase border-b-0 hover:bg-[#FFDE00] px-4 transition-colors">
                        {{ __('Kalender') }}
                    </x-nav-link>
                    <x-nav-link :href="route('alumni.index')" :active="request()->routeIs('alumni.*')" class="text-lg font-black uppercase border-b-0 hover:bg-[#FFD700] px-4 transition-colors">
                        {{ __('Info') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                 {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('attendance.scan')" :active="request()->routeIs('attendance.scan')">
                {{ __('Scan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('rekap')" :active="request()->routeIs('rekap')">
                {{ __('Rekap') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('rapor')" :active="request()->routeIs('rapor')">
                {{ __('Rapor') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('zikir')" :active="request()->routeIs('zikir')">
                {{ __('Zikir') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('kajian')" :active="request()->routeIs('kajian')">
                {{ __('Kajian') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('izin.index')" :active="request()->routeIs('izin.*')">
                {{ __('Izin') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('kalender.index')" :active="request()->routeIs('kalender.*')">
                {{ __('Kalender') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('alumni.index')" :active="request()->routeIs('alumni.*')">
                {{ __('Info') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->title ?? 'Santri' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>