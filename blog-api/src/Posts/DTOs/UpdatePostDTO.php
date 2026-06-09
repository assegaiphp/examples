<?php

namespace Assegaiphp\BlogApi\Posts\DTOs;

use Assegai\Core\Attributes\Injectable;

#[Injectable]
class UpdatePostDTO
{
    public ?string $title = null;
    public ?string $content = null;
}