<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $email, string $password): string
    {
        $user = $this->userRepository->findUserByEmail($email);

        if (!Hash::check($password, $user->password)) {
            throw new BadRequestHttpException(
                'Given password is invalid',
                null,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return $user->createToken('user_device')->plainTextToken;
    }
}
