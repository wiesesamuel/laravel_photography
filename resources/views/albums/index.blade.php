<x-layout>
    @include('albums._header')

    <main class="max-w-6xl mx-auto mt-6 space-y-6">
        @if ($albums->count())
            <x-parts.header-h1>Alben</x-parts.header-h1>
            @if (request('page') > 1)
                {{$albums->links()}}
            @endif
            <x-albums.grid.dense-grid-layout>
                @foreach($albums as $album)
                    @if ($album != null)
                        <x-albums.grid.dense-grid-element
                            :horizontal="$album->coverImage->orientation"
                        >
                            <x-albums.image
                                :image="$album->coverImage"
                                onclick="document.location='{{route('album', $album)}}'; return false;"
                            />
                        </x-albums.grid.dense-grid-element>
                    @endif
                @endforeach
            </x-albums.grid.dense-grid-layout>
            {{--            <x-albums.albums-grid :albums="$albums"></x-albums.albums-grid>--}}
            {{$albums->links()}}
        @else
            <p class="text-center">No albums yet. Please come back later.</p>
        @endif
    </main>
</x-layout>

