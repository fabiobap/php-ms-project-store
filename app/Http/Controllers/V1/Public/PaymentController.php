<?php

namespace App\Http\Controllers\V1\Public;

use App\Actions\Public\CreateNewOrder;
use App\DTO\PaymentCardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Public\PaymentRequest;
use App\Http\Resources\Public\Order\OrderResource;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function order(PaymentRequest $request, CreateNewOrder $action): OrderResource
    {
        /** @var User $user */
        $user = $request->user();

        $order = $action->handle(
            $user,
            new PaymentCardDTO(...$request->safe()->card),
            $request->safe()->products
        );
        $order->load('orderItems.product');

        return new OrderResource($order);
    }
}
