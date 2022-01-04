<?php


namespace App\Services\AlbumChain;


use App\Models\Artist;

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
        $inUse = array_filter($this->config, function($value) { return !is_null($value) && $value !== '';});
        if (empty($inUse)) {
            return null;
        }

        // first element is where condition
        $updateBy = array_key_first($inUse);
        $updateByValue = [$updateBy => $inUse[$updateBy]];

        // rest is in update condition
        $updateValues = $inUse;
        array_shift($updateValues);



        $this->setModel(
            Artist::updateOrCreate(
                $updateByValue,
                $updateValues
            ));
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }


}
