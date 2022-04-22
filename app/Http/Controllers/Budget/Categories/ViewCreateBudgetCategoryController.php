<?php

namespace App\Http\Controllers\Budget\Categories;

use App\Http\Controllers\Controller;

class ViewCreateBudgetCategoryController extends Controller
{
    public function __invoke()
    {
        return view('budget.categories.create');
    }
}
