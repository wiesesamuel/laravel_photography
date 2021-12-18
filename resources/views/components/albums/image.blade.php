@props(['image'])
{{--@dd($image)--}}
{{--<img src="/images/illustration-1.png" alt="Blog image illustration" class="rounded-xl">--}}
    <img
        class="object-contain rounded-xl"
        src="{{$image->url}}"
        title="{{$image->title}}"
        alt="{{isset($image->description) ?? ''}}"
        @if (isset($attributes['onclick']))
        onclick="{{$attributes['onclick']}}"
        @endif
    >
