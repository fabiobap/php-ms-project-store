<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'price' => fake()->randomNumber(2, 1),
            'image' => fake()->imageUrl(),
            'slug'=> str()->slug($name),
            'category_id' => Category::all()->random()->id
        ];
    }
}
