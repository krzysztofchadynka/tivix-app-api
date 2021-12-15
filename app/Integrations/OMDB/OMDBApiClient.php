<?php

namespace App\Integrations\OMDB;

use App\Integrations\OMDB\Enums\PositionTypeEnum;
use App\Integrations\OMDB\Mappers\ApiResponseMapper;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class OMDBApiClient
{
    private HttpClient $httpClient;
    private ApiResponseMapper $responseMapper;
    private string $apiKey;
    private string $apiBaseUrl;

    public function __construct(HttpClient $httpClient, ApiResponseMapper $responseMapper)
    {
        $this->httpClient = $httpClient;
        $this->responseMapper = $responseMapper;

        $omdbConfig = config('tivix.integrations.omdb');
        $this->apiKey = $omdbConfig['api_key'];
        $this->apiBaseUrl = $omdbConfig['base_url'];
    }

    public function getMovies(string $title, ?int $year = null): array
    {
        try {
            $result = $this->httpClient->get($this->apiBaseUrl, [
                'query' => [
                    'apiKey' => $this->apiKey,
                    's' => $title,
                    'type' => PositionTypeEnum::MOVIE,
                ],
            ]);

            return $this->responseMapper->map($result->getBody()->getContents());
        } catch (GuzzleException $e) {
            $exceptionContent = json_decode($e->getResponse()->getBody()->getContents(), true);
            $exceptionMessage = $exceptionContent['Error'] ?? null;

            throw new \Exception($exceptionMessage, $e->getCode());
        }
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
