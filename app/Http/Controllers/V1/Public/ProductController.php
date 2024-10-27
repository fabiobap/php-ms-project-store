<?php

namespace App\Http\Controllers\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BasicIndexRequest;
use App\Http\Resources\Public\Products\ProductResource;
use App\Http\Resources\Public\Products\ProductResourceCollection;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $productService)
    {
    }

    public function index(BasicIndexRequest $request): ProductResourceCollection
    {
        return new ProductResourceCollection($this->productService->getAllProducts($request));
    }

    public function show(Product $product): ProductResource
    {
        $product->load('category');

        return new ProductResource($product);
    }
}
