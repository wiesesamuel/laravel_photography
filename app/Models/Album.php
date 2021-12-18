<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $with = ['images', 'coverImage', 'tags'];

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function coverImage()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
