<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Services\AlbumChain\AlbumChainItem;
use Closure;

class AlbumModelHandler
{
    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        $request->init();
        $this->generateModelsViaAlbumItems($request->albumItems);
        return $next($request);
    }

    public function generateModelsViaAlbumItems(array $albumItems)
    {
        foreach ($albumItems as $albumItem) {
            foreach ($albumItem->imageItems as $imageItem) {
                $imageItem->applyModel();
            }
            $albumItem->applyModel();
            $this->linkImagesToAlbum($albumItem->getImageModels(), $albumItem->model);
            $albumItem->updateCoverImageId();
        }
    }

    private function linkImagesToAlbum($images, $album)
    {
        $imageIds = array_map(
            function ($image) {
                return $image->id;
            },
            $images
        );
        $album->images()->sync($imageIds);
    }
}
