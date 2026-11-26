<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // 批量赋值的字段，没写进 $fillable批量赋值就会自动忽略
    protected $fillable = [
        "name",
        'description',
        'is_active',
        'sort_order',
    ];

    /**
     * 获取当前分类下的所有商品
     */
    public function products(): HasMany
    {
        // 定义 Category 到 Product 的关联 1 -> n
        return $this->hasMany(Product::class);
    }
}
