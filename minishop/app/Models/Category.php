<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 批量赋值的字段，没写进 $fillable批量赋值就会自动忽略
    protected $fillable = [
        "name",
        'description',
        'is_active',
        'sort_order',
    ];
}
