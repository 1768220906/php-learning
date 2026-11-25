
<?php

class Logger
{
  public static function info(string $message): void
  {
    self::write('INFO', $message);
  }

  public static function warning(string $message): void
  {
    self::write('WARNING', $message);
  }

  public static function error(string $message): void
  {
    self::write('ERROR', $message);
  }

  private static function write(string $level, string $message): void
  {
    $time = date('Y-m-d H:i:s');

    $log = "[{$time}] [{$level}] {$message}";

    error_log($log . PHP_EOL, 3, __DIR__ . '/../logs/app.log');
  }
}
