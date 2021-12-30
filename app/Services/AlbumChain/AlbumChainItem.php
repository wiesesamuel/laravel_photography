<?php

namespace App\Services\AlbumChain;

class AlbumChainItem
{
    public $reset = false;
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

    // contains stuff
    public $albumItems;

    public $fileScanComplete = false;
    public $itemGenerationComplete = false;
    public $configComplete = false;
    public $thumbnailComplete = false;
    public $metadataComplete = false;
    public $modelComplete = false;

    /**
     * @param $dir
     */
    public function __construct($reset = false, $dir = null)
    {
        $this->reset = $reset;
        $this->searchDir = $dir ?? env("ALBUM_UPLOAD_GALLERY", public_path('/images/albums'));
    }

    public function debug() {
        dd(
            $this->searchDir,
            $this->albumItems
        );
    }
}
