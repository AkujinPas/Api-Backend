<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CartItemController;
use App\Http\Controllers\API\UserPaymentMethodController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;





Route::prefix('product')->group(function () {
    Route::get('/',[ ProductController::class, 'getAll']);
    Route::post('/',[ ProductController::class, 'create']);
    Route::delete('/{id}',[ ProductController::class, 'delete']);
    Route::get('/{id}',[ ProductController::class, 'get']);
    Route::put('/{id}',[ ProductController::class, 'update']);
    Route::put('/{id}/restar-stock', [ProductController::class, 'restarStock']);

});

Route::prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('carts', CartController::class);
    Route::apiResource('cart-items', CartItemController::class);
    Route::apiResource('payment-methods', UserPaymentMethodController::class);
});

Route::post('v1/login', [AuthController::class, 'login']);


    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);  // crear orden
        Route::patch('/{id}/estado', [OrderController::class, 'updateEstado']);
        Route::patch('/{id}/verificar-pago', [OrderController::class, 'verificarPago']);
    
});

