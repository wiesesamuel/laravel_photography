<?php

namespace App\Services;

use App\Helper\InstagramHelper;
use App\Jobs\CalculateDataJob;
use App\Jobs\CollectArtistInstagramData;
use App\Models\Artist;
use Throwable;

class UpdateArtistData
{
    public function updateAll()
    {
        $artists = Artist::orderBy('updated_at', 'DESC')->get();
        foreach ($artists as $artist) {
            CollectArtistInstagramData::dispatch($artist);
        }
    }

    public function updateInstagram($artists)
    {
        $insta = new InstagramHelper();
        foreach ($artists as $artist) {
            try {
                $artist->instagram_data = $insta->getInstagramInfoOrFail($artist->instagram_url);
                $artist->save();
            } catch (Throwable $e) {
                return false;
            }
        }
        return true;
    }
}
