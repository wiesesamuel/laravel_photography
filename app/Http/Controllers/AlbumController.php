<?php

namespace App\Http\Controllers;

use App\Helper\AlbumManager;
use App\Models\Album;

class AlbumController extends Controller
{

    protected $albumManager;

    public function __construct()
    {
        $this->albumManager = new AlbumManager();
    }

    public function index()
    {
        $this->albumManager->discoverAlbums();
        return view('albums.index', [
            'albums' => Album::latest('albums.created_at')->paginate(9)->withQueryString(),
        ]);
    }

    public function show(Album $album)
    {
        return view('albums.show', [
            'album' => $album
        ]);
    }


    public function new()
    {
        return $this->index();
    }

    public function import()
    {
        return $this->index();
    }

    public function edit(Album $album)
    {
        return view('albums.show', [
            'album' => $album
        ]);
    }

    public function delete(Album $album)
    {
        return view('albums.show', [
            'album' => $album
        ]);
    }

}
