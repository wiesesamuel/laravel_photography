<?php

namespace App\Http\Controllers;

use App\Helper\AlbumHelper;
use App\Helper\AlbumImageHelper;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;

class AlbumController extends Controller
{

    protected $albumManager;

    public function __construct()
    {
        $this->albumManager = new AlbumImageHelper();
    }

    public function index()
    {
        (new AlbumImageHelper)->importAlbums(public_path('images/albums'));
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
                $msg = $this->albumManager->importAlbums(public_path('/images/albums'));
                break;
            case ('reloadAll'):
                $msg = $this->albumManager->importAlbums(public_path('/images/albums'));
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
//
//    public function upload(Request $request)
//
//    {
//        $this->validate($request, [
//            'title' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//
//        $input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
//        $request->image->move(public_path('images'), $input['image']);
//
//        $input['title'] = $request->title;
//        Image::create($input);
//
//        return back()
//            ->with('success', 'Image Uploaded successfully.');
//
//    }


}
