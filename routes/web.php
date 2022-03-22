<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // FINANCES
    Route::prefix('/finances')->group(__DIR__ . '/web/finances.php');

    // TASKS
    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks');
});

require __DIR__ . '/auth.php';
