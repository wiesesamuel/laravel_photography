<x-layout>

<div
    class="w-full h-full flex items-center justify-center"
    x-data="{ open: false }"
    @keydown.escape="open = false"
>
    <button class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-4 rounded focus:outline-none" @click="open = true">
        Otevřít galerii
    </button>

    <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show.transition="open">
        <div class="flex items-center justify-start w-12 m-2 ml-6 mb-4 md:m-2 z-50 absolute bottom-0 transform translate-x-12 md:translate-x-32">
            <button
                class="text-white w-12 h-12 rounded-full flex items-center justify-center focus:outline-none"
                style="background-color: rgba(0,0,0,.4);"
                @click="open = false">
                <img src="https://obr.now.sh/remixicon/system/close-fill/64/ffffff" class="w-6 h-6">
            </button>
        </div>
        <div class="h-full w-full flex items-center justify-center overflow-hidden" x-data="{activeSlide: 0, slides: ['https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/40/70/b7f0a6fe156a4cb178c045360b48ad23eaa4.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/41/3e/b579add17b370dbf55964d52dd54a4595643.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/b8/8a/e7942d72cb11ed444b1dccd5edda46c8c84b.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/e3/1e/e3c34dc2a02c202dbcca2ef0117eee5fc29c.jpg', 'https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/4e/1a/ba4810652d072eee7dfb8eb818a9b36e0b55.jpg','https://s3.eu-central-1.amazonaws.com/mmreality-2019-testing/medium2/offer/e5/33/4546373d4889bc623e33c95ceae0137dd7bd.jpg']}">


            <template x-for="(slide, index) in slides" :key="index">
                <div class="h-full w-full flex items-center justify-center absolute">
                    <div class="absolute top-0 bottom-0 py-2 md:py-24 px-2 flex flex-col items-center justify-center"
                         x-show="activeSlide === index"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 transform scale-90"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-90">

                        <img :src="slide" class="object-contain max-w-full max-h-full rounded shadow-lg" />
                        <div
                            class="bg-white rounded-full flex-shrink-0 px-3 py-1 shadow-sm leading-tight text-xs lg:text-sm max-w-sm text-center mx-4 mt-4 hidden md:block"
                        >
                            Prodej, byt 3+kk, 70 m², Pardubice, ul. 17. listopadu <span x-text="index + 1"></span>
                        </div>
                    </div>
                    <div class="fixed text-white text-sm font-bold bottom-0 transform -translate-x-10 w-40 h-12 mb-2 hidden md:flex justify-center items-center"
                         x-show="activeSlide === index">
                        <span class="w-12 text-right" x-text="index + 1"></span>
                        <span class="w-4 text-center">/</span>
                        <span class="w-12 text-left" x-text="slides.length"></span>
                    </div>
                </div>
            </template>

            <div class="fixed z-30 bottom-0 mb-4 md:mb-2 transform -translate-x-8 md:-translate-x-10 flex justify-center">
                <div class="flex items-center justify-end w-12 mr-3 md:mr-16">
                    <button
                        type="button"
                        class="w-12 h-12 rounded-full focus:outline-none flex items-center justify-center"
                        style="background-color: rgba(0,0,0,.4);"
                        @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1">
                        <img src="https://obr.now.sh/remixicon/system/arrow-left-s-line/64/ffffff" class="w-6 h-6">
                    </button>
                </div>
                <div class="flex items-center justify-start w-12 md:ml-16">
                    <button
                        type="button"
                        class="text-white font-bold w-12 h-12 rounded-full focus:outline-none flex items-center justify-center"
                        style="background-color: rgba(0,0,0,.4);"
                        @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1">
                        <img src="https://obr.now.sh/remixicon/system/arrow-right-s-line/64/ffffff" class="w-6 h-6">
                    </button>
                </div>
            </div>


        </div>
    </div>
</div>
</x-layout>
