<?php

require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../app/repositories/ProductRepository.php';
require_once __DIR__ . '/../app/services/ProductService.php';
require_once __DIR__ . '/../app/controllers/productController.php';
require_once __DIR__ . '/../app/exceptions/exceptionHandler.php';

// 创建 Repository
$productRepository = new ProductRepository($pdo);

// 创建 Service，并注入 Repository
$productService = new ProductService($productRepository);

// 创建 Controllers，并注入 Service，并注入
$productController = new ProductController($productService);

$method = $_SERVER["REQUEST_METHOD"];

try {

  switch ($method) {

    case 'GET':

      if (isset($_GET['id'])) {
        $productController->show();
        break;
      }

      $productController->index();
      break;

    case 'POST':

      $productController->create();

      break;

    default:
      http_response_code(405);
      echo 'Method Not Allowed';
      break;
  }
} catch (Throwable $e) {
  ExceptionHandler::handle($e);
}
