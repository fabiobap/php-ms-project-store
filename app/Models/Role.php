<?php

namespace App\Models;

use App\Enums\RoleNames;
use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /** @use HasFactory<RoleFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class)->using(PermissionRole::class)->withTimestamps();
    }

    public function scopeAdmin(Builder $query)
    {
        return $query->where('name', RoleNames::ADMIN->value);
    }

    public function scopeCustomer(Builder $query)
    {
        return $query->where('name', RoleNames::CUSTOMER->value);
    }
}
