<?php

namespace App\Observers;

class ProductObserver
{
    public function creating($product): void
    {
        $product->image = 'https://placehold.co/600x400';
    }
}
