<!--
https://codepen.io/mican/pen/awxmpY

https://freefrontend.com/css-gallery/


version 2
https://codepen.io/mican/pen/RyjZgm
-->

<article class="gallery">
    @foreach(\App\Models\Image::all() as $i)
    @php
        $height = $i->height();
        $width = $i->width();
     @endphp
    <a class="gallery-link" href="https://unsplash.it/{{$width }}/{{$height }}?image={{$i }}">
        <figure class="gallery-image">
            <img height="{{$height }}" src="{{$i->url}}" width="{{$width }}"/>
            <figcaption>Photo caption</figcaption>
        </figure>
    </a>
    @endforeach
</article>
<footer id="footer" role="contentinfo">
    <div class="container">
        <a class="logo" href="https://codepen.io/collection/XRoxGR" rel="home">Calibration theme</a>
        <a class="copy" href="https://mobilemarkup.com" target="_blank">&copy; mobileMarkup.com</a>
    </div>
</footer>
