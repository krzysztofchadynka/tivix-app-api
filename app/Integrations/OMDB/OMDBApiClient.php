<?php

namespace App\Integrations\OMDB;

use App\Integrations\OMDB\Enums\PositionTypeEnum;
use App\Integrations\OMDB\Mappers\ApiListResponseMapper;
use App\Integrations\OMDB\Traits\SendsRequestTrait;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class OMDBApiClient
{
    use SendsRequestTrait;

    private HttpClient $httpClient;
    private ApiListResponseMapper $responseMapper;
    private string $apiKey;
    private string $apiBaseUrl;

    public function __construct(HttpClient $httpClient, ApiListResponseMapper $responseMapper)
    {
        $this->httpClient = $httpClient;
        $this->responseMapper = $responseMapper;

        $omdbConfig = config('tivix.integrations.omdb');
        $this->apiKey = $omdbConfig['api_key'];
        $this->apiBaseUrl = $omdbConfig['base_url'];
    }

    public function getMovies(string $title, ?int $year = null): array
    {
        return $this->getList($title, PositionTypeEnum::MOVIE, $year);
    }

    public function getEpisodes()
    {

    }

    public function getSeries()
    {

    }

    public function getPositionById()
    {

    }
}
