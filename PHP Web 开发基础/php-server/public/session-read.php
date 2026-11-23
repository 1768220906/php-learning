<?php

/* 
与session.php搭配使用，用于理解跨请求读取session

*/

header('Content-Type: application/json; charset=utf-8');

// 恢复当前 Session
session_start();

// 读取 Session
echo json_encode([
  'sessionId' => session_id(),
  'username' => $_SESSION['username'] ?? null,
  'role' => $_SESSION['role'] ?? null
]);
