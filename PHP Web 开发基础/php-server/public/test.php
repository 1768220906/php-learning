<?php

// response header
header('Content-Type: application/json; charset=utf-8');

echo json_encode([
  'code' => 200,
  'message' => 'success',
  'data' => [
    'name' => 'Keyboard',
    'price' => 199
  ]
]);
