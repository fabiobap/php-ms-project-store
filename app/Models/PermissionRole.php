<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionRole extends Pivot
{

    protected $table = 'permission_role';
    protected $fillable = [
        'permission_id',
        'role_id'
    ];

    protected function casts(): array
    {
        return [
            'permission_id' => 'integer',
            'role_id' => 'integer'
        ];
    }
}
