<?php

class ProductRepository
{
  private PDO $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function findAll(): array
  {
    $sql = '
            SELECT id, name, price, stock
            FROM products
            ORDER BY id
        ';

    $stmt = $this->pdo->query($sql);

    return $stmt->fetchAll();
  }
}
