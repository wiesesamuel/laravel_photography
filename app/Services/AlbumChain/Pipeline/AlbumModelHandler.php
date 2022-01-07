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
            foreach ($albumItem->artistItems as $artistItems) {
                $artistItems->applyModel();
            }
            $albumItem->applyModel();
            $this->linkImagesToAlbum($albumItem->getImageModels(), $albumItem->model);
            $this->linkArtistsToAlbum($albumItem->getArtistModels(), $albumItem->model);
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
    private function linkArtistsToAlbum($artists, $album)
    {
        $artistIds = array_map(
            function ($artist) {
                return $artist->id ?? null;
            },
            $artists
        );

        !empty($artists) ? '': $album->artists()->sync($artistIds);
    }
}
