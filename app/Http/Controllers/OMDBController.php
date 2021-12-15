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
            return $this->jsonResponse(
                Response::HTTP_OK,
                $this->apiClient->getMovies($title, $year)
            );
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getCode(), null, $e->getMessage());
        }
    }

    public function getEpisodes(string $title, ?int $year = null): JsonResponse
    {
        try {
            return $this->jsonResponse(
                Response::HTTP_OK,
                $this->apiClient->getEpisodes($title, $year),
            );
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getCode(), null, $e->getMessage());
        }
    }

    public function getSeries(string $title, ?int $year = null): JsonResponse
    {
        try {
            return $this->jsonResponse(
                Response::HTTP_OK,
                $this->apiClient->getSeries($title, $year)
            );
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getCode(), null, $e->getMessage());
        }
    }

    public function getPosition(string $id): JsonResponse
    {
        try {
            return $this->jsonResponse(
                Response::HTTP_OK,
                $this->apiClient->getPosition($id)
            );
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getCode(), null, $e->getMessage());
        }
    }
}
