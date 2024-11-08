<?php

namespace App\Http\Controllers\V1\Admin\Product;

use App\DTO\ProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BasicIndexRequest;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Resources\Admin\Products\ProductResource;
use App\Http\Resources\Admin\Products\ProductResourceCollection;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    public function __construct(private readonly ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BasicIndexRequest $request): ProductResourceCollection
    {
        return new ProductResourceCollection($this->productService->getAllProducts($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $product = $this->productService->create(new ProductDTO(...$request->validated()));
        $product->load('category');

        return $this->show($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): ProductResource
    {
        $product->load('category');

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $product = $this->productService->update(new ProductDTO(...$request->validated()), $product);
        $product->load('category');

        return $this->show($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): Response
    {
        $product->delete();
        return response()->noContent();
    }
}
