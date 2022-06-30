<?php

namespace App\Pipelines\UploadDirectoryPipeline\Chains;

use App\Pipelines\UploadDirectoryPipeline\AlbumChainItem;
use Closure;
use Illuminate\Support\Facades\File;
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
        $this->publicAlbumDir = config('files.gallery.destination_absolute_path');
        $this->preferedPixelLength = 1200;
    }

    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        $request->init();
        $this->addThumbnailOnAlbumItem($request->albumItems);
        return $next($request);
    }

    public function addThumbnailOnAlbumItem(array $albumItems)
    {
        foreach ($albumItems as $albumItem) {
            foreach ($albumItem->imageItems as $imageItem) {
                $imageItem->addMetadata($this->generateThumbnail($albumItem->path, $imageItem->path, $imageItem->getOrientation() ));
            }
        }
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
        $files = File::allFiles(config('files.gallery.destination_absolute_path'));

        foreach ($files as $file) {
            if (in_array($file->getExtension(), config('files.gallery.image_extensions'))) {
                File::delete($file->getRealPath());
            }
        }
    }
}
