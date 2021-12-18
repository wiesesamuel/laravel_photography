@props(['album'])
<div class="my-1 px-1 w-1/2 overflow-hidden
{{--ToDo fix grid layout--}}
@if (isset($album->coverImage->horizontal) && ($album->coverImage->horizontal == 1))
    object-scale-down
@else
            object-contain hover:object-scale-down
@endif
            sm:my-1 sm:px-1 sm:w-1/2
            md:my-1 md:px-1 md:w-1/2
            lg:my-1 lg:px-1 lg:w-1/3
            xl:my-1 xl:px-1 xl:w-1/3 ">
    <img
        src="{{$album->coverImage->url}}"
        title="{{$album->name}}"
        alt="{{$album->description}}"
        onclick="document.location='/albums/{{$album->id}}'; return false;"
    >
</div>
