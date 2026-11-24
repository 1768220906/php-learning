<?php

$password = getenv("DB_PASSWORD");

if ($password === false || $password === '') {
  exit("请先设置 DB_PASSWORD 环境变量\n");
}


$pdo = new PDO(
  'pgsql:host=127.0.0.1;port=5433;dbname=php_learning',
  'php_learning_user',
  $password,
  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]
);
