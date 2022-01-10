<!--
https://codepen.io/mican/pen/awxmpY

https://freefrontend.com/css-gallery/


version 2
https://codepen.io/mican/pen/RyjZgm
-->
<x-layout>

        @foreach(\App\Models\Image::all() as $i)
            @php
                $height = $i->height();
                $width = $i->width();
            @endphp
            <a class="gallery-link">
                <figure class="gallery-image">
                    <img height="{{$height }}" src="{{$i->url}}" width="{{$width }}"/>
                    <figcaption>Photo caption</figcaption>
                </figure>
            </a>
        @endforeach
</x-layout>
