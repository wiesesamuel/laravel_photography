<x-posts.dropdown>
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories'}}
            <x-parts.icons
                name='arrow-down'
                class="absolute pointer-events-none"
                style="right:12px;"
            ></x-parts.icons>
        </button>
    </x-slot>

    <x-posts.dropdown-item
        href="/?{{http_build_query(request()->except('category', 'page'))}}"
        :active="!isset($currentCategory) or $currentCategory == null">
        All
    </x-posts.dropdown-item>

    @foreach($categories as $category)
        <x-posts.dropdown-item
            :active="isset($currentCategory) && $currentCategory->is($category)"
            href="/?category={{$category->slug}}&{{http_build_query(request()->except('category', 'page'))}}"
        >
            {{ ucwords($category->name)}}
        </x-posts.dropdown-item>
    @endforeach
</x-posts.dropdown>
