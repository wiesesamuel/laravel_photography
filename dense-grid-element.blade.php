@props(['horizontal'])

<div class="
@if ($horizontal)
    col-span-3 row-span-2
@else
    col-span-2 row-span-3
@endif
    rounded-xl">
    {{$slot}}
</div>
