<?php

// echo "hello php"

/* 基础数据结构 */
// $name = "John Doe";
// $age = 30;
// $is_student = true;
// $height = 5.9;

// echo "Name: " . $name . "\n";
// echo "Age: " . $age . "\n";
// if ($is_student) {
//     echo "Status: Student \n";
// } else {
//     echo "Status: Not a Student \n";
// }
// echo "Height: " . $height . " feet\n";

// var_dump($name);
// var_dump($age);
// var_dump($is_student);
// var_dump($height);

/* 数组 对象 */
// $products = [
//   [
//     "name" => "Product 1",
//     "price" => 10.99,
//     "count" => 5
//   ],
//   [
//     "name" => "Product 2",
//     "price" => 19.99,
//     "count" => 3
//   ]
// ];

// foreach ($products as $product) {
//   if ($product['count'] > 3) {
//     echo "Product Name: " . $product['name'] . "\n";
//     echo "Product Price: $" . $product['price'] . "\n";
//     echo "Product Count: " . $product['count'] . "\n";
//   }
// };

// $products = [
//   [
//     "name" => "Product 1",
//     "price" => 10.99,
//     "count" => 5
//   ],
//   [
//     "name" => "Product 2",
//     "price" => 19.99,
//     "count" => 0
//   ],
//   [
//     "name" => "Product 3",
//     "price" => 29.99,
//     "count" => 20
//   ],
//   [
//     "name" => "Product 4",
//     "price" => 9.99,
//     "count" => 2
//   ]
// ];

// for ($i = 0; $i < count($products); $i++) {
//   $product = $products[$i];
//   if ($product["count"] === 0) {
//     continue;
//   }

//   if ($product["price"] > 20) {
//     continue;
//   }
//   echo "Product Name: " . $product['name'] . "\n";
//   echo "Product Price: " . $product['price'] . "\n";
//   echo "Product Count: " . $product['count'] . "\n";
// }

/* 函数 */
// function calculateTotalPrice(float $price, int $count): float
// {
//   return $price * $count;
// }

// $totalPrice = calculateTotalPrice(19.99, 3);
// echo "Total Price:" . $totalPrice;

/* 数据转换 */
// $name = "jack"; 不是数字字符串无法把它转换成数字来进行加法运算
// $age = 50;
// TypeError: Unsupported operand types: string + int

// $name = "100";
// $age = 50;
// $add = $name + $age;
// // int(150)

// $name = "100";
// $age = "50";
// $add = $name + $age;
// // int(150)

// $name = "ten";
// $age = "two";
// $add = $name + $age;
// TypeError: Unsupported operand types: string + string

$name = "20.5";
$age = "10";
$add = $name + $age;
// float(30.5)

var_dump($add);
