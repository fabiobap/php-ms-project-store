<?php

namespace App\DTO;

readonly class CategoryDTO
{

    public function __construct(
        public string  $name,
        public ?string $slug = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
