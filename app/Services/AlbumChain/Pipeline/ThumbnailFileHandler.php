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
    private $publicAlbumDir;
    private $preferedPixelLength;

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
        if ($request->itemGenerationComplete) {
            $this->addThumbnailOnAlbumItem($request->albumItems);
        } else {
            $request->albumThumbnails = $this->generateThumbnailsBasedOnFileStructure($request);
            $request->thumbnailComplete = true;
        }
        return $next($request);
    }

    public function addThumbnailOnAlbumItem(array $albumItems)
    {
        foreach ($albumItems as $albumItem) {
            foreach ($albumItem->imageItems as $imageItem) {
                $imageItem->addMetadata($this->generateThumbnail($albumItem->path, $imageItem->path, ));
            }
        }
    }


    private function generateThumbnailsBasedOnFileStructure($request)
    {
        $albums = array();
        foreach ($request->albumFileStructures as $album_path => $album_content) {
            $thumbnails = array();
            foreach ($album_content as $type => $path) {
                if (is_int($type)) {
                    $image_orientation = $request->configComplete ? $request->albumConfig[$album_path]["images"][$path]["orientation"] : "horizontal";
                    $thumbnails[$path] = $this->generateThumbnail($album_path, $path, $image_orientation, $request->reset);
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
        $thumbnail_dir = $this->publicAlbumDir . $album_dir_name . '/thumbnail/';
        $thumbnail_destination = $thumbnail_dir . $image_file_name;

        // prepare file structure
        if (!file_exists($thumbnail_destination) || $resetThumbnail) {


            // make thumbnail dir
            if (!file_exists($thumbnail_dir) || !is_dir($thumbnail_dir)) {
                mkdir($thumbnail_dir, 0755, true);
            }

            $img = $this->downSizeImage($image_path, $orientation == "horizontal");
            $img->save($thumbnail_destination);

        } else {
            $img = ImageBuilder::make($thumbnail_destination);
        }

        return [
            'thumbnail_path' => $thumbnail_destination,
            'url' => str_replace(public_path(), '', $thumbnail_destination),
            'Height' => $img->height(),
            'Width' => $img->width(),
        ];
    }

    private function downSizeImage($source, $horizontal = true)
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

    public function purgeThumbnails()
    {
        shell_exec("rm -rf " . $this->publicAlbumDir . '*/thumbnail/ 2>&1');
    }
}
