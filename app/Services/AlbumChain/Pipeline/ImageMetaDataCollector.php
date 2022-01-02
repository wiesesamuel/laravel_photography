<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Services\AlbumChain\AlbumChainItem;
use Closure;

class ImageMetaDataCollector
{

    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        $request->init();
        $this->addMetadataOnAlbumItem($request->albumItems);
        return $next($request);
    }

    public function addMetadataOnAlbumItem(array $albumItems) {
        foreach ($albumItems as $albumItem) {
            foreach ($albumItem->imageItems as $image) {
                $image->addMetadata($this->selectMetaData($this->getMetaData($image->path)));
            }
        }
    }

    private function getMetaData($source)
    {
        return exif_read_data($source) ?? [];
    }

    private function selectMetaData($metadata)
    {
        if (!empty($metadata)) {
            try {
                $height = $metadata['COMPUTED']['Height'] ?? null;
                $width = $metadata['COMPUTED']['Width'] ?? null;

                return [
                    'Artist' => 'Samuel Wiese',
//              'Artist' => $metadata['Artist'] ?? null,

                    'title' => $metadata['FileName'] ?? null,
//                'url' => str_replace(public_path(), '', $imagePath),

                    'DateTime' => $metadata['DateTimeOriginal'] ?? null,
                    'CCDWidth' => $metadata['CCDWidth'] ?? null, // mm
                    'ExposureTime' => $metadata['ExposureTime'] ?? null, // beleuchtung
                    'ApertureNumber' => $metadata['ApertureFNumber'] ?? null, // Blende
                    'Camera' => $metadata['Model'] ?? null,
                    'CameraLens' => $metadata['UndefinedTag:0x0095'] ?? null,
//              'CameraLens' => $metadata['UndefinedTag:0xA434'],

                    'Height' => $height,
                    'Width' => $width,

//                    'horizontal' => $this->getOrientatedImage($metadata)
                ];
            } catch (ErrorException $e) {
                return null;
            }
        }
        return null;
    }
}
