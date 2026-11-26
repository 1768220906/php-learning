<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Log;

// users
Route::post('/users', [UserController::class, 'store']);

// categories
Route::get('/categories', [CategoryController::class, 'index']);

// produces
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'create']);

// log
Route::get('/log-test', function () {
  // Log::info('这是一条 Laravel 测试日志');

  // Log::info('商品创建成功', [
  //   'product_id' => 1,
  //   'product_name' => '机械键盘',
  //   'price' => 299,
  // ]);

  Log::debug('商品创建调试信息');

  Log::info('商品创建成功', [
    'product_id' => 1,
    'product_name' => '机械键盘',
  ]);

  Log::warning('商品库存不足', [
    'product_id' => 1,
    'stock' => 2,
  ]);

  Log::error('商品创建失败', [
    'product_id' => 1,
    'reason' => '数据库写入失败',
  ]);

  return response()->json([
    'code' => 200,
    'message' => '日志写入成功',
    'data' => null,
  ]);
});
