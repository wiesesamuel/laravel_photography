<?php
return [
    'source' => env("ALBUM_UPLOAD_GALLERY", public_path('/images/albums')),
    'destination' => env("ALBUM_PUBLIC_GALLERY", public_path('/images/albums')),
];
