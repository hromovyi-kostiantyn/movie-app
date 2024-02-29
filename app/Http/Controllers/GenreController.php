<?php

namespace App\Http\Controllers;

use App\Http\DTO\GenreDTO;
use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Http\Resources\MovieResource;
use App\Models\Genre;
use App\Service\GenreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreController extends Controller
{
    private GenreService $genreService;

    public function __construct(GenreService $genreService) {
        $this->genreService = $genreService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return GenreResource::collection(Genre::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request): GenreResource
    {
        $data = $request->validated();

        $genreDTO = GenreDTO::fromValidatedData($data);

        $genre = $this->genreService->store($genreDTO);

        return GenreResource::make($genre);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre): JsonResource
    {
        return MovieResource::collection($genre->movies()->simplePaginate(5));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreRequest $request, Genre $genre): GenreResource
    {
        $data = $request->validated();

        $genreDTO = GenreDTO::fromValidatedData($data);

        $this->genreService->update($genreDTO,$genre);

        return GenreResource::make($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre): JsonResponse
    {
        $this->genreService->delete($genre);

        return response()->json(['message' => 'Genre deleted'], 200);
    }
}
