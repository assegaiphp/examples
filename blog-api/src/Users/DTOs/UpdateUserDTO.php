<?php

namespace Assegaiphp\BlogApi\Users\DTOs;

use Assegai\Core\Attributes\Injectable;

#[Injectable]
class UpdateUserDTO
{
    public ?string $password = null;
    public ?string $firstName = null;
    public ?string $lastName = null;
}