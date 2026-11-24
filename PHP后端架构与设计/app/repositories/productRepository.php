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

  public function create(string $name, string $description, float $price, int $stock)
  {

    $product = [
      'name' => $name,
      'description' => $description,
      'price' => $price,
      'stock' => $stock,
    ];

    $sql = 'INSERT INTO products (name, description, price, stock)
            VALUES (:name, :description, :price, :stock)
            RETURNING id, name, description, price, stock';

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($product);

    return $stmt->fetch();
  }

  public function findById(int $id): array|false
  {
    $sql = 'SELECT id, name, description, price, stock
            FROM products
            WHERE id = :id';

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch();
  }
}
