<x-layout>
    @include('albums._header')
    <h3 class="text-3xl font-medium leading-tight mt-0 mb-2 text-white text-center underline">{{$album->title ?? ''}}</h3>
    <main class="mx-auto mt-6">
        <x-gallery.a-magnificant-gallery>
            @foreach($album->images as $image)
                @if ($image != null)
                    <x-gallery.a-magnificant-image
                        {{--:href="route('album', $album)"--}}
                        :width="$image->Width"
                        :height="$image->Height"
                        :url="$image->url"
                        :caption="$image->title"
                    />
                @endif
            @endforeach
        </x-gallery.a-magnificant-gallery>

    </main>
</x-layout>
