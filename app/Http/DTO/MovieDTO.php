<?php

namespace App\Http\DTO;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class MovieDTO {
    public const defaultImage = 'default-movie.jpg';
    public function __construct(
        public readonly ?string $title,
        public readonly ?UploadedFile $image,
        public readonly ?array $genres,
        public readonly ?int $is_published = 0,
    ) {}

    public static function fromStoreValidatedData(array $data): self {
        return new self(
            title: $data['title'],
            image: $data['image'] ?? null,
            genres: $data['genres'],
        );
    }

    public static function fromUpdateValidatedData(array $data): self {
        return new self(
            title: $data['title'] ?? null,
            image: $data['image'] ?? null,
            genres: $data['genres'] ?? null,
            is_published: $data['is_published'] ?? null,
        );
    }
}
