<?php

namespace App\Http\Controllers;

use App\Http\DTO\MovieDTO;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Service\MovieService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieController extends Controller
{
    private MovieService $movieService;
    /**
     * Display a listing of the resource.
     */
    public function __construct(MovieService $movieService) {
        $this->movieService = $movieService;
    }


    public function index(): JsonResource
    {
        return MovieResource::collection(Movie::simplePaginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request): MovieResource
    {

        $data = $request->validated();

        $movieDTO = MovieDTO::fromStoreValidatedData($data);

        $movie = $this->movieService->store($movieDTO);

        return MovieResource::make($movie->load('genres'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): JsonResource
    {
        return MovieResource::make($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie): MovieResource|JsonResponse
    {
        if (!$request->hasAny(['title', 'image', 'genres', 'is_published'])) {
            return response()->json(['message' => 'No data to update'], 422);
        }

        $data = $request->validated();

        $movieDTO = MovieDTO::fromUpdateValidatedData($data);

        $this->movieService->update($movieDTO,$movie);

        return MovieResource::make($movie);
    }

    public function publish(Movie $movie): JsonResponse {
        if ($movie->is_published) {
            return response()->json(['message' => 'Movie already published'], 422);
        }
        $this->movieService->publish($movie);
        return response()->json(['message' => 'Movie published'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie): JsonResponse
    {
        $this->movieService->delete($movie);
        return response()->json(['message' => 'Movie deleted'], 200);
    }
}
