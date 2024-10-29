<?php

namespace App\DTO;

readonly class PaymentCardDTO
{
    public function __construct(
        public string $number,
        public string $exp_month,
        public string $exp_year,
        public string $cvc,
        public string $name
    )
    {
    }

    public function toArray(): array
    {
        return [
            'number' => $this->number,
            'exp_month' => $this->exp_month,
            'exp_year' => $this->exp_year,
            'cvc' => $this->cvc,
            'name' => $this->name,
        ];
    }
}
