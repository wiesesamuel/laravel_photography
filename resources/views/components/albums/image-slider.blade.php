@props(['images'])

@if($images->count() > 0)
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($images as $image)
                <div class="swiper-slide">
                    <img
                        class="object-cover w-full h-96"
                        src="{{$image->url}}"
                        title="{{$image->name}}"
                        alt="{{$image->description}}"
                    />
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.mySwiper', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

@endif
