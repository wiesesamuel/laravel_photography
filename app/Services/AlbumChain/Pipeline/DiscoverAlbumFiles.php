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
        $request->albumFileStructures = $this->getAlbumStructure($request->searchDir);
        $request->fileScanComplete = true;
        return $next($request);
    }

    public function getAlbumStructure($dir): array
    {
        // search is for album collection
        $albumFileStructures = $this->fromEachSubdirectoryGetFiles($dir);
        if (empty($albumFileStructures)) {
            // its actually an album directory
            $albumFileStructures = [$dir => $this->getFilesFromDirectory($dir)];
        }
        return $albumFileStructures;
    }

    private function fromEachSubdirectoryGetFiles($path): array
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

    private function getFilesFromDirectory($dir): array
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
