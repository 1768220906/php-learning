<?php

header('Content-Type: application/json; charset=utf-8');

/* 
session_start()	   启动或恢复当前 Session
$_SESSION	         读写服务器端 Session 数据
session_id()	     获取当前 Session ID
*/

// 启动 Session
session_start();

// 写入 Session
$_SESSION['username'] = 'Tom';
$_SESSION['role'] = 'admin';

// 返回 Session 数据
echo json_encode([
  'sessionId' => session_id(),
  'session' => $_SESSION
]);
