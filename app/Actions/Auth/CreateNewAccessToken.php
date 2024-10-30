<?php

namespace App\Actions\Auth;

use App\Enums\APITokenTypes;
use App\Models\User;

class CreateNewAccessToken
{

    public function handle(User $user): string
    {
        return $user->createToken(
            APITokenTypes::ACCESS_TOKEN->value,
            [APITokenTypes::ACCESS_TOKEN->getAbility()],
            now()->addMinutes(config('sanctum.at_expiration'))
        )->plainTextToken;
    }
}
