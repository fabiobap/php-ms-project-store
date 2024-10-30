<?php

namespace App\Models;

use App\Models\Traits\HandleAmountField;
use App\Models\Traits\HasExternalUuid;
use App\Models\Traits\SlugHandler;
use App\Observers\ProductObserver;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HandleAmountField, HasExternalUuid, HasFactory, SlugHandler;

    protected $fillable = [
        'name',
        'description',
        'amount',
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
            'amount' => 'integer',
            'category_id' => 'integer',
        ];
    }
}
