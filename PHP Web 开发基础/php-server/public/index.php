<?php

/* 
参数	作用
php	调用 PHP CLI
-S	启动内置 Web Server
-t  指定网站根目录
localhost	监听本机地址
8000	监听端口
*/

echo 'Hello PHP Web!';

echo '<br>';

echo 'Current Time: ' . date('H:i:s');

echo '<br>';

echo '当前执行的文件：' . __FILE__;
