<?php

namespace App\Repositories;

use App\Models\User;
use AwesIO\Repository\Eloquent\BaseRepository;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository extends BaseRepository
{
    public function entity(): string
    {
        return User::class;
    }

    public function findUserByEmail(string $email): User
    {
        /** @var User $user */
        $user = $this->findWhere(['email' => $email])->first();

        if (!$user) {
            throw new NotFoundHttpException(
                'Given user does not exist.',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        return $user;
    }
}
