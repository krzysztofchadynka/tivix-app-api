<?php

namespace App\Http\Controllers;

use App\Integrations\OMDB\Http\Requests\PositionRequest;
use App\Integrations\OMDB\OMDBApiClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OMDBController extends Controller
{
    private OMDBApiClient $apiClient;

    public function __construct(OMDBApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getMovies(string $title, ?int $year = null): JsonResponse
    {
        try {
            $movies = $this->apiClient->getMovies($title, $year);

            return $this->jsonResponse(Response::HTTP_OK, $movies);
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getCode(), null, $e->getMessage());
        }
    }

    public function getEpisodes(string $title, ?int $year): JsonResponse
    {
        try {
            $movies = $this->apiClient->getEpisodes($title, $year);

            return $this->jsonResponse(Response::HTTP_OK, $movies);
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getCode(), null, $e->getMessage());
        }
    }
}
