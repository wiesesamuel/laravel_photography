<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Services\AlbumChain\AlbumChainItem;
use Closure;

class ConfigFileHandler
{
    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        if ($request->itemGenerationComplete) {
            $this->addConfigOnAlbumItem($request->albumItems);
        } else {
            $request->albumConfig = $this->getConfigBasedOnFileStructure($request);
            $request->configComplete = true;
        }
        return $next($request);
    }

    public function addConfigOnAlbumItem(array $albumItems)
    {
        foreach ($albumItems as $albumItem) {
            // get or write config
            if ($albumItem->config != null) {
                $albumItem->config->content =
                    $this->readValidConfigOrFail($albumItem->config->path) ??
                    $this->writeAlbumConfig(
                        $albumItem->config->path,
                        array_map(
                            function ($imageItem) {
                                return $imageItem->path;
                            },
                            $albumItem->imageItems
                        ));

            } else {
                $albumItem->config->content =
                $this->writeAlbumConfig(
                    $albumItem->config->path,
                    array_map(
                        function ($imageItem) {
                            return $imageItem->path;
                        },
                        $albumItem->imageItems
                    ));
            }
            // add data in metadata
            foreach ($albumItem->config->content["images"] as $image_path => $metadata) {
                foreach ($albumItem->imageItems as $imageItem) {
                    if($imageItem == $image_path) {
                        $imageItem->addMetadata($metadata);
                        break;
                    }
                }
                unset($metadata['images']);
                $albumItem->addMetadata($metadata);
            }
        }
    }

    private function getConfigBasedOnFileStructure($request)
    {
        $albumConfigs = array();
        foreach ($request->albumFileStructures as $album_path => $album_files) {

            $config_path = !$request->reset ? $this->getConfigPath($album_files) : null;

            if ($config_path == null) {
                $config = $this->writeAlbumConfig($album_path, $album_files);
            } else {
                $config = $this->readValidConfigOrFail($config_path) ?? $this->writeAlbumConfig($album_path, $album_files);
            }
            $albumConfigs[$album_path] = $config;
        }
        return $albumConfigs;
    }

    private function getConfigPath(array $album_files)
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
        foreach ($albumFiles as $key => $imagePath) {
            if (is_int($key)) {
                $data = [
                    "title" => basename($imagePath),
                    "description" => "",
                    "orientation" => $this->getOrientatedImage($imagePath),
                ];
                $images[$imagePath] = $data;
            }
        }
try {


    $data = [
        "title" => basename($albumPath),
        "description" => "",
        "cover_image" => basename($albumFiles[0]) ?? '',
        "images" => $images,
    ];
}
        catch
        (\Throwable $e) {
            dd($albumPath);
        }
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
