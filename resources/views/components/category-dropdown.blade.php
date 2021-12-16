<x-dropdown>
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories'}}
            <x-icons
                name='arrow-down'
                class="absolute pointer-events-none"
                style="right:12px;"
            ></x-icons>
        </button>
    </x-slot>

    <x-dropdown-item href="/" :active="request()->routeIs('posts')">All</x-dropdown-item>
    @foreach($categories as $category)
        <x-dropdown-item
            :active="isset($currentCategory) && $currentCategory->is($category)"
            {{--                        :active="request()->is('categories/{{$category->slug}}')"--}}
            href="/?category={{$category->slug}}"
        >
            {{ ucwords($category->name)}}
        </x-dropdown-item>
    @endforeach
</x-dropdown>
