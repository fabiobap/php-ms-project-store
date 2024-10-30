<?php

namespace App\Services;

use App\DTO\ProductDTO;
use App\Http\Requests\Admin\BasicIndexRequest;
use App\Models\Product;

class ProductService
{
    public function getAllProducts(BasicIndexRequest $request)
    {
        $per_page = $request->input('per_page', 15);
        $orderBy = $request->input('order_by', 'created_at');
        $orderDir = $request->input('order_dir', 'desc');

        return Product::select(
            'id',
            'uuid',
            'name',
            'slug',
            'description',
            'amount',
            'category_id',
            'image',
            'created_at',
            'updated_at'
        )->with('category')
            ->orderBy($orderBy, $orderDir)
            ->paginate($per_page);
    }

    public function create(ProductDTO $dto): Product
    {
        return Product::create($dto->toArray());
    }

    public function update(ProductDTO $dto, Product $product): Product
    {
        return tap($product)->update($dto->toArray());
    }

}
