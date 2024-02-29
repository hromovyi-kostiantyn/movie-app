<?php

namespace App\Service;

use App\Http\DTO\MovieDTO;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MovieService {
    public function store(MovieDTO $movieDTO): Movie
    {
        try {
            DB::beginTransaction();

            $imageUrl = $this->saveImage($movieDTO->image);

            $movie = Movie::create([
                'title' => $movieDTO->title,
                'image' => $imageUrl ?? $this->defaultImage(),
            ]);

            $genres = $this->syncGenres($movieDTO->genres);

            $movie->genres()->attach($genres->pluck('id')->toArray());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $movie;
    }

    public function update(MovieDTO $movieDTO, Movie $movie): void
    {
        try {
            DB::beginTransaction();

            if ($movieDTO->title) {
                $movie->update([
                    'title' => $movieDTO->title,
                ]);
            }

            if (!is_null($movieDTO->is_published)) {
                $movie->update([
                    'is_published' => $movieDTO->is_published,
                ]);
            }

            if ($movieDTO->image) {
                $imageUrl = $this->saveImage($movieDTO->image);

                if ($movie->image !== $this->defaultImage()) {
                    Storage::disk('public')->delete($movie->image);
                }

                $movie->update([
                    'image' => $imageUrl,
                ]);
            }

            if ($movieDTO->genres) {
                $genres = $this->syncGenres($movieDTO->genres);
                $movie->genres()->sync($genres->pluck('id')->toArray());
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }


    public function delete($movie) {
        $movie->delete();
    }

    public function publish($movie): void {
        $movie->update([
            'is_published' => 1,
        ]);
    }

    private function syncGenres(array $genres): Collection {
        return collect($genres)->map(function ($genre) {
            return Genre::firstOrCreate(['name' => $genre['name']]);
        });
    }

    private function saveImage(?UploadedFile $image): ?string
    {
        if ($image) {
            $path = $image->store('images', 'public');
            return asset( $path); // Возвращает URL изображения
        }
        return null;
    }

    private function defaultImage(): string {
        return asset('image/' . MovieDTO::defaultImage);
    }

}
