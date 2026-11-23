<?php

header('Content-Type: application/json; charset=utf-8');

// 1. 接收表单数据
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$age = $_POST['age'] ?? '';

// 2. 收集验证错误
$errors = [];

// 验证姓名
if ($name === '') {
  $errors['name'] = '姓名不能为空';
}

// 验证邮箱
// filter_var 按指定规则验证或过滤数据
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors['email'] = '邮箱格式不正确';
}

// 验证年龄
if (filter_var($age, FILTER_VALIDATE_INT) === false) {
  $errors['age'] = '年龄必须是整数';
} elseif ($age < 1 || $age > 150) {
  $errors['age'] = '年龄必须在 1 到 150 之间';
}

// 3. 返回验证结果
if (!empty($errors)) {
  // 设置状态码
  http_response_code(400);

  echo json_encode([
    'success' => false,
    'errors' => $errors
  ]);

  exit;
}

echo json_encode([
  'success' => true,
  'message' => '验证通过',
  'data' => [
    'name' => $name,
    'email' => $email,
    'age' => (int) $age
  ]
]);
