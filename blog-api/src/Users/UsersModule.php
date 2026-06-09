<?php

namespace Assegaiphp\BlogApi\Users;

use Assegai\Core\Attributes\Modules\Module;
use Assegaiphp\BlogApi\Auth\AuthModule;

#[Module(
  providers: [UsersService::class],
  controllers: [UsersController::class],
  imports: [AuthModule::class],
  config: ['data_source' => 'sqlite:blog_api']
)]
class UsersModule
{
}