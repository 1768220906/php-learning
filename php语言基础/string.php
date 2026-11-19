<?php
$text = "this is a word";

/* 长度 */
$length = strlen($text);
echo $length . "\n";

// 大小写转换
$upper = strtoupper($text);
echo $upper . "\n";
$lower = strtolower($upper);
echo $lower . "\n";

// 去除空格
$trim = trim($text);
echo $trim . "\n";

// 替换字符
$replace = str_replace("word",  "replace", $text);
echo $replace . "\n";
