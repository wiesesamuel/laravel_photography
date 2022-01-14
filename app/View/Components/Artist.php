<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Artist extends Component
{
    public $artist;

    public function __construct($artist)
    {
        $this->artist = $artist;
    }

    public function render()
    {
        return view('components.artist.instagram-profile', [
            "profile_data" => (isset($this->artist->instagram_data)) ? (json_decode($this->artist->instagram_data, true) ?? '') : null,
            "backup_url" => $this->artist->instagram_url
        ]);
    }

}
