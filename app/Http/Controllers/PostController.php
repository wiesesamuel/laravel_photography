<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            'posts' => $this->getPost(),
            'categories' => Category::all(),
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }

    protected function getPost()
    {
        return Post::latest()->filter(request(['search', 'category', 'author']))->get();
    }


}
