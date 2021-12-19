<?php

namespace App\Http\Controllers;

use App\Helper\AlbumManager;
use App\Models\Album;
use App\Models\Image;
use DirectoryIterator;

class AlbumController extends Controller
{

    protected $albumManager;
    /**
     * AlbumController constructor.
     */
    public function __construct()
    {
        $this->albumManager = new AlbumManager();
    }

    public function index()
    {
        $this->albumManager->discoverAlbums();
        return view('albums.index', [
            'albums' => $this->getPost(),
        ]);
    }

    public function show(Album $album)
    {
        return view('albums.show', [
            'album' => $album
        ]);
    }

    protected function getPost()
    {
        return Album::latest('albums.created_at')->paginate(9)->withQueryString();
    }


}
