<?php

/* 转义 */
$comment = "<script>alert('XSS')</script>";

echo "未转义：";
echo $comment;

echo "<hr>";

echo "转义后：";
echo htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');

/* 密码哈希 */

// 注册：生成密码哈希
$hash = password_hash('123456', PASSWORD_DEFAULT);

// 登录：验证用户输入的密码
$isValid = password_verify('123456', $hash);

echo $isValid;
