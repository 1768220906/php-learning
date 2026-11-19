<?php

namespace App;

class User
{
  public function __construct(
    private string $name,
    private int $age
  ) {}

  public function introduce(): string
  {
    return "我是 {$this->name}，今年 {$this->age} 岁\n";
  }
}
