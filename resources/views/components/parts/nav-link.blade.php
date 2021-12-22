@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 text-lg font-medium leading-5 focus:outline-none transition duration-150 ease-in-out
            border-indigo-300 focus:border-white text-indigo-200'

            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-lg font-medium leading-5  focus:outline-none transition duration-150 ease-in-out
            text-gray-300 hover:text-white hover:border-gray-300 focus:text-indigo-600 focus:border-indigo-600';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
