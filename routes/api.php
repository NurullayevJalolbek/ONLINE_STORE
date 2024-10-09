<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
        dd("ishladi");
    //    return $request->user();
})->middleware('auth:sanctum');

Route::post('/users', [\App\Http\Controllers\Api\UserController::class, 'store'])->middleware('auth:sanctum');

Route::resource('/categories', CategoryController::class)
    ->middleware('auth:sanctum');
