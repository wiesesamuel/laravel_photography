<?php

use App\Enum\TaskState;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use App\Models\Task;
use App\Models\User;
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
    return redirect()->route('albums');
})->name('home');

Route::get('/prices', function () {
    return view('contact.pricing');
});
Route::get('/tasks', function () {

    return view('tasks', [
        'tasks' => Task::all(),
        'taskStates' => TaskState::asArray()
    ]);
});

Route::get('/albums', [AlbumController::class, 'index'])->name("albums");
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name("album");

Route::get('/posts', [PostController::class, 'index'])->name("posts");
Route::get('/post/{post}', [PostController::class, 'show'])->name("post");


Route::get('/admin/post/create/', [PostController::class, 'create'])->middleware('admin')->name("admin.post.create");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

