<?php

namespace App\Actions\Public;

use App\DTO\PaymentCardDTO;
use App\Enums\OrderStatus;
use App\Http\Requests\Public\PaymentRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateNewOrder
{
    public function handle(PaymentRequest $request, PaymentCardDTO $paymentCardDTO): Order
    {
        return DB::transaction(function () use ($request) {
            /** @var User $user */
            $user = $request->user();

            $productsRequest = collect($request->safe()->products);
            $totalAmount = 0;
            $orderItems = [];

            $productsDB = Product::whereIn('uuid', $productsRequest->pluck('id'))->get();

            $productsDB->each(function (Product $product) use ($productsRequest, &$totalAmount, &$orderItems) {
                $productRequest = $productsRequest->firstWhere('id', $product->uuid);

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
