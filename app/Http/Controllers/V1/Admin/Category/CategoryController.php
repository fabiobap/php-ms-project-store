<?php

namespace App\Http\Controllers\V1\Admin\Category;

use App\DTO\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BasicIndexRequest;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Http\Resources\Admin\Categories\CategoryResource;
use App\Http\Resources\Admin\Categories\CategoryResourceCollection;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BasicIndexRequest $request): CategoryResourceCollection
    {
        return new CategoryResourceCollection($this->categoryService->getAllCategories($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $category = $this->categoryService->create(new CategoryDTO(...$request->validated()));

        return $this->show($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
    {
        $category = $this->categoryService->update(new CategoryDTO(...$request->validated()), $category);

        return $this->show($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): Response
    {
        $category->delete();
        return response()->noContent();
    }
}
