<?php

header('Content-Type: application/json; charset=utf-8');

/* 
expires	Cookie 过期时间
path	Cookie 生效的路径
httponly	禁止 JavaScript 通过 document.cookie 读取
samesite	控制跨站请求时 Cookie 的发送行为
*/

// 设置 Cookie，有效期 1 小时
setcookie('username', 'Tom', [
  'expires' => time() + 3600,
  'path' => '/',
  'httponly' => true,
  'samesite' => 'Lax'
]);

// 读取 Cookie
$username = $_COOKIE['username'] ?? null;

echo json_encode([
  'username' => $username
]);
