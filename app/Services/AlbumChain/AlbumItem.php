<?php

namespace App\Services\AlbumChain;

use App\Models\Album;
use App\Models\Image;

class AlbumItem
{
    public $path;
    public $config;
    public $imageItems;
    public $metadata;
    public $model;

    public function __construct()
    {
        $this->imageItems = array();
        $this->metadata = array();
    }

    public function setModel($model): void
    {
        $this->model = $model;
    }

    public function addMetadata($metadata): void
    {
        $this->metadata = array_merge($this->metadata, $metadata);
    }

    public function setPath($path): void
    {
        $this->path = $path;
    }

    public function setConfig($config): void
    {
        $this->config = $config;
    }

    public function addImageItems($imageItems): void
    {
        $this->imageItems[] = $imageItems;
    }

    public function applyConfig()
    {
        if ($this->config != null && $this->config->content != null) {
            foreach ($this->config->content["images"] as $image_path => $metadata) {
                foreach ($this->imageItems as $imageItem) {
                    if ($imageItem->path == $image_path) {
                        $imageItem->addMetadata($metadata);
                        break;
                    }
                }
                $metadata_copy = $this->config->content;
                unset($metadata_copy['images']);
                $this->addMetadata($metadata_copy);
            }
        }
    }

    public function getImagePaths()
    {
        return array_map(
            function ($imageItem) {
                return $imageItem->path;
            },
            $this->imageItems
        );
    }

    public function getImageModels()
    {
        return array_map(
            function ($imageItem) {
                return $imageItem->model;
            },
            $this->imageItems
        );
    }

    public function updateCoverImageId()
    {
        $coverImagePath = "asdf";
        if (isset($this->metadata["cover_image"])) {
            foreach ($this->imageItems as $imageItem) {
                if (basename($imageItem->path) == $this->metadata["cover_image"]) {
                    $coverImagePath = $imageItem->path;
                    break;
                }
            }
        }

        $id = Image::where('absolute_path', '=', $coverImagePath)->get('id')->first()->id ?? 1;
        Album::where('absolute_path', $this->path)->update(['image_id' => $id]);
    }

    public function applyModel()
    {

        $this->setModel(Album::updateOrCreate(
            ['absolute_path' => $this->path],
            array_merge(
                [
                    'dir_name' => basename($this->path),
                ], $this->metadata)
        ));
    }

}
