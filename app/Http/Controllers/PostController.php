<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => $this->getPost(),
            'categories' => Category::all(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    protected function getPost()
    {
        return Post::latest()->filter(request(['search', 'category', 'author']))->get();
    }


}
