<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'is_published', 'image'];

//    protected $attributes = [
//        'image' => 'path to default image',
//    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movies_genres');
    }
}
