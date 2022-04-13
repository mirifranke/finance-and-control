<?php

use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\PasswordUpdateController;
use Illuminate\Support\Facades\Route;

// CHANGE PASSWORD
Route::get('/password', PasswordController::class)
    ->name('password');

Route::post('/password', PasswordUpdateController::class)
    ->name('password.update');
