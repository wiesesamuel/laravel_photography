<?php

namespace App\Helper;

use App\Models\Image;
use Intervention\Image\ImageManagerStatic as ImageBuilder;

class ImageThumbnailHelper
{

    protected $rootDir, $preferedPixelLength;


    public function __construct()
    {
        $this->rootDir = env("ALBUM_PUBLIC_GALLERY", public_path('images/albums/'));
        $this->preferedPixelLength = 1200;

    }

    /**
     * @param $images
     */
    public function importThumbnails($images)
    {
        foreach ($images as $image) {
            $this->importThumbnail($image);
        }
    }

    /**
     * @param $image
     */
    public function importThumbnail($image)
    {
        $this->generateThumbnail($image);
    }

    /**
     * @param $image
     */
    public function resetThumbnail($image)
    {
        $this->generateThumbnail($image, true);
    }

    /**
     * @param $images
     */
    public function resetThumbanils($images)
    {
        foreach ($images as $image) {
            $this->resetThumbnail($image);
        }
    }

    private function generateThumbnail($image, $resetThumbnail = false, $albumRootDir = null)
    {
        // path info from original file
        $path_parts = pathinfo($image->absolute_path);
        $absolute_dir_path_original_image = $path_parts['dirname'];
        $image_name = $path_parts['basename'];

        // set file destination
        if ($albumRootDir != null) {
            // get dir name from image
            $album_dir_name = pathinfo($absolute_dir_path_original_image)['basename'];
            $album_dir = $albumRootDir . '' . $album_dir_name;
            // adjust destination to save file
            $thumbnail_dir = $album_dir . '/thumbnail/';
        } else {
            $thumbnail_dir = $absolute_dir_path_original_image . '/thumbnail/';
        }
        $thumbnail_destination = $thumbnail_dir . $image_name;


        // prepare file structure
        if (!file_exists($thumbnail_destination) || $resetThumbnail) {
            // make album dir - if needed
            if (isset($album_dir) && !file_exists($album_dir) && !is_dir($album_dir)) {
                mkdir($album_dir, 0777);
            }

            // make thumbnail dir
            if (!file_exists($thumbnail_dir) && !is_dir($thumbnail_dir)) {
                mkdir($thumbnail_dir, 0777);
            }

            $res = $this->downSizeImage($image->absolute_path);
            $res[0]->save($thumbnail_destination);
        } else {
            $img = ImageBuilder::make($thumbnail_destination);
            $res = [null, $img->height(), $img->width()];
        }


        // save thumbnail in database
        $url = str_replace(public_path(), '', $thumbnail_destination);
        if (false && $this->id == null) {
            $this->thumbnail_path = $thumbnail_destination;
            $this->url = $url;
            $this->Height = $res[1];
            $this->Width = $res[2];
            $res[1] == 0 ? dd($this) : '';
        } else {
            $me = Image::where('id', $image->id)->update([
                'thumbnail_path' => $thumbnail_destination,
                'url' => $url,
                'height' => $res[1],
                'width' => $res[2],
            ]);
            $me->save();
        }
    }

    private function downSizeImage($source)
    {
        if (is_file($source)) {
            $img = ImageBuilder::make($source);

            // get image orientation
            $imageIsHozizontal = $img->width() > $img->height();

            // compute image ratio for target length
            $ratio = $this->preferedPixelLength / ($imageIsHozizontal ? $img->width() : $img->height());

            // adjust image
            $newHeight = $img->height() * $ratio;
            $newWidth = $img->width() * $ratio;
            $img->resize($newWidth, $newHeight);

            return [$img, $newHeight, $newWidth];
        }
        return null;
    }
}
