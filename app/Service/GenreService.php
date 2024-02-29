<?php

namespace App\Service;

use App\Http\DTO\GenreDTO;
use App\Models\Genre;

class GenreService {

    public function store(GenreDTO $genreDTO): Genre {

        $genre = Genre::create([
            'name' => $genreDTO->name,
        ]);

        return $genre;
    }

    public function update(GenreDTO $genreDTO, $genre): void {

        $genre->update([
            'name' => $genreDTO->name,
        ]);

    }

    public function delete($genre): void{

        $genre->movies()->detach();

        $genre->delete();
    }
}
