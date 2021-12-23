<?php

namespace App\Helper;

use App\Models\Album;
use App\Models\Image;


class AlbumManager extends ImageManager
{

    protected $fileManager;

    public function __construct()
    {
        $this->fileManager = new FileManager();;
    }


    public function discoverAlbums()
    {
        $this->createAlbums($this->getUnlockedAlbumsFilesAndLockThem());
//        (new LanguageManager())->simplifyLocationJsons();
    }

    public function reloadAlbums()
    {
        $this->fileManager->destroyAllLockFilesInSubdirectories(public_path('/images/albums'));
        Album::truncate();
        $this->discoverAlbums();
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


}
