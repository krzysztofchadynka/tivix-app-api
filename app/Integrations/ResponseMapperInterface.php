<?php

namespace App\Integrations;

interface ResponseMapperInterface
{
    public function map(string $jsonResponse): array;
}
