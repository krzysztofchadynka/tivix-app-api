<?php

namespace App\Integrations\OMDB\Traits;

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

            return $this->responseMapper->map($result->getBody()->getContents());
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
