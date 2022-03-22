
<?php

use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\Categories\CreateCategoryController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


// OVERVIEW
Route::get('/', function () {
    return view('finances.overview.index');
})->name('finances');

// REGULAR PAYMENtS
Route::get('/regular-payments', function () {
    return view('finances.regular-payments.index');
})->name('regular-payments');

// ONE-OFF PAYMENTS
Route::get('/one-off-payments', function () {
    return view('finances.one-off-payments.index');
})->name('one-off-payments');

// CATEGORIES
Route::post('/categories', CreateCategoryController::class)->name('category.create');

Route::get('/categories', CategoriesController::class)->name('categories');
