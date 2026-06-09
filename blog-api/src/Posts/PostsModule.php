<?php

namespace Assegaiphp\BlogApi\Posts;

use Assegai\Core\Attributes\Modules\Module;
use Assegaiphp\BlogApi\Auth\AuthModule;

#[Module(
    providers: [PostsService::class],
    controllers: [PostsController::class],
    imports: [AuthModule::class]
)]
class PostsModule
{
}