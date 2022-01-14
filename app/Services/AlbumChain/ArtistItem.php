<?php


namespace App\Services\AlbumChain;


use App\Helper\InstagramHelper;
use App\Models\Artist;
use Throwable;

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
            )
        );

//        $this->updateData_urls();
    }

    public function updateData_urls()
    {
        if ($this->model != null) {
            if ($this->model->instagram_url != null && $this->model->instagram_data == null) {
                $this->model->instagram_data = (new InstagramHelper())->getInstagramInfo($this->model->instagram_url);
            }
            $this->model->save();
        }
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }



}
