<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Api\CarController;

// Car API routes secured with Sanctum
Route::middleware('auth:sanctum')->apiResource('cars', CarController::class);
