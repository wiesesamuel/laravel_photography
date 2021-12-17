<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index() {
        return Album::all();
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
