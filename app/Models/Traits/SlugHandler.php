<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait SlugHandler
{
    protected static function booted(): void
    {
        static::creating(function (Model $model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model, $model->name);
            }
        });

        static::updating(function (Model $model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model, $model->name, $model->id);
            }
        });
    }

    protected static function generateUniqueSlug(Model $model, string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        $query = $model->where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $count++;
            $query = $model->where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }
}
