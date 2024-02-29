<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @param $movie
     */
    public function run($movie): void
    {
        $movie::factory()->count(50)->create();
    }
}
