https://codepen.io/cazpa/details/LYWGpyO

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alpine Js</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <style>
        [x-cloak]{
            display: none;
        }
        body{
            font-family: 'Quicksand', sans-serif;
        }
        .scroll{
            display: flex;
            flex-wrap: nowrap;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }
        /* iOS devices */
        @supports (-webkit-overflow-scrolling: touch) {
            .scroll {
                -webkit-overflow-scrolling: touch;
            }
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .scroll-behavior-smooth{
            scroll-behavior: smooth;
        }
        .snap {
            scroll-snap-type: var(--scroll-snap-direction) var(--scroll-snap-constraint);
        }
        .snap-y {
            --scroll-snap-direction: y;
        }
        .snap-x {
            --scroll-snap-direction: x;
        }
        .snap-mandatory {
            --scroll-snap-constraint: mandatory;
        }
        .snap-start {
            scroll-snap-align: start;
        }


    </style>

</head>

<body>

<div class="grid grid-cols-12 w-full lg:max-w-7xl mx-auto lg:p-4">
    <div class="col-span-12 lg:col-span-6 lg:mr-2">
        <div class="transition-all duration-1000 ease-in-out w-full"
             x-data="ProductGallery"
             x-init="init($el); $watch('activeImage', value => scroll());"
             :class="{ 'fixed top-0 bottom-0 right-0 left-0 z-50 w-screen h-screen overflow-hidden bg-white flex flex-col gap-4 p-6': isOpen }">

            <div class="text-right" x-show="isOpen" x-cloak>
                <a href="#" @click.prevent="toggleImage">
                    <i class="fas fa-times text-2xl text-indigo-600"></i>
                </a>
            </div>

            <ul class="flex flex-grow-1 flex-nowrap overflow-x-scroll whitespace-nowrap snap snap-x snap-mandatory no-scrollbar scroll-behavior-smooth pb-6" @wheel="mousewheelEvent($event)">
                <template x-for="(image, i) in images" :key="image">
                    <li class="w-full flex-shrink-0 snap-start">
                        <a href="#" @click.prevent="if(!isOpen){toggleImage()}">
                            <img :src="image.url" class="m-auto max-h-full max-w-full">
                        </a>
                    </li>
                </template>
            </ul>

            <div class="m-auto max-w-full">
                <div class="flex" x-show="images.length>1" x-cloak>
                    <a class="h-28 flex-grow-0 text-indigo-600 inline-flex items-center text-xl bg-white p-4" href="#"
                       @click.prevent="prev">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <ul class="flex flex-grow-1 flex-nowrap overflow-x-scroll whitespace-nowrap snap snap-x snap-mandatory no-scrollbar scroll-behavior-smooth">
                        <template x-for="(image, i) in images" :key="image">
                            <li class="w-28 flex-shrink-0 snap-start  mx-1" @wheel="mousewheelEvent($event)">
                                <a class="inline-block border-4" href="#" @click.prevent="activeImage=i"
                                   :class="{'border-indigo-600': activeImage==i, 'border-white': activeImage!=i}">
                                    <img :src="image.thumb" class="" height="150" width="150">
                                </a>
                            </li>
                        </template>
                    </ul>
                    <a class="h-28 flex-grow-0 inline-flex items-center text-xl text-indigo-600 bg-white p-4" href="#"
                       @click.prevent="next">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="col-span-12 lg:col-span-6 lg:ml-2">
        <h1 class="text-3xl font-bold mb-4">Super Cool Cat Calendar</h1>
        <div class="mb-4">
            <i class="fas fa-star text-indigo-400"></i>
            <i class="fas fa-star text-indigo-400"></i>
            <i class="fas fa-star text-indigo-400"></i>
            <i class="fas fa-star text-indigo-400"></i>
            <i class="fas fa-star text-indigo-400"></i>
            <i class="far fa-star text-indigo-400"></i>
            <i class="far fa-star text-indigo-400"></i>
        </div>

        <div class="mb-4 pb-4 border-b-2">The purrrfect gift for yourself and anyone else! 12 furmidable pages to stay pawsitive the whole year. Style your home with the meowst cattitude possible.</div>
        <div class="flex w-full justify-between">
            <div class="text-gray-400 mr-4 py-3">
                <span>only</span> <span class="text-2xl font-bold text-indigo-600">13.37 $</span>
            </div>
            <button class="bg-indigo-600 text-white text-lg font-bold width-auto px-4 py-1 shadow-lg hover:text-indigo-600 hover:bg-white transition-colors">Buy now</button>
        </div>


    </div>
<div x-data="{ show: false }">
    <button @click="show = !show">Show</button>
    <h1 x-show="show">Alpine Js is working !</h1>
</div>
<hr>

<div x-data>
    <button @click="alert('Alpine Js is working !')">Click</button>
</div>
</body>

<script>

    var images = [
        {url: 'https://source.unsplash.com/gKXKBY-C-Dk/1920x1080', 'thumb': 'https://source.unsplash.com/gKXKBY-C-Dk/400x400'},
        {url: 'https://source.unsplash.com/9UUoGaaHtNE/1920x1080', 'thumb': 'https://source.unsplash.com/9UUoGaaHtNE/400x400'},
        {url: 'https://source.unsplash.com/w2DsS-ZAP4U/1920x1080', 'thumb': 'https://source.unsplash.com/w2DsS-ZAP4U/400x400'},
        {url: 'https://source.unsplash.com/cWOzOnSoh6Q/1920x1080', 'thumb': 'https://source.unsplash.com/cWOzOnSoh6Q/400x400'},
        {url: 'https://source.unsplash.com/NodtnCsLdTE/1920x1080', 'thumb': 'https://source.unsplash.com/NodtnCsLdTE/400x400'},
        {url: 'https://source.unsplash.com/eMzblc6JmXM/1920x1080', 'thumb': 'https://source.unsplash.com/eMzblc6JmXM/400x400'},
        {url: 'https://source.unsplash.com/so5nsYDOdxw/1920x1080', 'thumb': 'https://source.unsplash.com/so5nsYDOdxw/400x400'},
        {url: 'https://source.unsplash.com/GtwiBmtJvaU/1920x1080', 'thumb': 'https://source.unsplash.com/GtwiBmtJvaU/400x400'},
        {url: 'https://source.unsplash.com/YCPkW_r_6uA/1920x1080', 'thumb': 'https://source.unsplash.com/YCPkW_r_6uA/400x400'},
        {url: 'https://source.unsplash.com/IbPxGLgJiMI/1920x1080', 'thumb': 'https://source.unsplash.com/IbPxGLgJiMI/400x400'},
        {url: 'https://source.unsplash.com/Hd7vwFzZpH0/1920x1080', 'thumb': 'https://source.unsplash.com/Hd7vwFzZpH0/400x400'},
        {url: 'https://source.unsplash.com/0F7GRXNOG7g/1920x1080', 'thumb': 'https://source.unsplash.com/0F7GRXNOG7g/400x400'},
    ];

    window.ProductGallery = {
        $el: null,
        images: null,
        activeImage: 0,
        isOpen: false,
        $imageEl: null,
        $thumbNavEl: null,
        init( $el ){
            this.$el = $el;
            this.$imageEl = $el.querySelectorAll('ul')[0];
            this.$thumbNavEl = $el.querySelectorAll('ul')[1];
            this.images = images;
        },
        next: function(){
            this.activeImage = this.activeImage+1 < this.images.length ? this.activeImage+1 : 0;
        },
        prev: function(){
            this.activeImage = this.activeImage > 0 ? this.activeImage-1 : this.images.length-1;
        },
        mousewheelEvent: function(event){
            if(event.deltaY > 0){
                this.next();
                event.preventDefault();
            } else if(event.deltaY < 0){
                this.prev();
                event.preventDefault();
            }
        },
        scroll: function(){
            this.scrollToImage();
            this.scrollToThumb();
        },
        scrollToThumb: function(){
            const $activeThumb = this.$thumbNavEl.querySelector('ul li:nth-child(0n+'+(this.activeImage+2)+')');
            this.$thumbNavEl.scrollLeft = ($activeThumb.offsetLeft-$activeThumb.clientWidth) - (this.$thumbNavEl.clientWidth/2) + ($activeThumb.clientWidth/2);
        },
        scrollToImage: function(){
            const $activeImage = this.$imageEl.querySelector('ul li:nth-child(0n+'+(this.activeImage+2)+')');
            this.$imageEl.scrollLeft = $activeImage.offsetLeft - (this.$thumbNavEl.clientWidth/2);
        },
        toggleImage: function(){
            this.isOpen ? this.close() : this.open();
            // wait for css rendering then scroll to active image
            let _this = this;
            setTimeout(function(){
                _this.scroll();
            }, 100);
        },
        open: function(){
            document.body.style.overflowY = 'hidden';
            document.body.style.height = '100vh';
            this.isOpen = true;
        },
        close: function(){
            document.body.style.overflowY = null;
            document.body.style.height = null;
            this.isOpen = false;
        }
    };


</script>

</html>
