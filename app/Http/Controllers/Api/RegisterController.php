<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterController extends ApiController
{
    private RegisterService $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->registerService->register(
                $request->get('name'),
                $request->get('email'),
                $request->get('password'),
            );

            return $this->jsonResponse(Response::HTTP_CREATED, ['userId' => $user->id]);
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getCode(), null, $e->getMessage());
        }
    }
}
