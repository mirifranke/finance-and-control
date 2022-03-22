<?php

use Illuminate\Support\Facades\Log;
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

    Route::get('/finances', function () {
        return view('finances.overview.index');
    })->name('finances');

    Route::get('/finances/regular-payments', function () {
        return view('finances.regular-payments.index');
    })->name('regular-payments');

    Route::get('/finances/one-off-payments', function () {
        return view('finances.one-off-payments.index');
    })->name('one-off-payments');

    Route::get('/finances/categories', function () {
        return view('finances.categories.index');
    })->name('categories');

    Route::post('/finances/categories', function () {
        Log::info(request()->all());

        return view('finances.categories.index');
    })->name('categories');

    Route::get('/finances/categories', function () {
        return view('finances.categories.index');
    })->name('categories');

    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks');
});

require __DIR__ . '/auth.php';
