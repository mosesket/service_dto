<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StaffController::class, 'index']);
Route::get('create', [StaffController::class, 'create']);
Route::get('update/{id}', [StaffController::class, 'update']);
