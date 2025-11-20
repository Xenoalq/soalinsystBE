<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;

Route::apiResource('products', ProductController::class);

Route::post('/transactions', [TransactionController::class, 'store']);
