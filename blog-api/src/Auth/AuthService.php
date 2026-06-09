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
        /*
         * In a real production app this would be where you would check the request for a valid JWT token, and if one
         * is found, decode it and return the user associated with the token. For this demo, we'll just return a
         * hardcoded user.
         */
        $user = new UserEntity();

        $user->id = 1;
        $user->email = 'user@example.com';
        $user->firstName = 'Basic';
        $user->lastName = 'User';

        return $user;
    }
}
