<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Validation\Rule;
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

    public function edit(Post $post)
    {
        return view('posts.create', [
                'post' => $post,
                'categories' => Category::all(),
            ]
        );
    }

    public function create()
    {
        return view('posts.create', [
                'categories' => Category::all(),
            ]
        );
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'slug' => ['required', Rule::unique('posts', 'slug')]
        ]);
        dd("u created an post", $attributes);
    }

}
