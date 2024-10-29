<?php

namespace App\Enums;

enum APITokenTypes: string
{
    use ToArray;

    case ACCESS_TOKEN = 'access_token';
    case REFRESH_TOKEN = 'refresh_token';


    public function getAbility(): string
    {
        return match ($this) {
            self::ACCESS_TOKEN => 'access-token',
            self::REFRESH_TOKEN => 'issue-access-token',
        };
    }
}
