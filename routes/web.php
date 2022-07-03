<?php

use App\Enum\UserRole;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShareController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('albums');
})->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'post'])->middleware(['honey'])->name('contact.post');
Route::get('/profile', [ContactController::class, 'profile'])->name('profile');
Route::get('/imprint', [ContactController::class, 'imprint'])->name('imprint');

//Route::get('/prices', [ContactController::class, 'prices'])->name('prices');
Route::get('/prices', function () {
    return redirect()->route('contact');
})->name('prices');

Route::get('/albums', [AlbumController::class, 'index'])->name("albums");
Route::get('/albums/new', [AlbumController::class, 'new'])->middleware('role:' . UserRole::Moderator)->name("albums.new");
//Route::post('/albums/new', [AlbumController::class, 'upload'])->middleware('role:' . UserRole::Moderator)->name("albums.newing");
Route::get('/albums/import', [AlbumController::class, 'import'])->middleware('role:' . UserRole::Moderator)->name("albums.import");
Route::get('/albums/import/{cmd}', [AlbumController::class, 'importing'])->middleware('role:' . UserRole::Moderator)->name("albums.importing");
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name("album");
Route::get('/albums/edit/{album}', [AlbumController::class, 'edit'])->middleware('role:' . UserRole::Moderator)->name("album.edit");
Route::get('/albums/delete/{album}', [AlbumController::class, 'delete'])->middleware('role:' . UserRole::Moderator)->name("album.delete");
//Route::delete('/albums/delete/{album}', [AlbumController::class, 'delete'])->middleware('role:' . UserRole::Moderator)->name("album.deleting");

Route::post('/artist/update', [ArtistController::class, 'update'])->middleware('role:' . UserRole::Moderator)->name("artist.update");
Route::get('/artist/update', [ArtistController::class, 'update'])->middleware('role:' . UserRole::Moderator)->name("artist.update");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/download/{pw}', [ShareController::class, 'download'])->name("share.download");

Route::get('/alpine', function () {
    return view('alpine.alpine');
})->name('alpine');

//Route::get('/insta', function () {
//    return view('components.artist.instagram-profile');
//})->name('insta');
//
//Route::get('/wert', function () {
//    return view('components.albums.image-outline');
//})->name('flicasdfkr');
//Route::get('/qwer', function () {
//    return view('components.gallery.lightbox');
//})->name('flickr');
//Route::get('/asdf', function () {
//    return view('components.gallery.image-rhomb-gallery');
//})->name('asdfads');
//Route::get('/yxcv', function () {
//    return view('components.gallery.image-flex-gallery');
//})->name('yxcv');
//Route::get('/q', function () {
//    return view('components.gallery.a-grandios-gallery');
//})->name('q');

Route::get('language/{locale}', function ($locale) {
    if (!in_array($locale, ['de', 'en'])) {
        return abort(404);
    }
    App::setLocale($locale);
//    session()->put('locale', $locale);
    return redirect()->back();
});

require __DIR__ . '/auth.php';

