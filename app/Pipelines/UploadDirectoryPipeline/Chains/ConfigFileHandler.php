<?php

namespace App\Pipelines\UploadDirectoryPipeline\Chains;

use App\Pipelines\UploadDirectoryPipeline\AlbumChainItem;
use App\Pipelines\UploadDirectoryPipeline\ConfigItem;
use Closure;
use Illuminate\Support\Facades\File;
use Throwable;

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
            $images[basename($imagePath)] = $this->getImageBasedConfig($imagePath);
        }

        $data = [
            "title" => basename($albumPath),
            "description" => "",
            "cover_image" => basename($albumFiles[0] ?? '') ?? '',
//            "artists" => $this->getArtistBasedConfig(),
            "artists" => "",
            "images" => $images,
        ];
        file_put_contents($albumPath . "/config.json", json_encode($data, JSON_PRETTY_PRINT));
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
        $relativePath = str_replace(config('files.gallery.source_base_path'), '', $imagePath);
        $relativePath = $relativePath[0] == '/' ? substr($relativePath, 1) : $relativePath;

        return [
            "title" => basename($imagePath),
            "description" => "",
            "orientation" => $this->getOrientatedImage($imagePath),
            "relative_path" => $relativePath
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
        $files = File::allFiles(config('files.gallery.source_absolute_path'));

        foreach ($files as $file) {
            if ($file->getFilename() == 'config.json') {
                File::delete($file->getRealPath());
            }
        }
    }
}
