<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as ImageBuilder;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function albums()
    {
        return $this->morphedByMany(Album::class, 'imageable');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->generateThumbnail(env("ALBUM_PUBLIC_GALLERY", public_path('images/albums/')));
        });
    }

    public function generateThumbnail($albumRootDir = null)
    {

        // path info from original file
        $path_parts = pathinfo($this->absolute_path);
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


        // prepare file saving
        if (!file_exists($thumbnail_destination)) {
            // make album dir - if needed
            if (isset($album_dir) && !file_exists($album_dir) && !is_dir($album_dir)) {
                mkdir($album_dir, 0777);
            }

            // make thumbnail dir
            if (!file_exists($thumbnail_dir) && !is_dir($thumbnail_dir)) {
                mkdir($thumbnail_dir, 0777);
            }

            $img = $this->downSizeImage($this->absolute_path);
            $img->save($thumbnail_destination);
        }


        // save thumbnail in database
        $url = str_replace(public_path(), '', $thumbnail_destination);
        if ($this->id == null) {
            $this->thumbnail_path = $thumbnail_destination;
            $this->url = $url;
        } else {
            $me = Image::where('id', $this->id)->update([
                'thumbnail_path' => $thumbnail_destination,
                'url' => $url
            ]);
            $me->save();
        }
    }


    public function addWatermark()
    {
        $img = ImageBuilder::make($this->absolute_path);
        $img->insert(public_path('images/wiese.png'));
        $img->save($this->absolute_path);
    }

    private function downSizeImage($source)
    {
        if (is_file($source)) {
            $img = ImageBuilder::make($source);

            // get image orientation
            $imageIsHozizontal = $img->width() > $img->height();

            // compute image ratio for target length
            $preferedPixelLength = 1200;
            $ratio = $preferedPixelLength / ($imageIsHozizontal ? $img->width() : $img->height());

            // adjust image
            $newHeight = $img->height() * $ratio;
            $newWidth = $img->width() * $ratio;
            $img->resize($newWidth, $newHeight);

            return $img;
        }
        return null;
    }
}
