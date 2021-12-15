<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUserData(Request $request): JsonResponse
    {
        return $this->jsonResponse(
            Response::HTTP_OK,
            ['userData' => $this->userService->getUserData($request->user())]
        );
    }
}
