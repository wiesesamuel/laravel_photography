<?php
$config = [
    'gallery' => [
        'source_base_path' => env("gallery_source_base_path", resource_path()),
        'source_relative_path' => env("gallery_source_relative_path", '/webdata/albums/'),
        'source_absolute_path' => '',

        'destination_base_path' => env("gallery_destination_base_path", public_path()),
        'destination_relative_path' => env("gallery_destination_relative_path", '/images/albums/'),
        'destination_absolute_path' => '',

        'image_extensions' => [
            "jpg", "jpeg", "jpe", "jif", "jfif", "jfi", 'gif', 'png', 'raw',
            "JPG", "JPEG", "JPE", "JIF", "JFIF", "JFI", 'GIF', 'PNG', 'RAW',
        ]
    ],

    'artists' => [
        'config_base_path' => env("artists_config_base_path", resource_path()),
        'config_relative_path' => env("artists_config_relative_path", '/webdata/artists/'),
        'config_absolute_path' => '',

        'insta_profile_pics_base_path' => env("artists_insta_profile_pics_base_path", public_path()),
        'insta_profile_pics_relative_path' => env("artists_insta_profile_pics_relative_path", '/images/artists/'),
        'insta_profile_pics_absolute_path' => '',
    ]
];

$config['gallery']['source_absolute_path'] = $config['gallery']['source_base_path'] . $config['gallery']['source_relative_path'];
$config['gallery']['destination_absolute_path'] = $config['gallery']['destination_base_path'] . $config['gallery']['destination_relative_path'];
$config['artists']['config_absolute_path'] = $config['artists']['config_base_path'] . $config['artists']['config_relative_path'];
$config['artists']['insta_profile_pics_absolute_path'] = $config['artists']['insta_profile_pics_base_path'] . $config['artists']['insta_profile_pics_relative_path'];

return $config;
