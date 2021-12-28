<?php

namespace App\Http\Controllers;

use App\Helper\AlbumConfigHelper;
use App\Helper\AlbumHelper;
use App\Helper\AlbumImageHelper;
use App\Helper\ImageThumbnailHelper;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;

class AlbumController extends Controller
{

    protected $albumManager;
    protected $albumConfigManager;
    protected $imageThumbnailManager;

    public function __construct()
    {
        $this->albumManager = new AlbumImageHelper();
        $this->albumConfigManager = new AlbumConfigHelper();
        $this->imageThumbnailManager = new ImageThumbnailHelper();
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
        $cmds = explode('.', $cmd);
        $parent = $cmds[0];
        $action = $cmds[1];

        switch ($parent) {
            case ('import'):
                switch ($action) {
                    case('all'):
                        $this->albumManager->import();
                        $albums = Album::all();
                        $this->albumConfigManager->importConfigs($albums);
                        $this->imageThumbnailManager->importViaAlbums($albums);
                        break;
                    case('album'):
                        $this->albumManager->import();
                        break;
                    case('config'):
                        $this->albumConfigManager->importConfigs(Album::all());
                        break;
                    case ('thumbnail'):
                        $this->imageThumbnailManager->importViaAlbums(Album::all());
                        break;
                }
                break;
            case ('reset'):
                switch ('$action') {
                    case('all'):
                        Album::truncate();
                        $this->albumManager->import();
                        $albums = Album::all();
                        $this->albumConfigManager->deleteConfigs($albums);
                        $this->albumConfigManager->makeAlbumConfig($albums);
                        $this->albumConfigManager->importConfigs($albums);
                        $this->imageThumbnailManager->resetViaAlbums($albums);
                        break;
                    case('album'):
                        Album::truncate();
                        $this->albumManager->import();
                        break;
                    case('config'):
                        $albums = Album::all();
                        $this->albumConfigManager->deleteConfigs($albums);
                        $this->albumConfigManager->makeAlbumConfig($albums);
                        $this->albumConfigManager->importConfigs($albums);
                        break;
                    case ('thumbnail'):
                        $this->imageThumbnailManager->resetViaAlbums(Album::all());
                        break;
                }
                break;
        }
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
