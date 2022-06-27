<nav x-data="{ open: false }" class="px-3 py-3" style="background: rgb(31, 41, 55);">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center logo">
                    <a href="{{ route('home') }}">
                        <x-parts.application-logo class="block h-10 w-auto fill-current text-sky-600"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-parts.nav-link :href="route('albums')" :active="request()->routeIs('albums', 'album')"
                                      class="text-white">
                        {{ __('Portfolio') }}
                    </x-parts.nav-link>
                    <x-parts.nav-link :href="route('profile')" :active="request()->routeIs('profile')"
                                      class="text-white">
                        {{ __('Profil') }}
                    </x-parts.nav-link>
                    {{--                    <x-parts.nav-link :href="route('team')" :active="request()->routeIs('team')"--}}
                    {{--                                      class="text-white">--}}
                    {{--                        {{ __('Team') }}--}}
                    {{--                    </x-parts.nav-link>--}}
                    {{--                    <x-parts.nav-link :href="route('prices')" :active="request()->routeIs('prices')"--}}
                    {{--                                      class="text-white">--}}
                    {{--                        {{ __('Price') }}--}}
                    {{--                    </x-parts.nav-link>--}}
                    <x-parts.nav-link :href="route('contact')" :active="request()->routeIs('contact')"
                                      class="text-white">
                        {{ __('Kontakt') }}
                    </x-parts.nav-link>

                    @auth
                        <x-parts.nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                          class="text-white">
                            {{ __('Dashboard') }}
                        </x-parts.nav-link>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-auth.dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-xl font-medium text-white hover:text-sky-700 hover:border-sky-300 focus:outline-none focus:text-sky-700 focus:border-sky-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-auth.dropdown-link :href="route('logout')"
                                                      onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-auth.dropdown-link>
                            </form>
                        </x-slot>
                    </x-auth.dropdown>
                @else
                    {{--                   TODO Login Button --}}
                    <a href="{{ route('login') }}" class="text-lg text-white underline">Log in</a>

                    @if (false && Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 text-lg text-white underline">
                            Registrieren
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-sky-400 hover:text-sky-500 hover:bg-sky-100 focus:outline-none focus:bg-sky-100 focus:text-sky-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-auth.responsive-nav-link :href="route('albums')" :active="request()->routeIs('albums', 'album')">
                {{ __('Portfolio') }}
            </x-auth.responsive-nav-link>
            <x-auth.responsive-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
                {{ __('Profile') }}
            </x-auth.responsive-nav-link>
{{--            <x-auth.responsive-nav-link :href="route('team')" :active="request()->routeIs('team')">--}}
{{--                {{ __('Team') }}--}}
{{--            </x-auth.responsive-nav-link>--}}
            <x-auth.responsive-nav-link :href="route('prices')" :active="request()->routeIs('prices')">
                {{ __('Price') }}
            </x-auth.responsive-nav-link>


            @auth
                <x-auth.responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-auth.responsive-nav-link>
            @endauth
        </div>

    @auth
        <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-sky-200">
                <div class="px-4">
                    <div class="font-medium text-base text-sky-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-sky-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-auth.responsive-nav-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-auth.responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                Login
                {{--                TODO Login Btton--}}
            </div>
        @endauth
    </div>
</nav>
