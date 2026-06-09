<?php

namespace Assegaiphp\BlogApi\Posts\DTOs;

use Assegai\Core\Attributes\Injectable;

#[Injectable]
class CreatePostDTO
{
    public string $title;
    public string $content = '';
}