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
});
Route::get('/form', function () {
    return view('contact.contact-form');
});
Route::get('/form1', function () {
    return view('contact.contact-form-simple');
});
Route::get('/tasks', function () {

    return view('tasks', [
        'tasks' => Task::all(),
        'taskStates' => TaskState::asArray()
    ]);
});


Route::get('/albums', [AlbumController::class, 'index'])->name("albums");
Route::get('/albums/new', [AlbumController::class, 'new'])->middleware('role:' . UserRole::Moderator)->name("albums.new");
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name("album");
Route::get('/albums/import', [AlbumController::class, 'import'])->middleware('role:' . UserRole::Moderator)->name("albums.import");
Route::get('/albums/delete', [AlbumController::class, 'delete'])->middleware('role:' . UserRole::Moderator)->name("albums.delete");

Route::get('/posts', [PostController::class, 'index'])->name("posts");
Route::get('/posts/new', [PostController::class, 'new'])->middleware('role:' . UserRole::Moderator)->name("posts.new");
Route::get('/posts/{post}', [PostController::class, 'show'])->name("post");
Route::get('/posts/import', [PostController::class, 'import'])->middleware('role:' . UserRole::Moderator)->name("posts.import");
Route::get('/posts/delete', [PostController::class, 'delete'])->middleware('role:' . UserRole::Moderator)->name("posts.delete");


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

