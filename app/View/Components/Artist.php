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
        if (!empty($this->artist->instagram_data) || !$this->artist->instagram_data == null) {
            return view('components.artist.instagram-profile', [
                "profile_data" => json_decode($this->artist->instagram_data, true)
            ]);
        }
        return null;
    }

}
