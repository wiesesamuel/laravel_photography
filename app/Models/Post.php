<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['category', 'author', 'tags'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $search = $filters['search'];
            $query
                ->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%');
                });
        }

        if ($filters['category'] ?? false) {
            $category = $filters['category'];
            $query
                ->whereExists(function ($query) use ($category) {
                    $query->from('categories')
                        ->whereColumn('categories.id', 'posts.category_id')
                        ->where('categories.slug', $category);
                });
        }

        if ($filters['author'] ?? false) {
            $author = $filters['author'];
            $query
                ->whereExists(function ($query) use ($author) {
                    $query->from('users')
                        ->whereColumn('users.id', 'posts.user_id')
                        ->where(function ($query) use ($author) {
                            $query
                                ->where('users.username', 'like', '%' . $author . '%')
                                ->orWhere('users.name', 'like', '%' . $author . '%');
                        });
                });
        }


    }
}
