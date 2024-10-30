<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Models\Traits\HandleAmountField;
use App\Models\Traits\HasExternalUuid;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HandleAmountField, HasExternalUuid, HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'external_id',
        'status',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'user_id' => 'integer',
            'amount' => 'integer',
        ];
    }
}
