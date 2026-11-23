<?php

function successResponse(mixed $data = null, string $message = '请求成功'): void
{
  header('Content-Type: application/json; charset=utf-8');

  echo json_encode([
    'success' => true,
    'message' => $message,
    'data' => $data
  ], JSON_UNESCAPED_UNICODE);

  exit;
}

function errorResponse(string $message, int $statusCode = 400): void
{
  http_response_code($statusCode);

  header('Content-Type: application/json; charset=utf-8');

  echo json_encode([
    'success' => false,
    'message' => $message,
    'data' => null
  ], JSON_UNESCAPED_UNICODE);

  exit;
}
