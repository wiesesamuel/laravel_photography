<?php

namespace App\Services\UploadDirectoryPipeline\Pipeline;

use App\Services\UploadDirectoryPipeline\AlbumChainItem;
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
            $albumItem->model->save();
        }
    }

    private function linkImagesToAlbum($images, $album)
    {
        $imageIds = array_map(
            function ($image) {
                return $image->id ?? null;
            },
            $images
        );

        // drop empty values
        $imageIds = array_filter($imageIds, function($value) { return !is_null($value);});

        // sync or detach
        empty($imageIds) ? $album->images()->detach() : $album->images()->sync($imageIds);
    }
    private function linkArtistsToAlbum($artists, $album)
    {
        $artistIds = array_map(
            function ($artist) {
                return $artist->id ?? null;
            },
            $artists
        );

        // drop empty values
        $artistIds = array_filter($artistIds, function($value) { return !is_null($value);});

        // sync or detach
        empty($artistIds) ? $album->artists()->detach() : $album->artists()->sync($artistIds);
    }
}
