<?php

$array = ["Apple", "Banana", "Orange"];

// 长度
$length = count($array);
echo $length . "\n";

// 尾部添加
array_push($array, "pear");
print_r($array);

// 尾部删除
array_pop($array);
print_r($array);

// 头部添加
array_unshift($array, "dog");
print_r($array);

// 头部删除
array_shift($array);
print_r($array);

// 过滤
$filter = array_filter($array, function ($value) {
  return strlen($value) > 5;
});
print_r($filter);

// 转化数组
$map = array_map(function ($item) {
  return str_replace("a", "A", $item);
}, $array);
print_r($map);

// 箭头函数
$map2 = array_map(fn($item) => str_replace("a", "z", $item), $array);
print_r($map2);
