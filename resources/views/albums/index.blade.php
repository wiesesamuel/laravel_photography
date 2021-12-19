<x-layout>
    @include('albums._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($albums->count())
            @if (request('page') > 1)
                {{$albums->links()}}
            @endif
{{--                    <x-albums.grid.dense-grid-layout>--}}
{{--                @foreach($albums as $album)--}}
{{--                    <x-albums.grid.dense-grid-element--}}
{{--                        :horizontal="$album->coverImage->horizontal"--}}
{{--                    >--}}
{{--                        <x-albums.image--}}
{{--                            :image="$album->coverImage"--}}
{{--                        />--}}
{{--                    </x-albums.grid.dense-grid-element>--}}
{{--                @endforeach--}}
{{--            </x-albums.grid.dense-grid-layout>--}}
            <x-albums.albums-grid :albums="$albums"></x-albums.albums-grid>
            {{$albums->links()}}
        @else
            <p class="text-center">No albums yet. Please come back later.</p>
        @endif
    </main>
</x-layout>

