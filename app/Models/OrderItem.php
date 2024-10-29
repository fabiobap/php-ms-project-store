<?php

namespace App\Models;

use App\Models\Traits\HandleAmountField;
use Database\Factories\OrderItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /** @use HasFactory<OrderItemFactory> */
    use HandleAmountField, HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'amount',
    ];


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'amount' => 'integer',
            'product_id' => 'integer',
            'order_id' => 'integer'
        ];
    }
}
