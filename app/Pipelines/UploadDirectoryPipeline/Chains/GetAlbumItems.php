<?php

namespace App\Pipelines\UploadDirectoryPipeline\Chains;

use App\Pipelines\UploadDirectoryPipeline\AlbumChainItem;
use App\Pipelines\UploadDirectoryPipeline\AlbumItem;
use App\Pipelines\UploadDirectoryPipeline\ConfigItem;
use App\Pipelines\UploadDirectoryPipeline\ImageItem;
use Closure;

class GetAlbumItems
{
    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        $request->init();
        $request->albumItems = $this->getItemsBasedOnFileStructure($request->albumFileStructures);
        return $next($request);
    }

    public function getItemsBasedOnFileStructure($albumFileStructures) {
        $albumItems = array();
        foreach ($albumFileStructures as $album_path => $album_content) {

            $albumItem = new AlbumItem();
            $albumItem->setPath($album_path);
            foreach ($album_content as $type => $file_path) {
                if ($type == 'config') {
                    $albumItem->setConfig(new ConfigItem($file_path));
                } elseif (is_int($type)) {
                    $imageItem = new ImageItem();
                    $imageItem->setPath($file_path);
                    $albumItem->addImageItems($imageItem);
                }
            }

            $albumItems[] = $albumItem;
        }
        return $albumItems;
    }
}
