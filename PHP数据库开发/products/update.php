<?php

require_once __DIR__ . "/../database.php";

// 1.准备sql
$sql = 'UPDATE products SET price = :price, stock = :stock WHERE id = :id RETURNING id, name, description, price, stock';

// 2.预处理sql
$stmt = $pdo->prepare($sql);

// 3.执行sql
$stmt->execute([
  "id" => 1,
  "price" => 329.00,
  "stock" => 40,
]);

// 4. 打印结果
$result = $stmt->fetch();

if ($result === false) {
  exit("商品不存在，更新失败\n");
}

print_r($result);
