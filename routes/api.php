<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\PriceController;
use App\Http\Controllers\Api\V1\OptionController;
use App\Http\Controllers\Api\V1\ConfigurationController;


Route::prefix('v1')->group(function () {
    Route::get('test', [CarController::class, 'test']);
    Route::get('cars/available', [CarController::class, 'available']);
    Route::apiResource('cars', CarController::class);
    Route::apiResource('options', OptionController::class);
    Route::apiResource('configurations', ConfigurationController::class);
    Route::apiResource('prices', PriceController::class);
});
