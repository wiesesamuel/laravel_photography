@props(['tags'])
@foreach($tags as $tag)
    <a href="{{route('posts')}}?tag={{$tag->slug}}&{{http_build_query(request()->except('tag', 'page'))}}"
       class="px-3 py-1 border border-green-300 rounded-full text-green-300 text-xs uppercase font-semibold"
       style="font-size: 10px">{{$tag->name}}</a>
@endforeach
