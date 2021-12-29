<?php

namespace App\Services\AlbumChain;

use Illuminate\Pipeline\Pipeline;

class AlbumItem
{
    public $path;
    public $config;
    public $imageItems;

    /**
     * @param $path
     * @param $config
     * @param $imageItems
     */
    public function __construct($path, $config, $imageItems)
    {
        $this->path = $path;
        $this->config = $config;
        $this->imageItems = $imageItems;
    }

}
