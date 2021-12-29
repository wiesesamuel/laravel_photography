<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Services\AlbumChain\AlbumChainItem;
use App\Services\AlbumChain\AlbumItem;
use App\Services\AlbumChain\ConfigItem;
use App\Services\AlbumChain\ImageItem;
use Closure;

class GetAlbumItems
{
    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        $request->albumItems = $this->getItemsBasedOnFileStructure($request);
        return $next($request);
    }

    private function getItemsBasedOnFileStructure($request) {
        $albumItems = array();
        foreach ($request->albumFileStructures as $album_path => $album_content) {

            $configItem = null;
            $imageItems = array();
            foreach ($album_content as $type => $path) {
                if ($type == 'config') {
                    $configItem = new ConfigItem($path);
                } else {
                    $imageItems[] = new ImageItem($path, null);
                }
            }
            $albumItems[] = new AlbumItem($album_path, $configItem, $imageItems);
        }
        return $albumItems;
    }
}
