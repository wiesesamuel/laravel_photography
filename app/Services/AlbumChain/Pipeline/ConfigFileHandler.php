<?php

namespace App\Services\AlbumChain\Pipeline;

use App\Services\AlbumChain\AlbumChainItem;
use App\Services\AlbumChain\ConfigItem;
use Closure;

class ConfigFileHandler
{
    public function handle(AlbumChainItem $request, Closure $next): AlbumChainItem
    {
        $request->init();
        $this->addConfigOnAlbumItem($request->albumItems);
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
                        $albumItem->getImagePaths()
                    );

            } else {
                $albumItem->config = new ConfigItem($albumItem->path);// . '/config.json');
                $albumItem->config->content =
                    $this->writeAlbumConfig(
                        $albumItem->config->path,
                        $albumItem->getImagePaths()
                    );
            }

            $albumItem->applyConfig();
        }
    }

    private function writeAlbumConfig($albumPath, $albumFiles)
    {
        $images = array();
        foreach ($albumFiles as $imagePath) {
            $images[$imagePath] = $this->getImageBasedConfig($imagePath);
        }

        $data = [
            "title" => basename($albumPath),
            "description" => "",
            "cover_image" => basename($albumFiles[0] ?? '') ?? '',
            "images" => $images,
            "artists" => $this->getArtistBasedConfig()
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

    private function getImageBasedConfig($imagePath)
    {
        return [
            "title" => basename($imagePath),
            "description" => "",
            "orientation" => $this->getOrientatedImage($imagePath),
        ];
    }

    private function getArtistBasedConfig() {
        return [
          1 => [
              "username" => '',
              "instagram_url" => '',
              "youtube_url" => '',
              "website_url" => ''
          ]
        ];
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

    public function purgeConfig()
    {
        shell_exec("rm -rf " . config('album.source') . '*/config.json 2>&1');
    }
}
