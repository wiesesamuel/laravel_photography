<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Services\ArtistHandleData;

class ArtistController extends Controller
{

    /**
     * @var ArtistHandleData
     */
    private $artistHandleData;

    /**
     * ArtistController constructor.
     */
    public function __construct()
    {
        $this->artistHandleData = new ArtistHandleData();
    }


    public function createOrUpdateArtist(array $parameters)
    {
        // TODO check from here step by step (artist table is null, null...)
        var_dump($parameters);
        $artist = $this->updateOrCreateModel(Artist::class, $parameters, ['username', 'instagram_url', 'youtube_url', 'website_url']);
        $this->artistHandleData->update($artist);
    }

    public function update()
    {
        $this->artistHandleData->updateAll();
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
