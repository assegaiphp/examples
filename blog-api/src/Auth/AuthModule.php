<?php

namespace Assegaiphp\BlogApi\Auth;

use Assegai\Core\Attributes\Modules\Module;

#[Module(
    providers: [AuthService::class],
    controllers: [],
    imports: [],
    exports: [AuthService::class],
)]
class AuthModule
{
}
