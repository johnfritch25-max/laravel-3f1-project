<?php

use App\Http\Controllers\HumanResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/payroll', [HumanResourceController::class, 'pay']);
Route::post('/payroll/calculate', [HumanResourceController::class, 'calculate']);
Route::post('/calculator', [HumanResourceController::class, 'employment']);



