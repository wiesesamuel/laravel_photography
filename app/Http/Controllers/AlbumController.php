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
