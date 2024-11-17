<?php

namespace App\Http\Resources\Public\Order;

use App\Http\Resources\Auth\UserMeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'external_id'=>$this->external_id,
            'total_amount' => $this->amount,
            'status' => $this->status->value,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'user' => new UserMeResource($this->whenLoaded('user')),
            'items'=> OrderItemResource::collection($this->whenLoaded('orderItems'))
        ];
    }
}
