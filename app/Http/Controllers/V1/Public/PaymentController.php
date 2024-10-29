<?php

namespace App\Http\Controllers\V1\Public;

use App\Actions\Public\CreateNewOrder;
use App\DTO\PaymentCardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Public\PaymentRequest;
use App\Http\Resources\Public\Order\OrderResource;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function order(PaymentRequest $request, CreateNewOrder $action): OrderResource
    {
        $order = $action->handle($request, new PaymentCardDTO(...$request->safe()->card));
        $order->load('orderItems.product');

        return new OrderResource($order);
    }
}
