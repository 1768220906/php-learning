<?php

require_once __DIR__ . '/database.php';

// 1. 开启事务
$pdo->beginTransaction();

try {
  // 2. 第一步：插入数据
  $sql = 'INSERT INTO transaction_demo (name) VALUES (:name)';

  $stmt = $pdo->prepare($sql);

  $stmt->execute([
    'name' => '测试数据-异常回滚'
  ]);

  echo "第一步：数据插入成功！\n";

  // 3. 第二步：模拟业务异常
  throw new Exception('模拟业务执行失败');

  // 这行代码不会执行
  echo "第二步：业务执行成功！\n";

  // 4. 提交事务
  $pdo->commit();
} catch (Throwable $err) {
  // 5. 捕获异常并回滚
  if ($pdo->inTransaction()) {
    $pdo->rollBack();
    echo "事务已回滚！\n";
  }

  echo "发生异常：" . $err->getMessage() . "\n";
}
