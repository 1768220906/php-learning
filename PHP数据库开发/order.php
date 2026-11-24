
<?php

require_once __DIR__ . "/database.php";

// 模拟下单参数
$info = [
  "productId" => 2,
  "count" => 999,
];

try {
  // 1. 开启事务
  $pdo->beginTransaction();

  // 2. 扣减商品库存
  $sqlProduct = '
        UPDATE products
        SET stock = stock - :deductCount
        WHERE id = :productId
          AND stock >= :requiredCount
        RETURNING id, price, stock
    ';

  $stmtProduct = $pdo->prepare($sqlProduct);
  $stmtProduct->execute([
    "deductCount" => $info["count"],
    "productId" => $info["productId"],
    "requiredCount" => $info["count"],
  ]);

  $resultProduct = $stmtProduct->fetch();

  if ($resultProduct === false) {
    throw new Exception("商品不存在或库存不足");
  }

  // FETCH_ASSOC 返回关联数组
  $productId = $resultProduct["id"];
  $price = (float) $resultProduct["price"];
  $stock = $resultProduct["stock"];

  // 计算订单总金额
  $totalAmount = $price * $info["count"];

  // 3. 创建订单
  $orderNo = "ORDER-" . bin2hex(random_bytes(8));

  $sqlOrder = '
        INSERT INTO orders (order_no, total_amount)
        VALUES (:orderNo, :totalAmount)
        RETURNING id
    ';

  $stmtOrder = $pdo->prepare($sqlOrder);
  $stmtOrder->execute([
    "orderNo" => $orderNo,
    "totalAmount" => $totalAmount,
  ]);

  $resultOrder = $stmtOrder->fetch();

  if ($resultOrder === false) {
    throw new Exception("创建订单失败");
  }

  $orderId = $resultOrder["id"];

  // 4. 创建订单明细
  $sqlLink = '
        INSERT INTO order_items (
            order_id,
            product_id,
            quantity,
            price
        )
        VALUES (
            :orderId,
            :productId,
            :quantity,
            :price
        )
    ';

  $stmtLink = $pdo->prepare($sqlLink);
  $stmtLink->execute([
    "orderId" => $orderId,
    "productId" => $productId,
    "quantity" => $info["count"],
    "price" => $price,
  ]);

  // 5. 提交事务
  $pdo->commit();

  echo "创建订单成功！\n";
  echo "订单编号：{$orderNo}\n";
  echo "订单金额：{$totalAmount}\n";
  echo "剩余库存：{$stock}\n";
} catch (Throwable $th) {

  if ($pdo->inTransaction()) {
    $pdo->rollBack();
  }

  echo "下单失败：" . $th->getMessage() . "\n";
}
