<?php

namespace App\Integrations\OMDB\Mappers;

use App\Integrations\ResponseMapperInterface;

class ApiListResponseMapper implements ResponseMapperInterface
{
    public function map(string $jsonResponse): array
    {
        $response = json_decode($jsonResponse, true);

        if (isset($response['Search'])) {
            $response = collect($response['Search']);

            return $response->transform(function (array $item) {
                return [
                    'id' => $item['imdbID'],
                    'title' => $item['Title'] ?? null,
                    'year' => $item['Year'] ?? null,
                    'imageUrl' => $item['Poster'] ?? null,
                ];
            })->toArray();
        }

        return [];
    }
}
