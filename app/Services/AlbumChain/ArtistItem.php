<?php


namespace App\Services\AlbumChain;


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

        $this->updateData_urls();
    }

    public function updateData_urls()
    {
        if ($this->model != null) {
            if ($this->model->instagram_url != null && $this->model->instagram_data == null) {
                $this->model->instagram_data = $this->getInstagramInfo($this->model->instagram_url);
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

    public function getInstagramInfo($url)
    {
        $html = file_get_contents($url);
        preg_match('/_sharedData = ({.*);<\/script>/', $html, $matches);
        try {
            $profile_data = json_decode($matches[1])->entry_data->ProfilePage[0]->graphql->user;
        } catch (Throwable $e) {
            return ["url" => $url];
        }
        $profile_data = json_decode(json_encode($profile_data), true);

        return json_encode([
            "url" => $url,
            "biography" => $profile_data["biography"],
            "profile_pic" => $profile_data["profile_pic_url_hd"],
            "username" => $profile_data["username"],
            "full_name" => $profile_data["full_name"],
            "category_name" => $profile_data["category_name"],
            "external_url" => $profile_data["external_url"],
            "posts" => $profile_data["edge_owner_to_timeline_media"]["count"],
            "follower" => $profile_data["edge_followed_by"]["count"],
            "abos" => $profile_data["edge_follow"]["count"]
        ]);

    }


}
