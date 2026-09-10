<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\{AuthController};
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Product\ProductController;

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/logout-all', [AuthController::class, 'logoutAll']);

      
        Route::apiResource('companies', CompanyController::class);  
        Route::apiResource('products', ProductController::class);
});
});




