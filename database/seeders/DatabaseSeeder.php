<?php

namespace Database\Seeders;

use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(UserRepository $userRepository)
    {
        $userRepository->create([
            'name' => 'test-user',
            'email' => 'test-user@tivix.com',
            'password' => Hash::make('test1234'),
        ]);
    }
}
