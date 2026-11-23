<?php

require_once __DIR__ . '/response.php';

$products = [
  ['id' => 1, 'name' => 'iPhone 17'],
  ['id' => 2, 'name' => 'MacBook Pro']
];

$id = (int) ($_GET['id'] ?? 0);

foreach ($products as $product) {
  if ($product['id'] === $id) {
    successResponse($product);
  }
}

errorResponse('商品不存在', 404);
