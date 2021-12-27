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

    public function url() {
//        dd($this->thumbnail_path);
        return $this->thumbnail_path ?? $this->url();
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->generateThumbnail();
        });
    }

    public function generateThumbnail()
    {
        $path_parts = pathinfo($this->absolute_path);
        $dir = $path_parts['dirname'];
        $file = $path_parts['basename'];

        $thumbnail_dir = $dir . '/thumbnail/';
        $thumbnail_destination = $thumbnail_dir . $file;
//        dd($thumbnail_destination);
        if (!file_exists($thumbnail_destination)) {
            if (!file_exists($thumbnail_dir) && !is_dir($thumbnail_dir)) {
//                dd($dir . '/thumbnail');
                mkdir($thumbnail_dir, 0777);
            }
            $this->downSizeImage($this->absolute_path, $thumbnail_destination);
        }

        $this->thumbnail_path=$thumbnail_destination;
//        dd($this);
//        $me = Image::where('id', $this->id)->update(['thumbnail_path' => $thumbnail_destination]);
//        dd($this->id);
//        $me->save();
    }

    public function addWatermark()
    {
        $img = ImageBuilder::make($this->absolute_path);
        $img->insert(public_path('images/wiese.png'));
        $img->save($this->absolute_path);
    }

    private function downSizeImage($source, $destination)
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

            // save image
            $img->save($destination);
        }
    }
}
