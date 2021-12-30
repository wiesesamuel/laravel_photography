<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Models\Album;
use App\Models\Image;
use App\Models\Imageable;
use App\Services\AlbumChain\AlbumChainItem;
use Closure;

class AlbumModelHandler
{
    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        if ($request->itemGenerationComplete) {
            $this->generateModelsViaAlbumItems($request->albumItems);
        } else {

            if ($request->reset) {
                Album::truncate();
                Image::truncate();
                Imageable::truncate();
            }

            $request->albumImageModels = $this->getModelsBasedOnFileStructure($request);
            $request->modelComplete = true;
        }
        $request->debug();
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

    private function getModelsBasedOnFileStructure($request)
    {
        $albumImageModels = array();
        foreach ($request->albumFileStructures as $album_dir => $images_files) {
            if (is_dir($album_dir) && ((count(scandir($album_dir)) != 2))) {

                $album_data = $this->collectDataFromChainForAlbum($request, $album_dir);

                $albumModel = $this->getAlbum($album_dir, $album_data);
                $imageModels = $this->getImages($request, $album_dir, $images_files);
                $albumImageModels[] = [
                    "album" => [$album_dir => $albumModel],
                    "images" => $imageModels,
                ];

                $this->linkImagesToAlbum($imageModels, $albumModel);

                $coverImage = 1;
                foreach ($imageModels as $image) {
                    if ($image->file_name == $album_data["cover_image"]) {
                        $coverImage = $image->id;
                        break;
                    }
                }
                $albumModel->update(['image_id'=> $coverImage]);
            }
        }
        return $albumImageModels;
    }

    private function collectDataFromChainForAlbum($request, $path)
    {
        return $request->configComplete ? ($request->albumConfig[$path] ?? []) : [];
    }


    private function collectDataFromChainForImage($request, $album, $path)
    {
        return array_merge(
            $request->configComplete ? $request->albumConfig[$album]["images"][$path] : [],
            $request->metadataComplete ? $request->albumMetadatas[$album][$path] : [],
            $request->thumbnailComplete ? $request->albumThumbnails[$album][$path] : [],
        );
    }


    private function getImages($request, $album, $paths)
    {
        $images = array();
        foreach ($paths as $type => $path) {
            if(is_int($type)) {
                $images[$path] = $this->getImage($path, $this->collectDataFromChainForImage($request, $album, $path));
            }
        }
        return $images;
    }

    private function getImage($path, $image_data)
    {
        return Image::updateOrCreate(
            ['absolute_path' => $path],
            array_merge(
                [
                    'file_name' => basename($path)
                ], $image_data)
        );
    }

    private function getAlbum($dir, $album_data)
    {
        return Album::updateOrCreate(
            ['absolute_path' => $dir],
            array_merge(
                [
                    'dir_name' => basename($dir),
                ], $album_data)

        );
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
