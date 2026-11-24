<?php

require_once __DIR__ . "/../database.php";

// 1.准备sql
$sql = 'SELECT * FROM products WHERE id = :id';

// 2.预处理sql
$stmt = $pdo->prepare($sql);

// 3.执行sql
$stmt->execute([
  "id" => 999
]);

// 4. 打印结果
$result = $stmt->fetch();

// 5. 判断商品是否存在
if ($result === false) {
  exit("商品不存在\n");
}

print_r($result);
