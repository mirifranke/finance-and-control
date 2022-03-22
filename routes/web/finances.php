
<?php

use App\Http\Controllers\Categories\CategoriesController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('finances.overview.index');
})->name('finances');

Route::get('/regular-payments', function () {
    return view('finances.regular-payments.index');
})->name('regular-payments');

Route::get('/one-off-payments', function () {
    return view('finances.one-off-payments.index');
})->name('one-off-payments');

Route::get('/categories', CategoriesController::class)->name('categories');

Route::post('/categories', function () {
    Log::info(request()->all());

    return view('finances.categories.index');
})->name('categories');

Route::get('/finances/categories', function () {
    return view('finances.categories.index');
})->name('categories');
