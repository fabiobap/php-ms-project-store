<?php

namespace App\Enums;

trait ToArray
{
    public static function toArray(): array
    {
        return collect(self::cases())->map(fn($item) => $item->value)->toArray();
    }

    public static function toArrayFlipped(): array
    {
        return array_flip(self::toArray());
    }
}
