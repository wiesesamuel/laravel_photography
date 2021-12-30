<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Services\AlbumChain\AlbumChainItem;
use Closure;

class ImageMetaDataCollector
{

    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        if ($request->itemGenerationComplete) {
            $this->addMetadataOnAlbumItem($request->albumItems);
        } else {
            $request->albumMetadatas = $this->getMetadataBasedOnFileStructure($request);
            $request->metadataComplete = true;
        }
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

    private function getMetadataBasedOnFileStructure($request) {
        $albums = array();
        foreach ($request->albumFileStructures as $album_path => $album_content) {
            $images = array();
            foreach ($album_content as $type => $path) {
                if (is_int($type)) {
                    $images[$path] = $this->selectMetaData($this->getMetaData($path));
                }
            }
            $albums[$album_path] = $images;
        }
        return $albums;
    }
}
