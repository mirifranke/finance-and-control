
<?php

use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Categories\CreateCategoryController;
use App\Http\Controllers\Categories\DeleteCategoryController;
use App\Http\Controllers\Categories\UpdateCategoryController;
use App\Http\Controllers\Categories\ViewCreateCategoryController;
use App\Http\Controllers\Payments\CreatePaymentController;
use App\Http\Controllers\Payments\DeletePaymentController;
use App\Http\Controllers\Payments\OneOffPaymentsController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Payments\RegularPaymentsController;
use App\Http\Controllers\Payments\UpdatePaymentController;
use App\Http\Controllers\Payments\ViewCreateOneOffPaymentController;
use App\Http\Controllers\Payments\ViewCreateRegularPaymentController;
use Illuminate\Support\Facades\Route;


// OVERVIEW
Route::get('/', function () {
    return view('finances.overview.index');
})->name('finances');

// PAYMENTS
Route::get('/payments/regular/create', ViewCreateRegularPaymentController::class)
    ->name('payments.regular.create');
Route::get('/payments/one-off/create', ViewCreateOneOffPaymentController::class)
    ->name('payments.one-off.create');
Route::post('/payments', CreatePaymentController::class)
    ->name('payment.create');
Route::get('/payments/regular', RegularPaymentsController::class)
    ->name('payments.regular');
Route::get('/payments/one-off', OneOffPaymentsController::class)
    ->name('payments.one-off');
Route::get('/payments/{payment}', PaymentController::class)
    ->name('payment.show');
Route::patch('/payments/{payment}', UpdatePaymentController::class)
    ->name('payment.update');
Route::delete('/payments/{id}', DeletePaymentController::class)
    ->name('payment.destroy');

// CATEGORIES
Route::get('/categories/create', ViewCreateCategoryController::class)
    ->name('category.view-create');
Route::post('/categories', CreateCategoryController::class)
    ->name('category.create');
Route::get('/categories', CategoriesController::class)
    ->name('categories');
Route::get('/categories/{category}', CategoryController::class)
    ->name('category.show');
Route::patch('/categories/{category}', UpdateCategoryController::class)
    ->name('category.update');
Route::delete('/categories/{id}', DeleteCategoryController::class)
    ->name('categories.destroy');
