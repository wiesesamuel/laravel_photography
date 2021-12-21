<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index',
            [
            'posts' => Post::latest('posts.created_at')->filter(request(['search', 'category', 'author', 'tag']))->paginate(9)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        ddd(request()->all());
    }

}
