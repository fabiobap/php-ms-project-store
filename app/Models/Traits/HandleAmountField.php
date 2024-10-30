<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HandleAmountField
{
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => number_format($value / 100, 2),
        );
    }
}
