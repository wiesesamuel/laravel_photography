<?php

namespace App\Services\AlbumChain;

class ConfigItem
{

    public $path;
    public $content;

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }


}
