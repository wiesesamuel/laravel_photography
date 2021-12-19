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

Route::get('/prices', function () {
    return view('meeting.pricing');
});
Route::get('/tasks', function () {

    return view('tasks', [
        'tasks' => Task::all(),
        'taskStates' => TaskState::asArray()
    ]);
});

Route::get('/albums', [AlbumController::class, 'index'])->name("albums");
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name("album");



Route::get('/', [PostController::class, 'index'])->name("posts");
Route::get('/posts/{post}', [PostController::class, 'show'])->name("post");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
