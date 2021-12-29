<?php

namespace App\Http\Controllers;

use App\Helper\AlbumConfigHelper;
use App\Helper\AlbumImageHelper;
use App\Helper\ImageThumbnailHelper;
use App\Models\Album;
use App\Models\Image;
use App\Models\Imageable;
use App\Services\AlbumChain\AlbumChainItem;
use App\Services\AlbumChain\Pipeline\ConfigFileHandler;
use App\Services\AlbumChain\Pipeline\DiscoverAlbumFiles;
use App\Services\AlbumChain\Pipeline\GetAlbumConfig;
use App\Services\AlbumChain\Pipeline\GetAlbumItems;
use App\Services\AlbumChain\Pipeline\AlbumModelHandler;
use App\Services\AlbumChain\Pipeline\ImageMetaDataCollector;
use App\Services\AlbumChain\Pipeline\ThumbnailFileHandler;
use Illuminate\Pipeline\Pipeline;

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
                        $item = new AlbumChainItem();
                        app(Pipeline::class)->send($item)->through(
                            [
                                DiscoverAlbumFiles::class,
                                ConfigFileHandler::class,
                                ImageMetaDataCollector::class,
                                ThumbnailFileHandler::class,
                                AlbumModelHandler::class,
                            ]
                        )->thenReturn();
                        break;
                    case('config'):
                        app(Pipeline::class)->send(new AlbumChainItem())->through(
                            [
                                DiscoverAlbumFiles::class,
                                ConfigFileHandler::class,
                                AlbumModelHandler::class,
                            ]
                        )->thenReturn();
                        break;
                }
                break;
            case ('reset'):
                switch ($action) {
                    case('all'):
                        Album::truncate();
                        Image::truncate();
                        Imageable::truncate();
                        (new ThumbnailFileHandler())->purgeThumbnails();


                        break;
                    case('alben'):
                        app(Pipeline::class)->send(new AlbumChainItem(true))->through(
                            [
                                DiscoverAlbumFiles::class,
                                AlbumModelHandler::class,
                            ]
                        )->thenReturn();
                        break;
                    case('config'):
                        app(Pipeline::class)->send(new AlbumChainItem(true))->through(
                            [
                                DiscoverAlbumFiles::class,
                                ConfigFileHandler::class,
                                AlbumModelHandler::class,
                            ]
                        )->thenReturn();
                        break;
                    case ('thumbnail'):
                        app(Pipeline::class)->send(new AlbumChainItem(true))->through(
                            [
                                DiscoverAlbumFiles::class,
                                ThumbnailFileHandler::class,
                                AlbumModelHandler::class,
                            ]
                        )->thenReturn();
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
