<?php

require_once __DIR__ . '/../repositories/ProductRepository.php';
require_once __DIR__ . '/../exceptions/ProductNotFoundException.php';

class ProductService
{
  public ProductRepository $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function getProducts()
  {
    return $this->productRepository->findAll();
  }

  public function createProduct(string $name, string $description,  float $price, int $stock)
  {

    /*
      service校验客户端提交的数据格式正确，业务上是否允许执行操作
      商品名称不能为空	trim($name) === ''
      商品价格必须大于 0	$price <= 0
      商品库存不能为负数	$stock < 0
      商品是否允许创建	根据业务规则判断

    */

    if (trim($name) === "") {
      throw new InvalidArgumentException("商品名称不能为空");
    }

    if ($stock < 0) {
      throw new InvalidArgumentException("商品库存不能小于0");
    }

    if ($price <= 0) {
      throw new InvalidArgumentException("商品价格必须大于0");
    }

    return $this->productRepository->create($name, $description, $price, $stock);
  }

  public function getProductById(int $id): array
  {
    if ($id <= 0) {
      throw new InvalidArgumentException("商品ID不合法");
    }

    $product = $this->productRepository->findById($id);

    if ($product === false) {
      throw new ProductNotFoundException("商品不存在");
    }

    return $product;
  }
}
