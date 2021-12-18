@props(['images'])

@if($images->count() > 0)
    <div class="container mx-auto">
        <div class="grid-cols-3 p-20 space-y-2 bg-yellow-200 lg:space-y-0 lg:grid lg:gap-3 lg:grid-rows-3">
            @foreach($images as $image)
                    <x-albums.image
                        :image="$image"
{{--                        class="{{$loop->iteration == 3 ? 'col-span-2 row-span-2' : ''}}"--}}
                    />
                </div>
            @endforeach
        </div>
    </div>
@endif
