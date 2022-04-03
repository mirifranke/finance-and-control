
<?php

use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\Categories\CreateCategoryController;
use App\Http\Controllers\Categories\DeleteCategoryController;
use App\Http\Controllers\Payments\DeletePaymentController;
use App\Http\Controllers\Payments\OneOffPaymentsController;
use App\Http\Controllers\Payments\RegularPaymentsController;
use Illuminate\Support\Facades\Route;


// OVERVIEW
Route::get('/', function () {
    return view('finances.overview.index');
})->name('finances');

// PAYMENTS
Route::get('/payments/regular', RegularPaymentsController::class)->name('payments.regular');
Route::get('/payments/one-off', OneOffPaymentsController::class)->name('payments.one-off');

Route::delete('/payments/{id}', DeletePaymentController::class)->name('payments.destroy');


// CATEGORIES
Route::post('/categories', CreateCategoryController::class)->name('categories.create');

Route::get('/categories', CategoriesController::class)->name('categories');

Route::delete('/categories/{id}', DeleteCategoryController::class)->name('categories.destroy');
