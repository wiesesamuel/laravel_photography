<?php

namespace App\Http\Controllers;

use App\Helper\AlbumConfigHelper;
use App\Helper\AlbumImageHelper;
use App\Helper\ImageThumbnailHelper;
use App\Models\Album;
use App\Models\Image;
use App\Models\Imageable;
use App\Models\Tag;
use App\Models\Taggable;
use App\Services\AlbumChain\AlbumChainItem;
use App\Services\AlbumChain\Pipeline\AlbumModelHandler;
use App\Services\AlbumChain\Pipeline\ConfigFileHandler;
use App\Services\AlbumChain\Pipeline\GetAlbumConfig;
use App\Services\AlbumChain\Pipeline\GetAlbumItems;
use App\Services\AlbumChain\Pipeline\ImageMetaDataCollector;
use App\Services\AlbumChain\Pipeline\ThumbnailFileHandler;
use Illuminate\Pipeline\Pipeline;

class AlbumController extends Controller
{

    public function index()
    {
        return view('albums.index', [
            'albums' => Album::latest('albums.created_at')->paginate(30)->withQueryString(),
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
        $cmds = explode('.', $cmd);
        $action = $cmds[0];
        $target = $cmds[1];

        Artisan::call('data:handle', [
            'action' => $action,
            'target' => $target
        ]);
        return $this->import();
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
