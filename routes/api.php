<?php

use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\RoutingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('throttle:10,1')->group(function () {
    Route::apiResource('locations', LocationController::class);
    Route::get('route/{location}', [RoutingController::class, 'index'])->name('route');

});
