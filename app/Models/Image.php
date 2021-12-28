<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as ImageBuilder;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function albums()
    {
        return $this->morphedByMany(Album::class, 'imageable');
    }

    public function height() {
        return $this->Height;
    }

    public function width() {
        return $this->Width;
    }
}
