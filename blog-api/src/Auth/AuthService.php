<?php

namespace Assegaiphp\BlogApi\Auth;

use Assegai\Core\Attributes\Injectable;
use Assegaiphp\BlogApi\Users\Entities\UserEntity;

#[Injectable]
class AuthService
{
    /**
     * @return object<UserEntity>|null
     */
    public function getUser(): ?object
    {
        $user = new UserEntity();

        $user->id = 1;
        $user->email = 'user@example.com';
        $user->firstName = 'Basic';
        $user->lastName = 'User';

        return $user;
    }
}
