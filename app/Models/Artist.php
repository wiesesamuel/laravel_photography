<?php

namespace App\Models;

use App\Services\ArtistDataService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function albums()
    {
        return $this->morphedByMany(Album::class, 'artistable');
    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public function save(array $options = [])
    {
        $success = parent::save($options);
        if ($success) {
            ArtistDataService::writeCache($this);
        }
        return $success;
    }
}
