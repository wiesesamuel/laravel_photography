<?php


namespace App\Helper;


use App\Models\Album;
use App\Models\Image;
use Throwable;

class AlbumConfigHelper
{
    protected $fileManager;

    public function __construct()
    {
        $this->fileManager = new FileHelper();
    }

    /**
     * @param $albums
     */
    public function importConfigs($albums)
    {
        foreach ($albums as $album) {
            $this->importConfig($album);
        }
    }

    /**
     * @param $album
     */
    public function importConfig($album)
    {
        if (!$this->configExists($album)) {
            $data = $this->makeAlbumConfig($album);
        } else {
            $data = $this->readValidConfigOrFail($album) ?? $this->makeAlbumConfig($album);
        }

        Album::where('id', $album->id)->update([
            "title" => $data['title'],
            "description" => $data['description'],
            "orientation" => $data['orientation'],
        ])->save();

        foreach ($album->images as $image) {
            foreach ($data["images"] as $imageData) {
                Image::where('id', $image->id)->where('file_name', $image->file_name)->update($imageData)->save();
            }
        }
    }

    /**
     * @param $album
     * @return array
     */
    public function makeAlbumConfig($album)
    {
        $images = array();
        foreach ($album->images as $image) {
            $data = [
                "title" => $image->file_name,
                "description" => "",
                "orientation" => $image->horizontal,
            ];
            $images[$image->file_name] = $data;
        }

        $data = [
            "title" => $album->dir_name,
            "description" => "",
            "cover_image" => ($album->coverImage->file_name) ?? $images[0]->file_name,
            "images" => $images,
        ];

        file_put_contents($album->absolute_path . '/config.json', json_encode($data, JSON_PRETTY_PRINT));
        return $data;
    }

    private function configExists($album)
    {
        return file_exists($album->absolute_path . '/config.json');
    }

    private function readValidConfigOrFail($album)
    {
        try {
            $data = json_decode(file_get_contents($album->absolute_path . '/config.json'));
        } catch (Throwable $e) {
            $data = null;
        }
        return $data;
    }


}
