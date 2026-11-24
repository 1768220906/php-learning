<?php

require_once __DIR__ . '/../repositories/ProductRepository.php';

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
}
