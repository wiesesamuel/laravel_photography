<?php

namespace App\Services\AlbumChain;

use Illuminate\Pipeline\Pipeline;

class AlbumChainItem
{
    public $searchDir;

    // contains only paths
    public $albumFileStructures;

    // contains model in array
    public $albumImageModels;

    // contains album config
    public $albumConfig;

    // contains thumbnail info
    public $albumThumbnails;

    // contains metadata
    public $albumMetadatas;

    public $fileScanComplete = false;
    public $configComplete = false;
    public $thumbnailComplete = false;
    public $metadataComplete = false;
    public $modelComplete = false;

    /**
     * @param $dir
     */
    public function __construct($dir = null)
    {
        $this->searchDir = $dir ?? env("ALBUM_UPLOAD_GALLERY", public_path('/images/albums'));
    }

    public function complete() {

    }
}
