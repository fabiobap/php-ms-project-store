<?php

namespace App\Actions\Public;

use App\DTO\PaymentCardDTO;
use App\Enums\OrderStatus;
use App\Http\Requests\Public\PaymentRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CreateNewOrder
{
    public function handle(
        User           $user,
        PaymentCardDTO $paymentCardDTO,
        array          $selectedProducts,
    ): Order
    {
        return DB::transaction(function () use ($selectedProducts, $user) {
            $selectedProducts = collect($selectedProducts);
            $totalAmount = 0;
            $orderItems = [];

            $productsDB = Product::whereIn('uuid', $selectedProducts->pluck('id'))->get();

            $productsDB->each(function (Product $product) use ($selectedProducts, &$totalAmount, &$orderItems) {
                $productRequest = $selectedProducts->firstWhere('id', $product->uuid);

                $totalAmount += $product->getRawOriginal('amount') * $productRequest['quantity'];

                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $productRequest['quantity'],
                    'amount' => $product->getRawOriginal('amount'),
                ];
            });

            /** @var Order $order */
            $order = $user->orders()->create([
                'amount' => $totalAmount,
                'external_id' => str()->uuid()->toString(),
                'status' => OrderStatus::PENDING,
            ]);

            $order->orderItems()->createMany($orderItems);

            return $order;
        });
    }
}
