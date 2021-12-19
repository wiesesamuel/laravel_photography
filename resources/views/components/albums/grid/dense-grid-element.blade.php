@props(['horizontal'])

<div
    class="
@if ($horizontal)
    col-span-3 row-span-2
@else
    col-span-2 row-span-3
@endif
    rounded-lg"
    style="
{{--@if ($horizontal)--}}
{{--        grid-template-columns: repeat(3, minmax(0, 1fr)); grid-template-rows: repeat(2, minmax(0, 1fr));--}}
{{--@else--}}
{{--        grid-template-columns: repeat(2, minmax(0, 1fr)); grid-template-rows: repeat(3, minmax(0, 1fr));--}}
{{--@endif--}}
">


    {{$slot}}
</div>
