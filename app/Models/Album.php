<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $with = ['images', 'coverImage', 'tags', 'category', 'artists'];

    protected $guarded = ['id'];


    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function coverImage()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function artists()
    {
        return $this->morphToMany(Artist::class, 'artistable');
    }

    public function name(){
        return $this->title;
    }



    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $search = $filters['search'];
            $query
                ->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
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

        if ($filters['model'] ?? false) {
            $author = $filters['author'];
            $query
                ->whereExists(function ($query) use ($author) {
                    $query->from('users')
                        ->whereColumn('users.id', 'posts.user_id')
                        ->where(function ($query) use ($author) {
                            $query
                                ->Where('users.name', 'like', '%' . $author . '%');
                        });
                });
        }

        if ($filters['tag'] ?? false) {
            $tag = $filters['tag'];
            $query->whereHas('tags', function ($query) use ($tag) {
                $query
                    ->where('tags.slug', $tag);
            });
        }

    }

}
