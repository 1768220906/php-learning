<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    // 批量赋值的字段，没写进 $fillable批量赋值就会自动忽略
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
    ];

    /**
     * 获取当前商品所属的分类
     */
    public function category(): BelongsTo
    {
        // n -> 1
        return $this->belongsTo(Category::class);
    }
}
