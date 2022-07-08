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

    public function index()
    {
        return view('artists.index', [
            'artists' => Artist::all(),
        ]);
    }

    public function show(Artist $artist)
    {
        return view('artists.show', [
            'artist' => $artist
        ]);
    }


    public function update()
    {
        $this->artistDataService->softUpdateAll();
        return redirect()->back();
    }

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
