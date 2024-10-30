<?php

namespace Database\Seeders;

use App\Actions\Public\CreateNewOrder;
use App\DTO\PaymentCardDTO;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        $paymentCardDTO = new PaymentCardDTO(
            '424242424242',
            '05',
            '2025',
            '345',
            'John Doe'
        );

        User::inRandomOrder()->customer()->limit(10)->get()->each(function (User $user) use ($paymentCardDTO) {
            $selectedProducts = [];

            $products = Product::select('uuid')->get()->random(3);
            $products->each(function ($product) use (&$selectedProducts) {
                $selectedProducts[] = ['id' => $product->uuid, 'quantity' => random_int(1, 20)];
            });

            $action = new CreateNewOrder();
            $action->handle($user, $paymentCardDTO, $selectedProducts);
        });
    }
}
