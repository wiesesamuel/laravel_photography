<?php

namespace App\Services;

use App\Helper\InstagramHelper;
use App\Models\Artist;
use Throwable;

class ArtistUpdateService
{
    public function updateAll()
    {
        $artists = Artist::orderBy('updated_at', 'DESC')->get();
        $this->updateInstagram($artists);
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
