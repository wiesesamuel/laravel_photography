<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Services\ArtistDataService;

class ArtistController extends Controller
{

    /**
     * @var ArtistDataService
     */
    private $artistDataService;

    /**
     * ArtistController constructor.
     */
    public function __construct()
    {
        $this->artistDataService = new ArtistDataService();
    }

    public function createOrUpdateArtistAndCollectArtistData(array $parameters)
    {
        $artist = $this->updateOrCreateArtist($parameters);
        $this->artistDataService->update($artist);
    }

    public function update()
    {
        $this->artistDataService->updateAll();
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


    public static function updateOrCreateArtist(array $parameters)
    {
        return (new Controller)->updateOrCreateModel(
            Artist::class,
            $parameters,
            $privilegedParameters = ['username', 'instagram_url', 'youtube_url', 'website_url'],
            $ignoredParameters = ['id']
        );
    }
}
