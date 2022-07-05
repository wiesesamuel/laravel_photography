<?php


namespace App\Services;


use App\Models\Album;
use App\Models\Artist;
use App\Models\Image;
use App\Models\Imageable;
use App\Models\Tag;
use App\Models\Taggable;
use App\Pipelines\UploadDirectoryPipeline\AlbumChainItem;
use App\Pipelines\UploadDirectoryPipeline\Chains\AlbumModelHandler;
use App\Pipelines\UploadDirectoryPipeline\Chains\ConfigFileHandler;
use App\Pipelines\UploadDirectoryPipeline\Chains\GetAlbumItems;
use App\Pipelines\UploadDirectoryPipeline\Chains\ImageMetaDataCollector;
use App\Pipelines\UploadDirectoryPipeline\Chains\ThumbnailFileHandler;
use Illuminate\Pipeline\Pipeline;

class WebDataService
{

    private $artistHandleData;

    public function __construct()
    {
        $this->artistHandleData = new ArtistHandleData();
    }

    public function performActionOnTarget(string $action, string $target): bool
    {
        switch ($action) {
            case ('import'):
                switch ($target) {
                    case('all'):
                        $this->importAllByAlbumDirectories();
                        return true;
                    case('config'):
                        $this->importConfigByAlbumDirectories();
                        return true;
                    case('artist'):
                        $this->artistHandleData->updateAll();
                        return true;
                }
                break;
            case ('reset'):
                switch ($target) {
                    case('soft'):
                        $this->softReset();
                        return true;
                    case('hard'):
                        $this->hardReset();
                        return true;
                }
                break;
            case ('purge'):
                switch ($target) {
                    case('config'):
                        $this->purgeConfigFiles();
                        return true;
                    case ('thumbnail'):
                        $this->purgeThumbnailsFiles();
                        return true;
                }
                break;
        }
        return false;
    }

    private function importAllByAlbumDirectories()
    {
        $item = new AlbumChainItem();
        app(Pipeline::class)->send($item)->through(
            [
                GetAlbumItems::class,
                ConfigFileHandler::class,
                ImageMetaDataCollector::class,
                ThumbnailFileHandler::class,
                AlbumModelHandler::class,
            ]
        )->thenReturn();
    }

    private function importConfigByAlbumDirectories()
    {
        app(Pipeline::class)->send(new AlbumChainItem())->through(
            [
                GetAlbumItems::class,
                ConfigFileHandler::class,
                AlbumModelHandler::class,
            ]
        )->thenReturn();
    }

    private function softReset()
    {
        Album::truncate();
        Image::truncate();
        Imageable::truncate();
        Tag::truncate();
        Taggable::truncate();
        Artist::truncate();
        $this->importAllByAlbumDirectories();
    }

    private function hardReset()
    {
        $this->purgeConfigFiles();
        $this->purgeThumbnailsFiles();
        $this->softReset();
    }

    private function purgeConfigFiles()
    {
        (new ConfigFileHandler())->purgeConfig();
    }

    private function purgeThumbnailsFiles()
    {
        (new ThumbnailFileHandler())->purgeThumbnails();
    }

}
