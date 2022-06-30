<?php


namespace App\Pipelines\UploadDirectoryPipeline;


use App\Http\Controllers\ArtistController;

class ArtistItem
{
    public $model;
    private $config;

    /**
     * ArtistItem constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function applyModel()
    {
        // filter empty settings
        $inUse = array_filter($this->config, function ($value) {
            return !is_null($value) && $value !== '';
        });
        if (empty($inUse)) {
            return null;
        }

        (new ArtistController())->createOrUpdateArtist($inUse);
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }



}
