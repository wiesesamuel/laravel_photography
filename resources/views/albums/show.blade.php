<x-layout>
    @include('albums._header')
    <x-albums.image-slider
            :images="$album->images"
        />
    <main class="max-w-6xl mx-auto mt-6 space-y-6">

        <x-albums.grid.dense-grid-layout>
            @foreach($album->images as $image)
                <x-albums.grid.dense-grid-element
                    :horizontal="$image->horizontal"
                >
                    <x-albums.image
                        :image="$image"
                        onclick="document.location='/images/{{$image->id}}'; return false;"
                    />
                </x-albums.grid.dense-grid-element>
            @endforeach
        </x-albums.grid.dense-grid-layout>

    </main>
</x-layout>
