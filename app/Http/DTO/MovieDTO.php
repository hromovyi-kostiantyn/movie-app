<?php

namespace App\Http\DTO;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class MovieDTO {
    public function __construct(
        public readonly string $title,
        public readonly UploadedFile $image,
        public readonly array $genres,
    ) {}

    public static function fromValidatedData(array $data): self {
        return new self(
            title: $data['title'],
            image: $data['image'],
            genres: $data['genres'],
        );
    }
}
