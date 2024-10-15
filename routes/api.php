<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::resource('/users', \App\Http\Controllers\Api\UserController::class);

Route::resource('/categories', \App\Http\Controllers\Api\CategoryController::class)->middleware('auth:sanctum');

Route::resource('/products', \App\Http\Controllers\Api\ProductController::class)->middleware('auth:sanctum');

Route::get('/category/{id}/products', [\App\Http\Controllers\Api\ProductController::class, 'getCategoryProducts'])->middleware('auth:sanctum');

Route::resource('/cart', \App\Http\Controllers\Api\CartController::class)->middleware("auth:sanctum");



