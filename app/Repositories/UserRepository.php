<?php

namespace App\Repositories;

use App\Models\User;
use AwesIO\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{
    public function entity(): string
    {
        return User::class;
    }
}
