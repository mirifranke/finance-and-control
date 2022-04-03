
<?php

use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\Categories\CreateCategoryController;
use App\Http\Controllers\Categories\DeleteCategoryController;
use App\Http\Controllers\RegularPayments\DeleteRegularPaymentController;
use App\Http\Controllers\RegularPayments\RegularPaymentsController;
use Illuminate\Support\Facades\Route;


// OVERVIEW
Route::get('/', function () {
    return view('finances.overview.index');
})->name('finances');

// REGULAR PAYMENtS
Route::get('/regular-payments', RegularPaymentsController::class)->name('regular-payments');

Route::delete('regular-payments/{payment}', DeleteRegularPaymentController::class)->name('regular-payments.delete');

// ONE-OFF PAYMENTS
Route::get('/one-off-payments', function () {
    return view('finances.one-off-payments.index');
})->name('one-off-payments');

// CATEGORIES
Route::post('/categories', CreateCategoryController::class)->name('categories.create');

Route::get('/categories', CategoriesController::class)->name('categories');

Route::delete('/categories/{id}', DeleteCategoryController::class)->name('categories.destroy');
