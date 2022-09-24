<?php

namespace App\Http\Controllers\Budget\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;

class BudgetCategoriesController extends Controller
{
    public function __invoke()
    {
        $categories = Category::where('account_type', Payment::ACCOUNT_TYPE_BUDGET)->get();

        return view('budget.categories.index')->with(compact('categories'));
    }
}