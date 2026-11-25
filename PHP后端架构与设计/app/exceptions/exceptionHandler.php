<?php

require_once __DIR__ . '/../logger.php';

class ExceptionHandler
{
  public static function handle(Throwable $e): void
  {
    if ($e instanceof InvalidArgumentException) {
      self::sendJson(400, [
        'code' => 400,
        'message' => $e->getMessage(),
        'data' => null,
      ]);
      return;
    }

    if ($e instanceof ProductNotFoundException) {
      self::sendJson(404, [
        'code' => 404,
        'message' => $e->getMessage(),
        'data' => null,
      ]);
      return;
    }

    if ($e instanceof RouteNotFoundException) {
      self::sendJson(404, [
        'code' => 404,
        'message' => $e->getMessage(),
        'data' => null,
      ]);
      return;
    }

    // 未预期的异常，记录详细错误
    Logger::error(
      get_class($e) . ': ' . $e->getMessage()
    );

    self::sendJson(500, [
      'code' => 500,
      'message' => '服务器内部错误',
      'data' => null,
    ]);
  }

  private static function sendJson(int $statusCode, array $data): void
  {
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }
}
