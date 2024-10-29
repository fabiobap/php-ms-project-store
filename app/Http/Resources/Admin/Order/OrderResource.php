<?php

namespace App\Http\Resources\Admin\Order;

use App\Http\Resources\Admin\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'total_amount' => $this->amount,
            'external_id' => $this->external_id,
            'status' => $this->status->value,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
            'user' => new UserResource($this->whenLoaded('user')),
            'items'=> OrderItemResource::collection($this->whenLoaded('orderItems'))
        ];
    }
}
