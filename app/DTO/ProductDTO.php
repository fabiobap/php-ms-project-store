<?php

namespace App\DTO;

readonly class ProductDTO
{

    public function __construct(
        public string  $name,
        public int     $amount,
        public string  $description,
        public int     $category_id,
        public ?string $slug = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'amount' => $this->amount,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'slug' => $this->slug,
        ];
    }
}
