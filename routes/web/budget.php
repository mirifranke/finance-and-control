<?php

use App\Http\Controllers\Budget\Categories\BudgetCategoriesController;
use App\Http\Controllers\Budget\Categories\CreateBudgetCategoryController;
use App\Http\Controllers\Budget\Categories\DeleteBudgetCategoryController;
use App\Http\Controllers\Budget\Categories\UpdateBudgetCategoryController;
use App\Http\Controllers\Budget\Categories\ViewCreateBudgetCategoryController;
use App\Http\Controllers\Budget\Categories\ViewEditBudgetCategoryController;
use App\Http\Controllers\Budget\Payments\BudgetPaymentsController;
use App\Http\Controllers\Budget\Payments\CreateBudgetPaymentController;
use App\Http\Controllers\Budget\Payments\DeleteBudgetPaymentController;
use App\Http\Controllers\Budget\Payments\UpdateBudgetPaymentController;
use App\Http\Controllers\Budget\Payments\ViewCreateBudgetPaymentController;
use App\Http\Controllers\Budget\Payments\ViewUpdateBudgetPaymentController;
use App\Http\Controllers\Budget\Shops\CreateShopController;
use App\Http\Controllers\Budget\Shops\DeleteShopController;
use App\Http\Controllers\Budget\Shops\ShopsController;
use App\Http\Controllers\Budget\Shops\UpdateShopController;
use App\Http\Controllers\Budget\Shops\ViewCreateShopController;
use App\Http\Controllers\Budget\Shops\ViewEditShopController;
use Illuminate\Support\Facades\Route;

// OVERVIEW
Route::get('/overview/{date?}', function () {
    return view('budget.overview.index');
})->name('overview');

// SHOPS
Route::get('/shops/create', ViewCreateShopController::class)
    ->name('shop.view-create');
Route::post('/shops', CreateShopController::class)
    ->name('shop.create');
Route::get('/shops', ShopsController::class)
    ->name('shops');
Route::get('/shops/{shop}', ViewEditShopController::class)
    ->name('shop.view-edit');
Route::patch('/shops/{shop}', UpdateShopController::class)
    ->name('shop.update');
Route::delete('/shops/{id}', DeleteShopController::class)
    ->name('shop.destroy');

// PAYMENTS
Route::get('/payments/create', ViewCreateBudgetPaymentController::class)
    ->name('payments.view-create');
Route::post('/payments', CreateBudgetPaymentController::class)
    ->name('payment.create');
Route::get('/payments', BudgetPaymentsController::class)
    ->name('payments');
Route::get('/payments/{payment}', ViewUpdateBudgetPaymentController::class)
    ->name('payment.view-edit');
Route::patch('/payments/{payment}', UpdateBudgetPaymentController::class)
    ->name('payment.update');
Route::delete('/payments/{id}', DeleteBudgetPaymentController::class)
    ->name('payment.destroy');

// CATEGORIES
Route::get('/categories/create', ViewCreateBudgetCategoryController::class)
    ->name('category.view-create');
Route::post('/categories', CreateBudgetCategoryController::class)
    ->name('category.create');
Route::get('/categories', BudgetCategoriesController::class)
    ->name('categories');
Route::get('/categories/{category}', ViewEditBudgetCategoryController::class)
    ->name('category.view-edit');
Route::patch('/categories/{category}', UpdateBudgetCategoryController::class)
    ->name('category.update');
Route::delete('/categories/{id}', DeleteBudgetCategoryController::class)
    ->name('category.destroy');
