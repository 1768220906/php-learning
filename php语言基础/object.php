<?php

/* 对象基础 */
// class Product
// {
//   private string $name = "xxxx";
//   private float $price = 0.00;
//   private int $stock = 0;

//   function __construct(string $initName, float $initPrice, int $initStock)
//   {
//     $this->name = $initName;
//     $this->price = $initPrice;
//     $this->stock = $initStock;
//   }

//   public function getName(): string
//   {
//     return $this->name;
//   }

//   public function getPrice(): float
//   {
//     return $this->price;
//   }

//   public function getStock(): int
//   {
//     return $this->stock;
//   }

//   public function setName(string $changeName): void
//   {
//     $this->name = $changeName;
//   }

//   public function setPrice(float $changePrice): void
//   {

//     if ($changePrice < 0) {
//       throw new InvalidArgumentException("商品价格必须大于0");
//     }

//     $this->price = $changePrice;
//   }

//   public function reduceStock(int $count): void
//   {

//     if ($count < 0) {
//       throw new InvalidArgumentException("扣减库存不能小于0");
//     }


//     if ($this->stock < $count) {
//       throw new InvalidArgumentException("扣减库存不能大于当前商品库存");
//     }

//     $this->stock = $this->stock - $count;
//   }

//   public function getInfo(): string
//   {
//     return "Product: " . $this->getName() . " | Price: " . $this->getPrice() . " | Stock: " . $this->getStock();
//   }
// }



// function main(): void
// {
//   $product = new Product("iphone", 1999.00, 999);
//   $product->setPrice(259.00);
//   $product->reduceStock(2);

//   echo $product->getInfo();
// }

// try {
//   main();
// } catch (InvalidArgumentException $e) {
//   echo "ERROR: " . $e->getMessage();
// }

// /* 接口 */
// interface Payment
// {
//   function pay(): bool;
// }

// class AliPay implements Payment
// {
//   #[Override]
//   public function pay(): bool
//   {
//     return true;
//   }
// }

// $alipay = new AliPay();
// var_dump($alipay->pay());

// /* 抽象类 */
// abstract class BasePayment
// {
//   protected $name = "aaa";

//   abstract public function pay(): bool;
// }

// class WeChatPay extends BasePayment
// {
//   public function pay(): bool
//   {
//     return false;
//   }
// }


// $weChatPay = new WeChatPay();
// var_dump($weChatPay->pay());


// /* Trait */
// trait Log
// {
//   public function log(): void
//   {
//     echo "File Logger\n";
//   }
// }


// class Product
// {
//   use Log;
// }

// $product = new Product();
// $product->log();