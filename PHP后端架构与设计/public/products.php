<?php

require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../app/repositories/ProductRepository.php';
require_once __DIR__ . '/../app/services/ProductService.php';
require_once __DIR__ . '/../app/controllers/productController.php';

// 创建 Repository
$productRepository = new ProductRepository($pdo);

// 创建 Service，并注入 Repository
$productService = new ProductService($productRepository);

// 创建 Controllers，并注入 Service，并注入
$productControllers = new ProductController($productService);

$productControllers->index();
