<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        // 验证分页参数
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ]);

        // 获取分页参数
        $page = (int) ($validated['page'] ?? 1);
        $perPage = (int) ($validated['per_page'] ?? 10);

        $data = $this->productService->getProducts(page: $page, perPage: $perPage);

        return response()->json([
            'code' => 200,
            'message' => '商品列表获取成功',
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {
        // 验证商品参数
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'gt:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        // 获取商品参数
        $categoryId = (int) $validated['category_id'];
        $name = $validated['name'];
        $description = $validated['description'] ?? null;
        $price = (float) $validated['price'];
        $stock = (int) $validated['stock'];

        // 调用 Service 创建商品
        $data = $this->productService->createProduct(
            categoryId: $categoryId,
            name: $name,
            description: $description,
            price: $price,
            stock: $stock
        );

        return response()->json([
            'code' => 201,
            'message' => '商品创建成功',
            'data' => $data,
        ], 201);
    }
}
