<?php

namespace App\Models;

use App\Http\DTO\MovieDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title', 'is_published', 'image'];

    protected $attributes = [
        'is_published' => 0,
    ];

    protected $with = ['genres'];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movies_genres');
    }
}
