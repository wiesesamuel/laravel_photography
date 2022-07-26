<x-layout>
    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
            @if (request('page') > 1)
                {{$posts->links()}}
            @endif
            <x-posts.posts-grid :posts="$posts"></x-posts.posts-grid>
            {{$posts->links()}}
        @else
            <p class="text-center">No posts yet. Please come back later.</p>
        @endif
    </main>
</x-layout>

