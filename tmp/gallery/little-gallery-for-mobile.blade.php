@props(['images'])

<style>
    #gallerySection {
        display: flex;
        flex-wrap: wrap;
    }
    #gallerySection::after {
        content: '';
        flex-grow: 999999999;
    }
    .galleryDiv {
        margin: 2px;
        position: relative;
    }
    .galleryI{
        display: block;
    }
    .galleryImg {
        position: absolute;
        top: 0;
        width: 100%;
        vertical-align: bottom;
    }
</style>

<section id="gallerySection">
    @foreach($images as $img)
        @if($img->height() == 0) @dd($img) @endif
    <div class="galleryDiv" style="width:{{($img->width()*200/$img->height())*1,5}}px;flex-grow:{{($img->width()*200/$img->height())*3}};flex-shrink:99;">
        <i class="galleryI" style="padding-bottom:{{($img->height()/$img->width()*100)}}%"></i>
        <img class="galleryImg" src="{{$img->url}}" alt="">
    </div>
    @endforeach
</section>
