<?php

namespace App\Pipelines\UploadDirectoryPipeline;

use App\Pipelines\UploadDirectoryPipeline\Chains\DiscoverAlbumFiles;

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
        $this->searchDir = $dir ?? config('files.gallery.source_absolute_path');
    }

    public function init() {
        if (!$this->fileScanComplete) {
            $this->albumFileStructures = (new DiscoverAlbumFiles())->getAlbumStructure($this->searchDir);
            $this->fileScanComplete = true;
        }
    }
}
