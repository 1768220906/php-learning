<?php

// 告诉浏览器返回的数据是“二进制流 / 未知通用字节流”。
header('Content-Type: application/octet-stream');
// attachment 告诉浏览器“请弹出下载框保存为文件”
header('Content-Disposition: attachment; filename="爱心.png"');

readfile(__DIR__ . '/uploads/爱心.png');
