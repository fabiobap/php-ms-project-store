<?php

namespace App\Models;

use App\Models\Traits\HasExternalId;
use App\Models\Traits\SlugHandler;
use App\Observers\ProductObserver;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasExternalId, HasFactory, SlugHandler;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'uuid',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'category_id' => 'integer',
        ];
    }

    /**
     * Interact with the user's first name.
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => number_format($value / 100, 2),
        );
    }
}
