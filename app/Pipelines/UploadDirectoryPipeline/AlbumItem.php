<?php

namespace App\Pipelines\UploadDirectoryPipeline;

use App\Models\Album;
use App\Models\Image;

class AlbumItem
{
    public $path;
    public $config;
    public $imageItems;
    public $artistItems;
    public $metadata;
    public $model;

    public function __construct()
    {
        $this->imageItems = array();
        $this->artistItems = array();
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
            // update informations for Images
            foreach ($this->config->content["images"] as $image_file_name => $metadata) {
                foreach ($this->imageItems as $imageItem) {
                    $absolute_file_path = config('files.gallery.source_base_path') . '/' . $metadata['relative_path'];
                    if ($imageItem->path == $absolute_file_path) {
                        $imageItem->addMetadata($metadata);
                        break;
                    }
                }
            }
            foreach ($this->config->content["artists"] ?? [] as $artist) {
                $this->artistItems[] = new ArtistItem($artist);
                }
            $metadata_copy = $this->config->content;
            unset($metadata_copy['artists']);
            unset($metadata_copy['images']);
            $this->addMetadata($metadata_copy);
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

    public function getArtistModels()
    {
        return array_map(
            function ($artistItem) {
                return $artistItem->model;
            },
            $this->artistItems
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
