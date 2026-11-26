<?php

namespace App\Services;

use InvalidArgumentException;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data): array
    {

        if ($data["age"] < 18) {
            throw new InvalidArgumentException("用户年龄必须满 18 岁");
        }

        return [
            'name' => $data['name'],
            'age' => $data['age'],
        ];
    }
}
