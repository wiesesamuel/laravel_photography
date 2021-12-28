<?php


namespace App\Helper;


use App\Models\Album;
use App\Models\Image;
use Throwable;

/**
 * Handles Album related Config files and adds them in the database
 */
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

        $cover_image = 1;
        foreach ($album->images as $image) {
            foreach ($data["images"] as $imageData) {
                $res = Image::where('id', $image->id)->where('file_name', $image->file_name);
                if ($res != null) {
                    if ($image->file_name == $data['cover_image']) {
                        $cover_image = $image->id;}
                    $res->update($imageData);
                }

            }
        }

        Album::where('id', $album->id)->update([
            "title" => $data['title'],
            "image_id" => $cover_image,
        ]);

    }

    public function deleteConfigs($albums) {
        foreach ($albums as $album) {
            $this->deleteConfig($album);
        }
    }

    public function deleteConfig($album) {
        if ($this->configExists($album)) {
            unlink($album->absolute_path . '/config.json');
        }
    }

    public function makeAlbumConfigs($albums) {
        foreach ($albums as $album) {
            $this->makeAlbumConfig($album);
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
                "orientation" => $this->getOrientatedImage($image->absolute_path),
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
            $data = json_decode(file_get_contents($album->absolute_path . '/config.json'), true);
        } catch (Throwable $e) {
            $data = null;
        }
        return $data;
    }

    private function getOrientatedImage($original)
    {
        $exif = exif_read_data($original);
        if (!empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 8:
                case 6:
                    // +-90
                    return "vertical";
                case 3:
                    // 180
                    return "horizontal";

            }
        }
        return "horizontal";
    }



}
