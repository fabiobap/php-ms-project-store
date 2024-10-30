<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

trait HasExternalUuid
{
use HasUuids;

    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
