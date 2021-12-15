<?php

namespace App\Integrations\OMDB;

use App\Integrations\ResponseMapperInterface;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResponseMapperFactory
{
    public function getInstance(string $resultType): ResponseMapperInterface
    {
        $mapper = '\\App\\Integrations\\OMDB\\Mappers\\Api' . $resultType . 'ResponseMapper';

        if (!class_exists($mapper)) {
            throw new NotFoundHttpException(
                'Mapper class does not exist',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        return new $mapper;
    }
}
