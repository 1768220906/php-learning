<?php

header('Content-Type: application/json; charset=utf-8');

session_start();

session_destroy();

echo json_encode([
  'message' => 'Session 已销毁'
]);
