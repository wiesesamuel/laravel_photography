@props(['images'])

{{--@if($images->count() > 0)--}}
{{--    <div class="container mx-auto">--}}
{{--        <div class="grid-cols-3 p-20 space-y-2 bg-yellow-200 lg:space-y-0 lg:grid lg:gap-3 lg:grid-rows-3">--}}
{{--            @foreach($images as $image)--}}
{{--                <x-albums.image--}}
{{--                    :image="$image"--}}
{{--                    --}}{{--                        class="{{$loop->iteration == 3 ? 'col-span-2 row-span-2' : ''}}"--}}
{{--                />--}}
{{--        </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    </div>--}}
{{--@endif--}}


<div class="container mx-auto p-8">
    <div class="flex flex-row flex-wrap -mx-2">
        <div class="w-full md:w-1/2 h-64 md:h-auto mb-4 px-2">
            @if($images->count() > 0)
                <x-albums.image
                    :image="$images[0]"
                    class="block w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover"
                />
            @endif
        </div>
        <div class="w-full md:w-1/2 mb-4 px-2">
            <div class="flex flex-col sm:flex-row md:flex-col -mx-2">
                <div class="w-full sm:w-1/2 md:w-full h-48 xl:h-64 mb-4 sm:mb-0 md:mb-4 px-2">
                    @if($images->count() > 1)
                        <x-albums.image
                            :image="$images[1]"
                         class="block w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover"
                        />
                    @endif

                </div>
                <div class="w-full sm:w-1/2 md:w-full h-48 xl:h-64 px-2">
                    @if($images->count() > 2)
                        <x-albums.image
                            :image="$images[2]"
                         class="block w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover"
                        />
                    @endif
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/3 h-32 md:h-48 mb-4 sm:mb-0 px-2">
            @if($images->count() > 3)
                <x-albums.image
                    :image="$images[3]"
                    class="block w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover"
                />
            @endif
        </div>
        <div class="w-full sm:w-1/3 h-32 md:h-48 mb-4 sm:mb-0 px-2">
            @if($images->count() > 4)
                <x-albums.image
                    :image="$images[4]"
                    class="block w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover"
                />
            @endif
        </div>
        <div class="w-full sm:w-1/3 h-32 md:h-48 px-2">
            @if($images->count() > 5)
                <x-albums.image
                    :image="$images[5]"
                    class="block w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover"
                />
            @endif
        </div>
    </div>
</div>
