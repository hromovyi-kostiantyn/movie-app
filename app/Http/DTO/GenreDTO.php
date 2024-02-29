<?php

namespace App\Http\DTO;

use App\Http\Requests\GenreRequest;

class GenreDTO {
    public function __construct(
        public readonly string $name
    ) {}

    public static function fromValidatedData(array $data): self {
        return new self(
            name: $data['name'],
        );
    }
}
