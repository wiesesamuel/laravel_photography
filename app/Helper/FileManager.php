<?php


namespace App\Helper;


use App\Models\Album;
use App\Models\Image;
use DirectoryIterator;

class FileManager
{

    public function getImagesFromDirectory($path)
    {
        $imageExtensions = [
            "jpg", "jpeg", "jpe", "jif", "jfif", "jfi", 'gif', 'png', 'raw',
            "JPG", "JPEG", "JPE", "JIF", "JFIF", "JFI", 'GIF', 'PNG', 'RAW',
        ];
        return $this->getFilesFromDirectory($path, $imageExtensions);
    }

    public function getFilesFromDirectory($path, $extensions = null)
    {
        $iterator = new DirectoryIterator($path);
        $files = array();
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                if ($extensions == null || in_array($fileinfo->getExtension(), $extensions)) {
                    $files[$fileinfo->getFilename()] = $fileinfo->getPathname();
                }
            }
        }
        ksort($files);
        return $files;
    }

    public function getSubdirectoriesFromDirectory($path)
    {
        $iterator = new DirectoryIterator($path);
        $directories = array();
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $directories[$fileinfo->getFilename()] = $fileinfo->getPathname();
            }
        }
        ksort($directories);
        return $directories;
    }

    public function lockFileExists($dir)
    {
        return file_exists($dir . '/lock');
    }

    public function createLockFile($dir)
    {
        if (!$this->lockFileExists($dir)) {
            $resource = fopen($dir . '/lock', 'w');
            fwrite($resource, 'locked');
            fclose($resource);
        }
    }

    public function destroyAllLockFilesInSubdirectories($dir)
    {
        $subDirs = $this->getSubdirectoriesFromDirectory($dir);
        foreach ($subDirs as $subDir) {
            $this->destroyLockFile($subDir);
        }
    }

    public function destroyLockFile($dir)
    {
        unlink($dir . '/lock');
    }

    public function readFile($path)
    {
        return file_get_contents($path);
    }

    public function writeFile($path, $content)
    {
        return file_put_contents($path, $content);
    }

}

