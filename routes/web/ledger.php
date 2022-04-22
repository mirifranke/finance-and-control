<?php

use App\Http\Controllers\Ledger\Categories\CreateLedgerCategoryController;
use App\Http\Controllers\Ledger\Categories\DeleteLedgerCategoryController;
use App\Http\Controllers\Ledger\Categories\LedgerCategoriesController;
use App\Http\Controllers\Ledger\Categories\UpdateLedgerCategoryController;
use App\Http\Controllers\Ledger\Categories\ViewCreateLedgerCategoryController;
use App\Http\Controllers\Ledger\Categories\ViewEditLedgerCategoryController;
use App\Http\Controllers\Ledger\Overview\LedgerOverviewController;
use App\Http\Controllers\Ledger\Payments\CreateLedgerPaymentController;
use App\Http\Controllers\Ledger\Payments\DeleteLedgerPaymentController;
use App\Http\Controllers\Ledger\Payments\OneOffLedgerPaymentsController;
use App\Http\Controllers\Ledger\Payments\RegularLedgerPaymentsController;
use App\Http\Controllers\Ledger\Payments\UpdateLedgerPaymentController;
use App\Http\Controllers\Ledger\Payments\ViewCreateOneOffLedgerPaymentsController;
use App\Http\Controllers\Ledger\Payments\ViewCreateRegularLedgerPaymentsController;
use App\Http\Controllers\Ledger\Payments\ViewEditLedgerPaymentsController;
use Illuminate\Support\Facades\Route;

// OVERVIEW
Route::get('/overview/{date?}', LedgerOverviewController::class)
    ->name('overview');

// PAYMENTS
Route::get('/payments/regular/create', ViewCreateRegularLedgerPaymentsController::class)
    ->name('payments.regular.view-create');
Route::get('/payments/one-off/create', ViewCreateOneOffLedgerPaymentsController::class)
    ->name('payments.one-off.view-create');
Route::post('/payments', CreateLedgerPaymentController::class)
    ->name('payment.create');
Route::get('/payments/regular', RegularLedgerPaymentsController::class)
    ->name('payments.regular');
Route::get('/payments/one-off', OneOffLedgerPaymentsController::class)
    ->name('payments.one-off');
Route::get('/payments/{payment}', ViewEditLedgerPaymentsController::class)
    ->name('payment.view-edit');
Route::patch('/payments/{payment}', UpdateLedgerPaymentController::class)
    ->name('payment.update');
Route::delete('/payments/{id}', DeleteLedgerPaymentController::class)
    ->name('payment.destroy');

// CATEGORIES
Route::get('/categories/create', ViewCreateLedgerCategoryController::class)
    ->name('category.view-create');
Route::post('/categories', CreateLedgerCategoryController::class)
    ->name('category.create');
Route::get('/categories', LedgerCategoriesController::class)
    ->name('categories');
Route::get('/categories/{category}', ViewEditLedgerCategoryController::class)
    ->name('category.view-edit');
Route::patch('/categories/{category}', UpdateLedgerCategoryController::class)
    ->name('category.update');
Route::delete('/categories/{id}', DeleteLedgerCategoryController::class)
    ->name('category.destroy');
