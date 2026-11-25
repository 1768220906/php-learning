<?php

$config = require __DIR__ . '/database.php';


if ($config['password'] === false || $config['password'] === '') {
  exit("请先设置 DB_PASSWORD 环境变量\n");
}

$dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

$pdo = new PDO(
  $dsn,
  $config['username'],
  $config['password'],
  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]
);
