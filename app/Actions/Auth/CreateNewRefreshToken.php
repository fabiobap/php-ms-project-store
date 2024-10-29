<?php

namespace App\Actions\Auth;

use App\Enums\APITokenTypes;
use App\Models\User;

class CreateNewRefreshToken
{

    public function handle(User $user): string
    {
        return $user->createToken(
            APITokenTypes::REFRESH_TOKEN->value,
            [APITokenTypes::REFRESH_TOKEN->getAbility()],
            now()->addMinutes(config('sanctum.rt_expiration'))
        )->plainTextToken;
    }
}
