<?php

use App\Models\Payment;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // FINANCES
    Route::prefix('/finances')->group(__DIR__ . '/web/finances.php');
});

require __DIR__ . '/auth.php';
