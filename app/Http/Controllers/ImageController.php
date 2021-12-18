<?php

namespace App\Http\Controllers;

use App\Models\Image;

class ImageController extends Controller
{
    public function index()
    {
    }

    public function show(Image $image)
    {
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

                'Height' => $metadata['ExifImageLength'] ?? null,
                'Width' => $metadata['ExifImageWidth'] ?? null,

                'aspectRatio' => $this->calculateAspectRatio(
                    $metadata['ExifImageLength'] ?? null,
                    $metadata['ExifImageWidth'] ?? null
                ),
                'vertical' => $this->vertical(
                    $metadata['ExifImageLength'] ?? null,
                    $metadata['ExifImageWidth'] ?? null
                )
            ]
        );
    }

    private function calculateAspectRatio($width, $height)
    {
        if ($width == null || $height == null) {
            return null;
        }
        return $height / $width;
    }

    /**
     * @param $width
     * @param $height
     *
     * @return bool|null
     * greater than 0 => vertical
     * lower than 0 => horizontal
     */
    private function vertical($width, $height)
    {
        return $this->calculateAspectRatio($width, $height) > 0;
    }

}
