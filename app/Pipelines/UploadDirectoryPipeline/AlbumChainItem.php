<?php

namespace App\Services\UploadDirectoryPipeline;

use App\Services\UploadDirectoryPipeline\Pipeline\DiscoverAlbumFiles;

class AlbumChainItem
{
    public $fileScanComplete = false;
    public $reset = false;
    public $searchDir;

    // contains only paths
    public $albumFileStructures;

    // contains stuff
    public $albumItems;


    public function __construct($reset = false, $dir = null)
    {
        $this->reset = $reset;
        $this->searchDir = $dir ?? config('album.source');
    }

    public function init() {
        if (!$this->fileScanComplete) {
            $this->albumFileStructures = (new DiscoverAlbumFiles())->getAlbumStructure($this->searchDir);
            $this->fileScanComplete = true;
        }
    }
}
