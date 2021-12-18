<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use DirectoryIterator;

class AlbumController extends Controller
{
    public function index()
    {
        $this->discoverAlbums();
        return view('albums.index', [
            'albums' => $this->getPost(),
        ]);
    }

    public function show(Album $album)
    {
        return view('albums.show', [
            'album' => $album
        ]);
    }

    protected function getPost()
    {
        return Album::latest('albums.created_at')->paginate(9)->withQueryString();
    }

    public function discoverAlbums()
    {
        $this->createAlbums($this->getAlbumsFiles());
    }

    private function createAlbums($albumsArray)
    {
        foreach ($albumsArray as $albumName => $imagesArray) {
            $imageModels = (new ImageController)->createImages($imagesArray);
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

    private function getAlbumsFiles()
    {
        $albums = array();
        foreach ($this->getSubdirectoriesFromDirectory(public_path('/images/albums')) as $albumName => $albumPath) {
            $albumImages = $this->getFilesFromDirectory($albumPath);
            if (!empty($albumImages)) {
                $albums[$albumName] = $this->getFilesFromDirectory($albumPath);
            }
        }
        return $albums;
    }

    private function getFilesFromDirectory($path)
    {
        $iterator = new DirectoryIterator($path);
        $files = array();
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                $files[$fileinfo->getFilename()] = $fileinfo->getPathname();
            }
        }
        sort($files);
        return $files;
    }

    private function getSubdirectoriesFromDirectory($path)
    {
        $iterator = new DirectoryIterator($path);
        $directories = array();
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $directories[$fileinfo->getFilename()] = $fileinfo->getPathname();
            }
        }
        sort($directories);
        return $directories;
    }


}
