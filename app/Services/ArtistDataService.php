<?php

namespace App\Services;

use App\Http\Controllers\ArtistController;
use App\Jobs\CollectArtistInstagramData;
use App\Models\Artist;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;

class ArtistDataService
{

    public static function writeCache(Artist $artist)
    {
        Cache::store('fileArtists')->forever('Artist_' . $artist->username, $artist->getAttributes());
    }

    public static function getCache(Artist $artist)
    {
        return Cache::store('fileArtists')->get('Artist_' . $artist->username, []);
    }


    public function hardUpdateAll()
    {
        $artists = Artist::all();
        foreach ($artists as $artist) {
            $this->hardUpdate($artist);
        }
    }


    public function softUpdateAll()
    {
        $artists = Artist::all();
        foreach ($artists as $artist) {
            $this->softUpdate($artist);
        }
    }

    public function softUpdate(Artist $artist)
    {
        if ($artist->created_at >= $artist->updated_at) {
            $cache = self::getCache($artist);
            if ($cache) {

                // update artist with cache data
                $artist = ArtistController::updateOrCreateArtist($cache);
            }
        }
        if ($artist->created_at >= $artist->updated_at || $artist->updated_at <= Carbon::now()->subDays(7)->toDateTimeString()) {
            $this->hardUpdate($artist);
        }
    }

    /**
     * @param Artist|null $artist
     */
    public function hardUpdate(?Artist $artist): void
    {
        /*
        $result = (new InstagramHelper())->getInstagramInfoOrFail($artist->instagram_url);
        $artist->instagram_data = $result;
        $artist->saveAndCache();
        */
        CollectArtistInstagramData::dispatch(
            $artist
        );
    }

    public function seedByLocalFilesAndUpdateByCache()
    {
        $files = File::allFiles(config('files.artists.config_absolute_path'));

        foreach ($files as $file) {
            if ($file->getExtension() == 'yaml') {
                $fileContent = $file->getContents();
                $data = Yaml::parse($fileContent, Yaml::PARSE_OBJECT_FOR_MAP);
                foreach ($data->artists as $key => $value) {
                    $arr = [];
                    self::addValueToArrayIfNotNull($arr, 'username', $value->username ?? null);
                    self::addValueToArrayIfNotNull($arr, 'instagram_url', $value->instagram_url ?? null);
                    self::addValueToArrayIfNotNull($arr, 'youtube_url', $value->youtube_url ?? null);
                    self::addValueToArrayIfNotNull($arr, 'website_url', $value->website_url ?? null);
                    self::addValueToArrayIfNotNull($arr, 'created_at', $value->created_at ?? null);
                    self::addValueToArrayIfNotNull($arr, 'updated_at', $value->updated_at ?? null);

                    $artist = ArtistController::updateOrCreateArtist($arr);
                    if ($artist) {
                        $cache = ArtistDataService::getCache($artist);
                        $artist = ArtistController::updateOrCreateArtist($cache);
                    }
                }

            }
        }
    }

    protected static function addValueToArrayIfNotNull(array &$arr, string $name, $value)
    {
        if (isset($value) && $value != null) {
            $arr[$name] = $value;
        }
    }

}
