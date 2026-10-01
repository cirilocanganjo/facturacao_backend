<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Company\CompanyController;

Route::group(['prefix' => 'client', 'middleware' => ['auth:sanctum', 'company']], function () {

    Route::get('/company-details', [CompanyController::class, 'getAuthenticatedCompanyDetails']);
    Route::put('/company-details', [CompanyController::class, 'updateAuthenticatedCompanyDetails']);
});
