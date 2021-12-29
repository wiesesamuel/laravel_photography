<?php

namespace App\Services\AlbumChain;

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
        $this->metadata = array ();
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



}
