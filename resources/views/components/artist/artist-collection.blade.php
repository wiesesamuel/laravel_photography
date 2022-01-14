<div>
    @foreach($artists as $artist)
        <x-artist
            :artist="$artist"
        />
    @endforeach
</div>
