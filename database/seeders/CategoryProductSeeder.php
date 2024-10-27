<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cats = Category::factory()->count(10)->create();
        Product::factory()
            ->count(60)
            ->state(new Sequence(
                fn (Sequence $sequence) => ['category_id' => $cats->random()],
            ))
            ->create();

    }
}
