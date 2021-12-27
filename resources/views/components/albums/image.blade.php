@props(['image'])
{{--<style>--}}
{{--    .portfolio-img {--}}
{{--        border-radius: 1rem;--}}
{{--    }--}}
{{--    .portfolio-img img {--}}
{{--        transform: scale(1.05);--}}
{{--        opacity: 1;--}}
{{--        filter: grayscale(70%);--}}
{{--        transition: transform 0.3s, opacity 0.3s, filter 1s;--}}
{{--    }--}}
{{--    .portfolio-img:hover img {--}}
{{--        filter: grayscale(0%);--}}
{{--        transform: scale(1);--}}
{{--        opacity: 1;--}}
{{--    }--}}
{{--    .portfolio-img:hover .portfolio-hover::before {--}}
{{--        transform: scale3d(1.9, 1.4, 1) rotate3d(0, 0, 1, 45deg) translate3d(0, 100%, 0);--}}
{{--    }--}}
{{--    .portfolio-hover {--}}
{{--        position: absolute;--}}
{{--        left: 0;--}}
{{--        top: 0;--}}
{{--        width: 100%;--}}
{{--        height: 100%;--}}
{{--    }--}}
{{--    .portfolio-hover::before {--}}
{{--        content: "";--}}
{{--        background-color: rgba(255, 255, 255, 0.5);--}}
{{--        position: absolute;--}}
{{--        left: 0;--}}
{{--        top: 0;--}}
{{--        width: 100%;--}}
{{--        height: 100%;--}}
{{--        transform: scale3d(1.9, 1.4, 1) rotate3d(0, 0, 1, 45deg) translate3d(0, -100%, 0);--}}
{{--        transition: transform 0.6s;--}}
{{--    }--}}

{{--</style>--}}
{{--<div class="portfolio-item">--}}
{{--    <div class="portfolio-img">--}}
    <img

        {{$attributes->merge(['class' =>"rounded object-cover"])}}
        src="{{$image->url()}}"
        title="{{$image->title}}"
        alt="{{isset($image->description) ?? ''}}"
        @if (isset($attributes['onclick']))
        onclick="{{$attributes['onclick']}}"
        @endif
    >

{{--<div class="portfolio-hover"></div>--}}
{{--    </div>--}}
{{--</div>--}}
