<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterController extends Controller
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

            return response()->json([
                'state' => Response::HTTP_CREATED,
                'user_id' => $user->id,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'state' => $e->getCode(),
                'message' => $e->getMessage(),s
            ], $e->getCode());
        }
    }
}
