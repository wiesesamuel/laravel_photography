<?php

use App\Enum\TaskState;
use App\Enum\UserRole;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PostController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('posts');
})->name('home');

Route::get('/prices', function () {
    return view('contact.pricing');
})->name('prices');

Route::get('/me', function () {
    return view('contact.user-profile2');
})->name('profile');
Route::get('/we', function () {
    return view('contact.user-profile');
})->name('team');
Route::get('/contact', function () {
    return view('contact.contact-form-simple');
})->name('contact');

Route::get('/tasks', function () {

    return view('tasks', [
        'tasks' => Task::all(),
        'taskStates' => TaskState::asArray()
    ]);
});


Route::get('/albums', [AlbumController::class, 'index'])->name("albums");
Route::get('/albums/new', [AlbumController::class, 'new'])->middleware('role:' . UserRole::Moderator)->name("albums.new");
//Route::post('/albums/new', [AlbumController::class, 'upload'])->middleware('role:' . UserRole::Moderator)->name("albums.newing");
Route::get('/albums/import', [AlbumController::class, 'import'])->middleware('role:' . UserRole::Moderator)->name("albums.import");
Route::get('/albums/import/{cmd}', [AlbumController::class, 'importing'])->middleware('role:' . UserRole::Moderator)->name("albums.importing");
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name("album");
Route::get('/albums/edit/{album}', [AlbumController::class, 'edit'])->middleware('role:' . UserRole::Moderator)->name("album.edit");
Route::get('/albums/delete/{album}', [AlbumController::class, 'delete'])->middleware('role:' . UserRole::Moderator)->name("album.delete");
//Route::delete('/albums/delete/{album}', [AlbumController::class, 'delete'])->middleware('role:' . UserRole::Moderator)->name("album.deleting");

Route::get('/posts', [PostController::class, 'index'])->name("posts");
Route::get('/posts/new', [PostController::class, 'new'])->middleware('role:' . UserRole::Moderator)->name("posts.new");
Route::get('/posts/import', [PostController::class, 'import'])->middleware('role:' . UserRole::Moderator)->name("posts.import");
Route::get('/posts/{post}', [PostController::class, 'show'])->name("post");
Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->middleware('role:' . UserRole::Moderator)->name("post.edit");
Route::get('/posts/delete/{post}', [PostController::class, 'delete'])->middleware('role:' . UserRole::Moderator)->name("post.delete");


Route::get('/admin/post', [PostController::class, 'create'])
    ->middleware('role:' . UserRole::Moderator)
    ->name("admin.post.create");

Route::post('/admin/post/create', [PostController::class, 'store'])
    ->middleware('role:' . UserRole::Moderator)
    ->name("admin.post.creating");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');






Route::get('language/{locale}', function ($locale) {
    if (! in_array($locale, ['de', 'en'])) {
        return abort(404);
    }
    App::setLocale($locale);
//    session()->put('locale', $locale);
    return redirect()->back();
});



require __DIR__ . '/auth.php';

