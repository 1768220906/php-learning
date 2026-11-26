<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// users
Route::post('/users', [UserController::class, 'store']);

// categories
Route::get('/categories', [CategoryController::class, 'index']);
