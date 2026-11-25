<?php

return [
  'host' => getenv('DB_HOST') ?: '127.0.0.1',
  'port' => getenv('DB_PORT') ?: '5433',
  'dbname' => getenv('DB_NAME') ?: 'php_learning',
  'username' => getenv('DB_USERNAME') ?: 'php_learning_user',
  'password' => getenv('DB_PASSWORD'),
];
