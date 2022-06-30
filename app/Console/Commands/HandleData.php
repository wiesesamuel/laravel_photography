<?php

namespace App\Console\Commands;

use App\Models\Album;
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
use App\Services\UpdateArtistData;
use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;

class HandleData extends Command
{
    protected $acceptedModels;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature =
        'data:handle
        {action : import, reset or purge}
        {target : import=[all, config], reset=[soft or hard], purge=[config, thumbnail]}
        {--Q|queue : Whether the job should be queued}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->description = $this->signature;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('starting...');
        $queueName = $this->option('queue');
        $options = $this->options();

        $action = strtolower($this->argument('action'));
        $target = strtolower($this->argument('target'));

        if ($this->performAction($action, $target)) {
            $this->info('success!');
        } else {
            $this->newLine();
            $this->error('invalid arguments, take a look at the signautre:');
            $this->info($this->signature);
            $this->newLine();
        }

        $this->info('finished!');
        return 0;
    }

    /**
     * @param string $action
     * @param string $target
     */
    public function performAction(string $action, string $target): bool
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
                        (new UpdateArtistData())->updateAll();
                        return true;
                }
            case ('reset'):
                switch ($target) {
                    case('soft'):
                        $this->resetAllByAlbumDirectories();
                        return true;
                    case('hard'):
                        $this->hardReset();
                        return true;
                }
            case ('purge'):
                switch ($target) {
                    case('config'):
                        $this->purgeConfigFiles();
                        return true;
                    case ('thumbnail'):
                        $this->purgeThumbnailsFiles();
                        return true;
                }
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

    private function resetAllByAlbumDirectories()
    {
        Album::truncate();
        Image::truncate();
        Imageable::truncate();
        Tag::truncate();
        Taggable::truncate();
        $this->importAllByAlbumDirectories();
    }

    private function purgeConfigFiles()
    {
        (new ConfigFileHandler())->purgeConfig();
    }

    private function purgeThumbnailsFiles()
    {
        (new ThumbnailFileHandler())->purgeThumbnails();
    }

    private function hardReset() {
        $this->purgeConfigFiles();
        $this->purgeThumbnailsFiles();
        $this->resetAllByAlbumDirectories();
    }


}
