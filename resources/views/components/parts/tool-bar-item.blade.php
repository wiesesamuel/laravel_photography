@props(['parent_route', 'action'])


<x-parts.nav-link
    :href="route($parent_route . '.' . $action)" :active="request()->routeIs($parent_route . '.' . $action)"
>
    {{__($action)}}
</x-parts.nav-link>

return ['new', 'import', 'delete', 'edit'];
