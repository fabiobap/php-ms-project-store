<?php

namespace App\Services;

use App\DTO\CategoryDTO;
use App\Http\Requests\Admin\BasicIndexRequest;
use App\Models\Category;

class CategoryService
{
    public function getAllCategories(BasicIndexRequest $request)
    {
        $per_page = $request->input('per_page', 15);
        $orderBy = $request->input('order_by', 'created_at');
        $orderDir = $request->input('order_dir', 'desc');

        return Category::select('id', 'name', 'slug', 'created_at', 'updated_at')
            ->orderBy($orderBy, $orderDir)
            ->paginate($per_page);
    }

    public function create(CategoryDTO $dto): Category
    {
        return Category::create($dto->toArray());
    }

    public function update(CategoryDTO $dto, Category $category): Category
    {
        return tap($category)->update($dto->toArray());
    }

}
