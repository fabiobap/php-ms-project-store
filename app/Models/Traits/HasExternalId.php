<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

trait HasExternalId
{
use HasUuids;

    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
