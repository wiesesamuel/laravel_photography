<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Models\Image;
use App\Services\AlbumChain\AlbumChainItem;
use App\Services\AlbumChain\AlbumItem;
use App\Services\AlbumChain\ConfigItem;
use App\Services\AlbumChain\ImageItem;
use Closure;
use Intervention\Image\ImageManagerStatic as ImageBuilder;

class ThumbnailFileHandler
{
    private $publicAlbumDir ;
    private $preferedPixelLength ;

    /**
     * @param $thumbnailDir
     */
    public function __construct()
    {
        $this->publicAlbumDir = env("ALBUM_PUBLIC_GALLERY", public_path('images/albums/'));
        $this->preferedPixelLength = 1200;
    }

    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        $request->albumThumbnails = $this->generateThumbnailsBasedOnFileStructure($request);
        $request->thumbnailComplete = true;
        return $next($request);
    }

    private function generateThumbnailsBasedOnFileStructure($request) {

        $albums = array();
        foreach ($request->albumFileStructures as $album_path => $album_content) {
            $thumbnails = array();
            foreach ($album_content as $type => $path) {
                if (is_int($type)) {
                        $image_orientation = $request->configComplete ? $request->albumConfig[$album_path]["images"][$path]["orientation"] : "horizontal";
                        $thumbnails[$path] = $this->generateThumbnail($album_path, $path, $image_orientation);
                }
            }
            $albums[$album_path] = $thumbnails;
        }
        return $albums;
    }

    private function generateThumbnail($album_path, $image_path, $orientation, $resetThumbnail = false)
    {
        $album_dir_name = basename($album_path);
        $image_file_name = basename($image_path);

        // save location
        $public_album_dir = $this->publicAlbumDir . '' . $album_dir_name;
        $thumbnail_dir = $public_album_dir . '/thumbnail/';
        $thumbnail_destination = $thumbnail_dir . $image_file_name;

        // prepare file structure
        if (!file_exists($thumbnail_destination) || $resetThumbnail) {

            // make album dir - if needed
            if (!file_exists($public_album_dir) || !is_dir($public_album_dir)) {
                mkdir($public_album_dir);
            }

            // make thumbnail dir
            if (!file_exists($thumbnail_dir) || !is_dir($thumbnail_dir)) {
                mkdir($thumbnail_dir);
            }

            $img = $this->downSizeImage($image_path, $orientation == "horizontal");
            $img->save($thumbnail_destination);

        } else {
            $img = ImageBuilder::make($thumbnail_destination);
        }

        return [
            'thumbnail_path' => $thumbnail_destination,
            'url' => str_replace(public_path(), '', $thumbnail_destination),
            'height' => $img->height(),
            'width' => $img->width(),
        ];
    }


    private function downSizeImage($source, $horizontal=true)
    {
        if (is_file($source)) {
            $img = ImageBuilder::make($source);
            $img->orientate();

            // compute image ratio for target length
            $ratio = $this->preferedPixelLength / ($horizontal ? $img->width() : $img->height());

            // adjust image
            $newHeight = $img->height() * $ratio;
            $newWidth = $img->width() * $ratio;
            $img->resize($newWidth, $newHeight);

            return $img;
        }
        return null;
    }
}
