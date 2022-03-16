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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/finances', function () {
    return view('finances.index');
})->middleware(['auth'])->name('finances');

Route::get('/finances/fix-costs', function () {
    return view('finances.fix-costs.index');
})->middleware(['auth'])->name('fix-costs');

Route::get('/finances/earnings', function () {
    return view('finances.earnings.index');
})->middleware(['auth'])->name('earnings');

Route::get('/tasks', function () {
    return view('tasks.index');
})->middleware(['auth'])->name('tasks');



require __DIR__.'/auth.php';
