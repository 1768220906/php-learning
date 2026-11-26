<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}


    // 获取商品列表
    public function getProducts(int $page, int $perPage)
    {
        $result = Product::query()->with("category")->paginate(page: $page, perPage: $perPage);

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

    // 创建商品
    public function createProduct(
        int $categoryId,
        string $name,
        ?string $description,
        float $price,
        int $stock
    ) {
        $category = Category::query()->findOrFail($categoryId);

        $productParams = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
        ];

        $product = $category->products()->create($productParams);

        // 记录商品创建成功日志
        Log::info('商品创建成功', [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'category_id' => $product->category_id,
            'price' => $product->price,
        ]);

        return $product;
    }
}
