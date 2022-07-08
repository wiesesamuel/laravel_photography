<?php

namespace App\Helper;

use Throwable;

class InstagramHelper
{

    public static function getInstagramInfoOrFail($url)
    {
        $html = file_get_contents($url);
        preg_match('/_sharedData = ({.*);<\/script>/', $html, $matches);
        $profile_data = json_decode($matches[1])->entry_data->ProfilePage[0]->graphql->user;
        $profile_data = json_decode(json_encode($profile_data), true);

        return json_encode([
            "url" => $url,
            "biography" => $profile_data["biography"],
            "profile_pic" => self::instaPictureDownloader($profile_data["profile_pic_url_hd"]),
            "username" => $profile_data["username"],
            "full_name" => $profile_data["full_name"],
            "category_name" => $profile_data["category_name"],
            "external_url" => $profile_data["external_url"],
            "posts" => $profile_data["edge_owner_to_timeline_media"]["count"],
            "follower" => $profile_data["edge_followed_by"]["count"],
            "abos" => $profile_data["edge_follow"]["count"]
        ]);
    }

    public static function getInstagramInfo($url)
    {
        try {
            return self::getInstagramInfoOrFail($url);
        } catch (Throwable $e) {
            return null;
        }
    }

    //TODO test if it works.
    private static function instaPictureDownloader($url)
    {
        // Getting the name
        $name = pathinfo(parse_url($url)['path'], PATHINFO_FILENAME);

        // Getting the extension
        $ext = pathinfo(parse_url($url)['path'], PATHINFO_EXTENSION);

        $path = config('files.artists.insta_profile_pics_relative_path');
        $destination = $path . $name . '.' . $ext;

        copy($url, $destination);

        return $destination;
    }

}
