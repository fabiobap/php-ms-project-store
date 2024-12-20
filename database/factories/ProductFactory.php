<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = fake()->words(3, true),
            'description' => fake()->sentence(),
            'amount' => fake()->randomNumber(4, 1),
            'image' => fake()->imageUrl(),
            'category_id' => Category::all()->random()->id
        ];
    }
}
