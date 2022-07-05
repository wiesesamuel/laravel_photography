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
        Cache::store('fileArtists')->forever('Artist_' . $artist->username, $artist->getAttributes());
    }

    public static function getCache(Artist $artist)
    {
        return Cache::store('fileArtists')->get('Artist_' . $artist->username, false);
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
        $cache = self::getCache($artist);
        if ($cache) {
            var_dump($cache);
        }

        if (false === $cache) {
            CollectArtistInstagramData::dispatch(
                $artist,
                $this->cacheCallback
            );
        }
    }
}
