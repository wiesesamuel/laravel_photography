<x-layout>
    <main>
        <x-albums.image-slider
            :images="$album->images"
        />
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
