<?php

namespace App\Services\AlbumChain;

use Illuminate\Pipeline\Pipeline;

class AlbumItem
{
    public $path;
    public $config;
    public $imageItems;
    public $metadata;

    public function __construct()
    {
        $this->imageItems = array();
        $this->metadata = array();
    }

    /**
     * @param mixed $metadata
     */
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


}
