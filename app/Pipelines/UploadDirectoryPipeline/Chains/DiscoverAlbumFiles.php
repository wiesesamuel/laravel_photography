<?php

namespace App\Pipelines\UploadDirectoryPipeline\Chains;

use App\Pipelines\UploadDirectoryPipeline\AlbumChainItem;
use Closure;
use DirectoryIterator;

class DiscoverAlbumFiles
{
    private $configName = "config.json";

    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        if (file_exists($request->searchDir)) {
            $request->albumFileStructures = $this->getAlbumStructure($request->searchDir);
            $request->fileScanComplete = true;
        }
        return $next($request);
    }

    public function getAlbumStructure($dir): array
    {
        // search is for album collection
        $albumFileStructures = $this->fromEachSubdirectoryGetFiles($dir);
        if (empty($albumFileStructures)) {
            // its actually an album directory
            $files = $this->getFilesFromDirectory($dir);
            if (!empty($files)) {
                // and its not empty
                $albumFileStructures = [$dir => $files];
            }
        }
        return $albumFileStructures;
    }

    private function fromEachSubdirectoryGetFiles($path): array
    {
        if (!file_exists($path)) {
            return [];
        }
        $iterator = new DirectoryIterator($path);
        $directories = array();
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $files = $this->getFilesFromDirectory($fileinfo->getPathname());
                if (!empty($files)) {
                    $directories[$fileinfo->getPathname()] = $files;
                }
            }
        }
        krsort($directories);
        return $directories;
    }

    private function getFilesFromDirectory($dir): array
    {
        if (!file_exists($dir)) {
            return [];
        }
        $iterator = new DirectoryIterator($dir);
        $files = array();
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile() && !$fileinfo->isDot()) {

                if (in_array($fileinfo->getExtension(), config('files.gallery.image_extensions'))) {
                    $files[] = $fileinfo->getPathname();
                } elseif ($fileinfo->getFilename() == $this->configName) {
                    $files["config"] = $fileinfo->getPathname();
                }
            }
        }
        uasort($files, 'strcasecmp');
        return $files;
    }
}
