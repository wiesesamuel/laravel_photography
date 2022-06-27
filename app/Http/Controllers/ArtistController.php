<?php

namespace App\Http\Controllers;

use App\Services\UpdateArtistData;

class ArtistController extends Controller
{
    public function update() {
        (new UpdateArtistData())->updateAll();
        return redirect()->back();
    }

//    public function index()
//    {
//        return view('artists.index', [
//            'albums' => Artist::all(),
//        ]);
//    }
//
//    public function show(Artist $album)
//    {
//        return view('artists.show', [
//            'artists' => $album
//        ]);
//    }
}
