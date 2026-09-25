<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminCompanyController;


Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
Route::get('/companies', [AdminCompanyController::class, 'index']);
Route::put('/companies/{id}', [AdminCompanyController::class, 'update']);
Route::post('/companies', [AdminCompanyController::class, 'store']);
Route::put('/change/company/status/{id}', [AdminCompanyController::class, 'toggleCompanyStatus']);

});
