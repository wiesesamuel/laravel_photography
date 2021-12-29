<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Services\AlbumChain\AlbumChainItem;
use Closure;
use DirectoryIterator;
use Illuminate\Pipeline\Pipeline;

class DiscoverAlbumFiles
{
    private $imageExtensions = [
        "jpg", "jpeg", "jpe", "jif", "jfif", "jfi", 'gif', 'png', 'raw',
        "JPG", "JPEG", "JPE", "JIF", "JFIF", "JFI", 'GIF', 'PNG', 'RAW',
    ];

    private $configName = "config.json";

    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        if (!file_exists($request->searchDir)) {
            return $next($request);
        }

        // search is for album collection
        $albumFileStructures = $this->fromEachSubdirectoryGetFiles($request->searchDir);
        if (empty($albumFileStructures)) {
            // its actually an album directory
            $albumFileStructures = [$request->searchDir => $this->getFilesFromDirectory($request->searchDir)];
        }

        $request->albumFileStructures = $albumFileStructures;
        $request->fileScanComplete = true;
        return $next($request);
    }

    private function fromEachSubdirectoryGetFiles($path)
    {
        $iterator = new DirectoryIterator($path);
        $directories = array();
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $directories[$fileinfo->getPathname()] = $this->getFilesFromDirectory($fileinfo->getPathname());
            }
        }
        ksort($directories);
        return $directories;
    }


    private function getFilesFromDirectory($dir)
    {
        $iterator = new DirectoryIterator($dir);
        $files = array();
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile() && !$fileinfo->isDot()) {

                if (in_array($fileinfo->getExtension(), $this->imageExtensions)) {
                    $files[] = $fileinfo->getPathname();
                } elseif ($fileinfo->getFilename() == $this->configName) {
                    $files["config"] = $fileinfo->getPathname();
                }
            }
        }
        return $files;
    }
}
