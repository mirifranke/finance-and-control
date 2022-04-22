<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;

class CategoriesController extends Controller
{
    public function __invoke()
    {
        $categories = Category::where('account_type', Payment::ACCOUNT_TYPE_MAIN)->get();

        return view('finances.categories.index')->with(compact('categories'));
    }
}
