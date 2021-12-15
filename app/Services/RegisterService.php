<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class RegisterService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(string $name, string $email, string $password): User
    {
        return $this->userRepository->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }
}
