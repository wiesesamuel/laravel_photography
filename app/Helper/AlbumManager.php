<?php

namespace App\Helper;

use App\Helper\FileManager;
use App\Models\Album;
use App\Models\Image;
use DirectoryIterator;


class AlbumManager
{

    protected $fileManager;

    public function __construct()
    {
        $this->fileManager = new FileManager();;
    }


    public function discoverAlbums()
    {
//        $this->fileManager->destroyAllLockFilesInSubdirectories(public_path('/images/albums'));
        $this->createAlbums($this->getUnlockedAlbumsFilesAndLockThem());
        (new LanguageManager())->simplifyLocationJsons();
    }

    private function createAlbums($albumsArray)
    {
        foreach ($albumsArray as $albumName => $imagesArray) {
            $imageModels = $this->createImages($imagesArray);
            $albumModel = Album::firstOrCreate([
                'image_id' => $imageModels[0]->id,
                'name' => $albumName
            ]);
            $this->attachImagesToAlbum($imageModels, $albumModel);
        }
    }

    private function attachImagesToAlbum($imageModelArray, $albumModel)
    {
        $albumModel->images()->attach(
            array_map(function (Image $image) {
                return $image->id;
            }, $imageModelArray)
        );
    }

    private function getUnlockedAlbumsFilesAndLockThem()
    {
        $albums = array();
        foreach ($this->fileManager->getSubdirectoriesFromDirectory(public_path('/images/albums')) as $albumName => $albumPath) {
            $albumImages = $this->fileManager->getImagesFromDirectory($albumPath);
            if (!empty($albumImages) && !$this->fileManager->lockFileExists($albumPath)) {
                $albums[$albumName] = $this->fileManager->getFilesFromDirectory($albumPath);
                $this->fileManager->createLockFile($albumPath);
            }
        }
        return $albums;
    }


    public function createImages($imageArray)
    {
        $imageModels = array();
        foreach ($imageArray as $imageName => $imagePath) {
            $imageModels[] = $this->createImage($imagePath);
        }
        return $imageModels;
    }

    public function createImage($imagePath)
    {
        $metadata = exif_read_data($imagePath);

        $height = $metadata['COMPUTED']['Height'] ?? null;
        $width = $metadata['COMPUTED']['Width'] ?? null;

        return Image::firstOrCreate(
            [
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

                'horizontal' => $metadata["Orientation"] <= 1 ?? null,

            ]
        );
    }
}
