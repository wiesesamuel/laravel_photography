<?php

namespace App\Services;

use App\Helper\InstagramHelper;
use App\Http\Controllers\ArtistController;
use App\Models\Artist;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class ArtistDataService
{

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
            // update artist with cache data
            $artist = ArtistController::updateOrCreateArtist($cache);

            if ($artist->updated_at <= Carbon::now()->subDays(7)->toDateTimeString()) {
                // trigger update
                $cache = false;
            }
        }

        if (false === $cache) {
            $result = (new InstagramHelper())->getInstagramInfoOrFail($artist->instagram_url);
            $artist->instagram_data = $result;
            $artist->save();
            self::writeCache($artist);

            /*
            CollectArtistInstagramData::dispatch(
                $artist,
                $this->cacheCallback
            );
            */
        }
    }
}
