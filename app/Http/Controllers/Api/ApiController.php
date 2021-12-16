<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use function response;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function jsonResponse(int $statusCode, $response = [], string $message = null): JsonResponse
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $response
        ], $statusCode);
    }
}
