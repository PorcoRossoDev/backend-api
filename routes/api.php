<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('articles', ArticleController::class);

Route::get('orders/output', [OrderController::class, 'output']);
Route::get('orders/output-success', [OrderController::class, 'output_success']);
Route::apiResource('orders', OrderController::class);