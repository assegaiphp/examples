<?php

namespace Assegaiphp\BlogApi;

use Assegai\Core\Attributes\Modules\Module;
use Assegaiphp\BlogApi\Users\UsersModule;
use Assegaiphp\BlogApi\Posts\PostsModule;
use Assegaiphp\BlogApi\Auth\AuthModule;

#[Module(
  providers: [
    AppService::class
  ],
  controllers: [AppController::class],
  imports: [UsersModule::class, PostsModule::class, AuthModule::class],
  config: [
    'data_source' => 'sqlite:blog_api',
  ]
)]
class AppModule
{
}
