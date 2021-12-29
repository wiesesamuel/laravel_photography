<?php

namespace App\Services\AlbumChain;

class ImageItem
{
    public $path;
    public $model;

    /**
     * @param $path
     * @param $model
     */
    public function __construct($path, $model)
    {
        $this->path = $path;
        $this->model = $model;
    }


}
