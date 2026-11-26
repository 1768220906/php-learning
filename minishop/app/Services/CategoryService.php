<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    // 获取分类列表
    public function getCategories(int $page, int $perPage)
    {
        $result = Category::query()->paginate(page: $page, perPage: $perPage);

        $pagination = [
            'current_page' => $result->currentPage(),
            'per_page' => $result->perPage(),
            'total' => $result->total(),
            'last_page' => $result->lastPage(),
        ];

        return [
            'items' => $result->items(),
            'pagination' => $pagination,
        ];
    }
}
