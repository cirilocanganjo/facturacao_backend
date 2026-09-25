<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Auth\{AuthController};
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Product\ProductController;


        //Public routes
        Route::group(['prefix' => 'client'], function () {
            Route::post('/company-create-account', [CompanyController::class, 'storeCompanyAccount']);
        });


        // Protected routes
        Route::middleware(['auth:sanctum'])->group(function () {

            Route::apiResource('companies', CompanyController::class);
            Route::apiResource('products', ProductController::class);


        });


        require __DIR__ . '/auth/routes.php';
        require __DIR__ . '/admin/routes.php';




