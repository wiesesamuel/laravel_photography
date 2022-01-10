<x-layout>
    @include('albums._header')

        @if ($albums->count())
        <h3 class="text-3xl font-medium leading-tight mt-0 mb-2 text-white text-center underline">Alben</h3>
{{--            <x-parts.header-h1>Alben</x-parts.header-h1>--}}
            @if (request('page') > 1)
                {{$albums->links()}}
            @endif
    <main class="mx-auto mt-6">
            <x-gallery.a-magnificant-gallery>
                @foreach($albums as $album)
                    @if ($album != null)
                        <x-gallery.a-magnificant-image
                            :href="route('album', $album)"
                            :width="$album->coverImage->Width"
                            :height="$album->coverImage->Height"
                            :url="$album->coverImage->url"
                            :caption="$album->title"
                        />
                    @endif
                @endforeach
            </x-gallery.a-magnificant-gallery>
            {{$albums->links()}}
        @else
            <p class="text-center">No albums yet. Please come back later.</p>
        @endif
    </main>
</x-layout>

