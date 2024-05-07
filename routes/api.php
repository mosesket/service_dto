<?php

use App\Http\Controllers\StaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('staffs')->group(function () {
        Route::get('/', [StaffController::class, 'index']);
        Route::post('create', [StaffController::class, 'create']);
        Route::put('update', [StaffController::class, 'update']);
        Route::post('staff', [StaffController::class, 'show']);
        Route::delete('remove', [StaffController::class, 'destroy']);
    });
// });
