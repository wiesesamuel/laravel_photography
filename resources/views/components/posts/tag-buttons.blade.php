@props(['tags'])
@foreach($tags as $tag)
    <a href="/?tag={{$tag->slug}}"
       class="px-3 py-1 border border-green-300 rounded-full text-green-300 text-xs uppercase font-semibold"
       style="font-size: 10px">{{$tag->name}}</a>
@endforeach
