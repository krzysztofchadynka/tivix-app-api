<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            return $this->jsonResponse(Response::HTTP_OK, [
                'token' => $this->authService->login($request->get('email'), $request->get('password')),
            ]);
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getCode(), null, $e->getMessage());
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->jsonResponse(Response::HTTP_OK, null, 'User successfully deleted!');
    }
}
