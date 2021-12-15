<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUserData(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
}
