
<?php

require __DIR__ . '/vendor/autoload.php';
// require __DIR__ . "/src/User.php";

$user = new App\User('张三', 25);

echo $user->introduce();

$product = new App\Product();
echo $product->getName();
