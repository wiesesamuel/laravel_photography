<?php

namespace App\Services;

use App\Jobs\CollectArtistInstagramData;
use App\Models\Artist;
use Illuminate\Support\Facades\Cache;

class ArtistHandleData
{
    private $cacheCallback;

    /**
     * ArtistHandleData constructor.
     * @param $fileCache
     */
    public function __construct($fileCache = false)
    {
        if ($fileCache) {
            $this->cacheCallback = ArtistHandleData::class . self::writeCache(null);
        }
    }

    public static function writeCache(Artist $artist)
    {
        Cache::store('fileArtists')->forever('Artist_' . $artist->id, $artist->getAttributes());
    }

    public static function getCache(Artist $artist)
    {
        return Cache::store('fileArtists')->get('Artist_' . $artist->id, false);
    }

    public function updateAll()
    {
        $artists = Artist::orderBy('updated_at', 'DESC')->get();
        foreach ($artists as $artist) {
            $this->update($artist);
        }
    }

    public function update(Artist $artist)
    {
        CollectArtistInstagramData::dispatch(
            $artist,
            $this->cacheCallback
        );
    }
}
