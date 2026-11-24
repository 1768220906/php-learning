<?php

require_once __DIR__ . "/../database.php";

// // 1.准备sql
// $sql = 'SELECT * FROM products ORDER BY id';

// // 2.执行sql
// $stmt = $pdo->query($sql);

// // 3.打印结果
// $result = $stmt->fetchAll();
// print_r($result);

// 1. 定义参数
$allowedColumns = ['id', 'price', 'created_at', 'name'];
$allowedDirections = ['ASC', 'DESC'];

// 2.模拟请求参数
$column = "id";
$direction = "ASC";

// 3. 严格校验：不在白名单内则直接终止程序，彻底杜绝 SQL 注入
if (!in_array($column, $allowedColumns, true)) {
  exit("不支持的排序字段\n");
}

if (!in_array($direction, $allowedDirections, true)) {
  exit("不支持的排序方向\n");
}

// 4. sql
$sql = "SELECT * FROM products ORDER BY {$column} {$direction}";

// 5. 执行
$stmt = $pdo->query($sql);

// 6. 打印结果
$result = $stmt->fetchAll();
print_r($result);
