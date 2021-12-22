@props(['active'])

@php
$lightactive = " border-indigo-400 text-gray-900 focus:border-indigo-700 ";
$lightnonactive = " text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300 ";

$darkActive ='border-indigo-300 focus:border-white text-indigo-200';
$darkNonactive = 'text-gray-300 hover:text-white hover:border-gray-300 focus:text-indigo-600 focus:border-indigo-600';

$lightBackground = isset($attributes['light_background']);

$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 text-lg font-medium leading-5 focus:outline-none transition duration-150 ease-in-out' . (!$lightBackground ? $darkActive : $lightactive)
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-lg font-medium leading-5  focus:outline-none transition duration-150 ease-in-out'  . (!$lightBackground ? $darkNonactive : $lightnonactive)
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
