<?php

header('Content-Type: application/json; charset=utf-8');

// 文件上传
$file = $_FILES['avatar'] ?? null;

if ($file !== null && $file['error'] === UPLOAD_ERR_OK) {
  $target = __DIR__ . '/uploads/' . $file['name'];

  move_uploaded_file($file['tmp_name'], $target);
}

echo json_encode([
  'files' => $_FILES
]);
