<?php

namespace App\Integrations\OMDB\Traits;

use App\Integrations\OMDB\Enums\ResultTypeEnum;
use GuzzleHttp\Exception\GuzzleException;

trait SendsRequestTrait
{
    public function getList(string $title, string $type, ?int $year = null): array
    {
        try {
            $result = $this->httpClient->get($this->apiBaseUrl, [
                'query' => [
                    'apiKey' => $this->apiKey,
                    's' => $title,
                    'type' => $type,
                    'y' => $year,
                ],
            ]);

            $mapper = $this->mapperFactory->getInstance(ResultTypeEnum::LIST);

            return $mapper->map($result->getBody()->getContents());
        } catch (GuzzleException $e) {
            $this->throwException($e);
        }
    }

    public function getPosition(string $id): array
    {
        try {
            $result = $this->httpClient->get($this->apiBaseUrl, [
                'query' => [
                    'apiKey' => $this->apiKey,
                    'i' => $id,
                ],
            ]);

            $mapper = $this->mapperFactory->getInstance(ResultTypeEnum::POSITION);

            return $mapper->map($result->getBody()->getContents());
        } catch (GuzzleException $e) {
            $this->throwException($e);
        }
    }

    private function throwException(GuzzleException $e): \Exception
    {
        $exceptionContent = json_decode($e->getResponse()->getBody()->getContents(), true);
        $exceptionMessage = $exceptionContent['Error'] ?? null;

        throw new \Exception($exceptionMessage, $e->getCode());
    }
}
