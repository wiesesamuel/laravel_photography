<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Services\AlbumChain\AlbumChainItem;
use Closure;

class ConfigFileHandler
{
    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        $request->albumConfig = $this->getConfigBasedOnFileStructure($request);
        $request->configComplete = true;
        return $next($request);
    }

    private function getConfigBasedOnFileStructure($request)
    {
        $albumConfigs = array();
        foreach ($request->albumFileStructures as $album_path => $album_files) {

            $config_path = $this->getConfigPath($album_files);

            if ($config_path == null) {
                $config = $this->writeAlbumConfig($album_path, $album_files);
            } else {
                $config = $this->readValidConfigOrFail($config_path) ?? $this->writeAlbumConfig($album_path, $album_files);
            }
            $albumConfigs[$album_path] = $config;
        }
        return $albumConfigs;
    }

    private function getConfigPath($album_files)
    {
        foreach ($album_files as $type => $path) {
            if ($type == 'config') {
                return $path;
            }
        }
        return null;
    }

    private function writeAlbumConfig($albumPath, $albumFiles)
    {
        $images = array();
        foreach ($albumFiles as $imagePath) {

            $data = [
                "title" => basename($imagePath),
                "description" => "",
                "orientation" => $this->getOrientatedImage($imagePath),
            ];
            $images[$imagePath] = $data;
        }

        $data = [
            "title" => basename($albumPath),
            "description" => "",
            "cover_image" => basename($albumFiles[0]),
            "images" => $images,
        ];

        file_put_contents($albumPath . '/config.json', json_encode($data, JSON_PRETTY_PRINT));
        return $data;
    }

    private function readValidConfigOrFail($config_path)
    {
        try {
            return json_decode(file_get_contents($config_path), true);
        } catch (Throwable $e) {
            return null;
        }
    }

    private function getOrientatedImage($original)
    {
        $exif = exif_read_data($original);
        if (!empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 8:
                case 6:
                    // +-90
                    return "vertical";
                case 3:
                    // 180
                    return "horizontal";

            }
        }
        return "horizontal";
    }
}
