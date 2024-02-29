<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = Movie::all();
        $genres = Genre::all();

        $movies->each(function ($movie) use ($genres) {
            $randomGenres = $genres->random(rand(3, 5))->pluck('id')->toArray();
            $movie->genres()->sync($randomGenres);
        });
    }
}
