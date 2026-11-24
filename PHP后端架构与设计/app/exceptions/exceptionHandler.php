<?php

class ExceptionHandler
{
  public static function handle(Throwable $e): void
  {
    if ($e instanceof InvalidArgumentException) {
      self::sendJson(400, [
        'code' => 400,
        'message' => $e->getMessage(),
      ]);
      return;
    }

    if ($e instanceof ProductNotFoundException) {
      self::sendJson(404, [
        'code' => 404,
        'message' => $e->getMessage(),
      ]);
      return;
    }

    error_log((string) $e);

    self::sendJson(500, [
      'code' => 500,
      'message' => '服务器内部错误',
    ]);
  }

  private static function sendJson(int $statusCode, array $data): void
  {
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }
}
