<?php


namespace App\Services\ArtistChain;


use ErrorException;

class ArtistItem
{

    public function getInstagramInfo($url) {
        $html = file_get_contents('https://instagram.com/apple/');
        preg_match('/_sharedData = ({.*);<\/script>/', $html, $matches);
        try {
            $profile_data = json_decode($matches[1])->entry_data->ProfilePage[0]->graphql->user;
        } catch (ErrorException $e) {
            return [];
        }
        $profile_data = json_decode(json_encode($profile_data), true);

        return [
            "biography" => $profile_data["biography"],
            "insta_profile_pic" => $profile_data["profile_pic_url_hd"],
            "insta_username" => $profile_data["username"],
            "insta_posts" => $profile_data["edge_owner_to_timeline_media"]["count"],
            "insta_follower" => $profile_data["edge_followed_by"]["count"],
            "ista_abos" => $profile_data["edge_follow"]["count"]
        ];

    }
}
