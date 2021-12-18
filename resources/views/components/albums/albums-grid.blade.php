@if($albums->count() > 0)
<div class="flex flex-wrap -mx-1 overflow-hidden
sm:-mx-1
md:-mx-1
lg:-mx-1
xl:-mx-1">

    @foreach($albums as $album)
        <x-albums.album-front-card
            :album="$album"
            />
    @endforeach

</div>
@endif
