<?php

namespace App\Helper;

use App\Models\Album;
use App\Models\Image;
use Intervention\Image\ImageManagerStatic as ImageBuilder;

/**
 *
 */
class AlbumImageHelper
{
    protected $fileManager;

    public function __construct()
    {
        $this->fileManager = new FileHelper();
        ImageBuilder::configure(array('driver' => 'gd'));
    }

    /**
     * @param $dir
     * @return string|void Message
     */
    public function importAlbum($dir)
    {
        // check if dir exists and is not empty
        if (is_dir($dir) && !((count(scandir($dir)) == 2))) {

            $images = $this->createImages($dir);
            $album = $this->createAlbum($dir, $images);

            return "Album $album->title was successfully re/imported with " . count($images) . " Images";
        }

        return "Album $dir does not exist or is empty";
    }

    /**
     * @param $dir
     * @return array Messages
     */
    public function importAlbums($dir)
    {
        $msg = array();

        // check if dir exists and is not empty
        if (is_dir($dir) && !((count(scandir($dir)) == 2))) {
            $dirs = $this->fileManager->getSubdirectoriesFromDirectory($dir);

            foreach ($dirs as $dir) {
                $msg[] = $this->importAlbum($dir);
            }
        }

        return $msg;
    }

    private function albumExists($dir)
    {
        return (bool)Album::where('absolute_path', '=', $dir);
    }

    private function imageExists($path)
    {
        return (bool)Image::where('absolute_path', '=', $path);

    }

    private function createAlbum($dir, $images)
    {
        $album = Album::updateOrCreate(
            ['absolute_path' => $dir],
            [
                'dir_name' => basename($dir),
                'image_id' => $images[0]->id
            ]
        );

        $imageIds = array_map(
            function ($model) {
                return $model->id;
            },
            $images
        );

        $album->images()->sync($imageIds);

        return $album;
    }

    private function createImages($dir)
    {
        $images = array();
        foreach ($this->fileManager->getImagePaths($dir) as $name => $path) {
            $images[] = Image::updateOrCreate(
                ['absolute_path' => $path, 'file_name' => $name],
                $this->getMetaData($path)
            );
        }
        return $images;
    }

    private function getMetaData($imagePath)
    {
        try {

            $metadata = exif_read_data($imagePath);

            $height = $metadata['COMPUTED']['Height'] ?? null;
            $width = $metadata['COMPUTED']['Width'] ?? null;

            return [
                'Artist' => 'Samuel Wiese',
//              'Artist' => $metadata['Artist'] ?? null,

                'title' => $metadata['FileName'] ?? null,
                'url' => str_replace(public_path(), '', $imagePath),

                'DateTime' => $metadata['DateTimeOriginal'] ?? null,
                'CCDWidth' => $metadata['CCDWidth'] ?? null, // mm
                'ExposureTime' => $metadata['ExposureTime'] ?? null, // beleuchtung
                'ApertureNumber' => $metadata['ApertureFNumber'] ?? null, // Blende
                'Camera' => $metadata['Model'] ?? null,
                'CameraLens' => $metadata['UndefinedTag:0x0095'] ?? null,
//              'CameraLens' => $metadata['UndefinedTag:0xA434'],

                'Height' => $height,
                'Width' => $width,

                'horizontal' => ($metadata["Orientation"] ?? 999) <= 1,
            ];
        } catch (ErrorException $e) {
            return [];
        }
    }

}
