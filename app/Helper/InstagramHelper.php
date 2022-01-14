<?php

namespace App\Helper;

use Throwable;

class InstagramHelper
{

    public function getInstagramInfoOrFail($url) {
        $html = file_get_contents($url);
        preg_match('/_sharedData = ({.*);<\/script>/', $html, $matches);
        $profile_data = json_decode($matches[1])->entry_data->ProfilePage[0]->graphql->user;
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

    public function getInstagramInfo($url)
    {
        try {
            return $this->getInstagramInfoOrFail($url);
        } catch (Throwable $e) {
            return null;
        }
    }

}
