<?php

use App\Models\Payment;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard', function () {
        $payment = Payment::find(1);

        return view('dashboard')->with(compact('payment'));
    })->name('dashboard');

    // FINANCES
    Route::prefix('/finances')->group(__DIR__ . '/web/finances.php');

    // TASKS
    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks');
});

require __DIR__ . '/auth.php';
