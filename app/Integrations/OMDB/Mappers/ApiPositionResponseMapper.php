<?php

namespace App\Integrations\OMDB\Mappers;

use App\Integrations\ResponseMapperInterface;

class ApiPositionResponseMapper implements ResponseMapperInterface
{
    public function map(string $jsonResponse): array
    {
        $response = json_decode($jsonResponse, true);

        return [
            'title' => $response['Title'],
            'year' => $response['Year'] ?? null,
            'released' => $response['Released'] ?? null,
            'director' => $response['Director'] ?? null,
            'description' => $response['Plot'] ?? null,
            'image' => $response['Poster'] ?? null,
        ];
    }
}
