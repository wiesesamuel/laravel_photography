@props(['parent_route', 'actions'])

<nav x-data="{ open: false }" class="border-b border-gray-500 px-3 py-3">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @foreach($actions as $action)
                        <x-parts.nav-link
                            :href="route($parent_route . '.' . $action)"
                            :active="request()->routeIs($parent_route . '.' . $action)" light_background="yes"
                        >
                            {{__(ucwords($action))}}
                        </x-parts.nav-link>
                    @endforeach
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
            @foreach($actions as $action)
                <x-parts.responsive-nav-link
                    :href="route($parent_route . '.' . $action)"
                    :active="request()->routeIs($parent_route . '.' . $action)" light_background="yes"
                >
                    {{__($action)}}
                </x-parts.responsive-nav-link>
            @endforeach
        </div>

    </div>
</nav>
