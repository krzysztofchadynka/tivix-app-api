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
    private ResponseMapperFactory $mapperFactory;
    private string $apiKey;
    private string $apiBaseUrl;

    public function __construct(HttpClient $httpClient, ResponseMapperFactory $mapperFactory)
    {
        $this->httpClient = $httpClient;
        $this->mapperFactory = $mapperFactory;

        $omdbConfig = config('tivix.integrations.omdb');
        $this->apiKey = $omdbConfig['api_key'];
        $this->apiBaseUrl = $omdbConfig['base_url'];
    }

    public function getMovies(string $title, ?int $year = null): array
    {
        return $this->getList($title, PositionTypeEnum::MOVIE, $year);
    }

    public function getEpisodes(string $title, ?int $year = null): array
    {
        return $this->getList($title, PositionTypeEnum::EPISODE, $year);
    }

    public function getSeries(string $title, ?int $year = null): array
    {
        return $this->getList($title, PositionTypeEnum::SERIES, $year);
    }
}
