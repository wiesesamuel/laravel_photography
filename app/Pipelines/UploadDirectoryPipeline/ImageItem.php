<?php

namespace App\Pipelines\UploadDirectoryPipeline;

use App\Models\Image;

class ImageItem
{
    public $path;
    public $metadata;
    public $model;

    /**
     * ImageItem constructor.
     * @param $metadata
     */
    public function __construct()
    {
        $this->metadata = array();
    }

    /**
     * @param mixed $metadata
     */
    public function addMetadata($metadata): void
    {
        $this->metadata = array_merge($this->metadata, $metadata);
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    public function getOrientation()
    {
        if (isset($this->metadata["Orientation"])) {
            return $this->getOrientationName($this->metadata["Orientation"]);
        }
        return null;
    }

    public function applyModel()
    {
        $this->setModel(
            Image::updateOrCreate(
                ['absolute_path' => $this->path],
                array_merge(
                    [
                        'file_name' => basename($this->path)
                    ], $this->metadata)
            ));
    }

    private function getOrientationName($int)
    {
        switch ($int) {
            case 8:
            case 6:
                // +-90
                return "vertical";
            case 3:
                // 180
                return "horizontal";

        }
        return "horizontal";
    }


}
