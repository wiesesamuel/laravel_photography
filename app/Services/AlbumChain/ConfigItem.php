<?php

namespace App\Services\AlbumChain;

class ConfigItem
{

    public $path;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }
}
