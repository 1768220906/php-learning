<?php

require_once __DIR__ . '/../services/productService.php';

class ProductController
{
  private ProductService $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  public function index(): void
  {
    // 调用 Service 获取商品
    $products = $this->productService->getProducts();

    // 设置 HTTP 响应头
    header('Content-Type: application/json; charset=utf-8');

    // 返回 JSON
    echo json_encode($products, JSON_UNESCAPED_UNICODE);
  }
}
