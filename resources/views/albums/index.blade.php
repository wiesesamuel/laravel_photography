<x-layout>
    @include('albums._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($albums->count())
            @if (request('page') > 1)
                {{$albums->links()}}
            @endif
            {{$albums}}
{{--                <x-posts.posts-grid :posts="$posts"></x-posts.posts-grid>--}}
            {{$albums->links()}}
        @else
            <p class="text-center">No posts yet. Please come back later.</p>
        @endif
    </main>
</x-layout>

