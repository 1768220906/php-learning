<?php

$password = getenv("DB_PASSWORD");

if ($password === false || $password === '') {
  exit("请先设置 DB_PASSWORD 环境变量\n");
}

try {
  $pdo = new PDO(
    'pgsql:host=127.0.0.1;port=5433;dbname=postgres',
    "infra_admin",
    $password,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]

  );

  echo "PostgreSQL 连接成功！\n";

  $stmt = $pdo->query(
    'SELECT current_database(), current_user, version()'
  );

  $result = $stmt->fetch();

  print_r($result);
} catch (PDOException $e) {
  echo "数据库连接失败：{$e->getMessage()}\n";
}
