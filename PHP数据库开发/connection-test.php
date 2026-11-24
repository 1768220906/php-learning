<?php

$password = getenv("DB_PASSWORD");

if ($password === false || $password === '') {
  exit("请先设置 DB_PASSWORD 环境变量\n");
}

try {
  $pdo = new PDO(
    'pgsql:host=127.0.0.1;port=5433;dbname=php_learning',
    "php_learning_user",
    $password,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]

  );

  echo "PostgreSQL 连接成功！\n";


  /* 基础 */
  // $stmt = $pdo->query(
  //   'SELECT current_database(), current_user, version()'
  // );

  // $result = $stmt->fetch();

  // print_r($result);

  // $stmt = $pdo->query('SELECT generate_series(1, 3) AS number');

  // 循环获取
  // while ($row = $stmt->fetch()) {
  //   print_r($row);
  // };

  // 一次获取
  // $result = $stmt->fetchAll();
  // print_r($result);

  /* 预处理 */

  // $stmt = $pdo->prepare("SELECT :name AS username, :age AS age");

  // $stmt->execute([
  //   "name" => "jack",
  //   "age" => 18
  // ]);

  // $result = $stmt->fetch();

  // print_r($result);

  /* 恶意注入 */

  // $input = "' OR '1'='1";
  // $stmt = $pdo->prepare("SELECT :name AS username");

  // $stmt->execute([
  //   "name" => $input
  // ]);
  // $result = $stmt->fetch();
  // print_r($result);

  /* bindValue 和 bindParams */

  // $name = "jack";

  // $stmt = $pdo->prepare("SELECT :name AS username");

  // // $stmt->bindValue(":name", $name);
  // $stmt->bindParam(":name", $name);
  // $name = "tom";

  // $stmt->execute();

  // $result = $stmt->fetch();

  // print_r($result);
} catch (PDOException $e) {
  echo "数据库连接失败：{$e->getMessage()}\n";
}
