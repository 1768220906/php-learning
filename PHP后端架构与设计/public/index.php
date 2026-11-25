<?php

require_once __DIR__ . '/../app/router.php';
require_once __DIR__ . '/../app/repositories/productRepository.php';
require_once __DIR__ . '/../app/services/productService.php';
require_once __DIR__ . '/../app/controllers/productController.php';
require_once __DIR__ . '/../app/exceptions/exceptionHandler.php';

try {
  require_once __DIR__ . '/../app/config/connection.php';
  /* 组装依赖 */
  // 创建 Repository
  $productRepository = new ProductRepository($pdo);
  // 创建 Service，并注入 Repository
  $productService = new ProductService($productRepository);
  // 创建 Controllers，并注入 Service，并注入
  $productController = new ProductController($productService);

  /* 注册路由 */
  $router = new Router();

  $router->get('/products', [$productController, 'index']);

  // 先不使用动态路由
  $router->get('/products/query', [$productController, 'show']);

  $router->post('/products',  [$productController, 'create']);

  $method = $_SERVER['REQUEST_METHOD'];
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

  $router->dispatch($method, $path);
} catch (Throwable $e) {
  ExceptionHandler::handle($e);
}
