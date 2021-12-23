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

    public function import($msg = null)
    {
        return view('albums.import', ['msg' => $msg]);
    }

    public function importing($cmd)
    {
        $msg = "unknown command $cmd";
        switch ($cmd) {
            case ('importUnlocked'):
                $this->albumManager->discoverAlbums();
                $msg = "success";
                break;
            case ('reloadAll'):
                $this->albumManager->reloadAlbums();
                $msg = "sucess";
                break;
        }
        return $this->import($msg);
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
