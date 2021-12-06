<x-layout>
    <x-slot name="content">

        <article>
            <h1>{{ $post->title }}</h1>
            <p>
                <a href="#"> {{$post->user->name}}</a>
                <a href="/categories/{{$post->category->slug}}"> {{$post->category->name}}</a>
            </p>
            <div>
                {!! $post->body !!}
            </div>
        </article>
    <a href="/">Go Back</a>
    </x-slot>
</x-layout>
