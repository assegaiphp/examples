<?php

namespace Assegaiphp\BlogApi\Users\DTOs;

use Assegai\Core\Attributes\Injectable;

#[Injectable]
class CreateUserDTO
{
    public string $email;
    public string $password;
    public ?string $firstName = null;
    public ?string $lastName = null;
}