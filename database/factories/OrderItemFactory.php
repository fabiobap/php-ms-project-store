<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::all()->random();

        return [
            'amount' => $product->getRawOriginal('amount'),
            'quantity' => fake()->randomNumber(1, true),
            'order_id' => Order::all()->random()->id,
            'product_id' => $product->id,
        ];
    }
}
