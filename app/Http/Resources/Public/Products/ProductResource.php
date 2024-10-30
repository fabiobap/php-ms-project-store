<?php

namespace App\Http\Resources\Public\Products;

use App\Http\Resources\Public\Categories\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'image' => $this->image,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
