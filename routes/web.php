<?php

use App\Enum\TaskState;
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

Route::get('/tasks', function () {
    return view('tasks', [
        'tasks' => Task::all(),
        'taskStates' => TaskState::asArray()
    ]);
});


Route::get('/', function () {
    return view('posts', [
//        'posts' => Post::latest('published_at')->get(),
        'posts' => Post::all(),
        'categories' => Category::all()
    ]);
});


Route::get('/posts/{post}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts,
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
});

Route::get('/authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts' => $author->posts,
        'categories' => Category::all()
    ]);
});
