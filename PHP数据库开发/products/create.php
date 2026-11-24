<?php

require_once __DIR__ . "/../database.php";

// 1.准备sql
$sql = 'INSERT INTO products (name, description, price, stock)
  VALUES (:name, :description, :price, :stock)
  RETURNING id
';

// 2.准备插入的数据
$product = [
  'name' => '机械键盘',
  'description' => '一把用于编程的机械键盘',
  'price' => '299.00',
  'stock' => 50,
];

// 3. 预处理sql
$stmt = $pdo->prepare($sql);

// 4. 执行sql
$stmt->execute($product);

// 5.打印结果
$result = $stmt->fetch();
print_r($result);
