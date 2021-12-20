<?php


namespace App\Helper;


use App\Models\Image;
use Imagick;


class ImageManager
{

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

        $this->generateCompromisedImage($imagePath);

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

    public function getThumbnail($imagePath) {
        $image = exif_thumbnail($imagePath);
        if ($image!==false) {
            return base64_encode($image);
//            echo '<img src="data:image/jpg;base64,' . base64_encode($image) . '">';
        }
        return null;
    }

    public function generateCompromisedImage($imagePath) {
        $dirName = pathinfo($imagePath, PATHINFO_DIRNAME);
        $fileName = pathinfo($imagePath, PATHINFO_FILENAME);
        $fileExt = pathinfo($imagePath, PATHINFO_EXTENSION);
        $thumbnailPath = $dirName . '/thumbnail_' . $fileName . '.' . $fileExt;

        $imagick = new Imagick($imagePath);
//        $imagick->thumbnailImage(100, 100, true, true);
        $imagick->resizeImage(50,50,Imagick::FILTER_LANCZOS,1);
        // ToDO
//        $imagick->writeImage($thumbnailPath);
    }
}
