<?php

namespace App\Http\Controllers\Budget\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;

class ViewEditBudgetCategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        return view('budget.categories.edit')->with(compact('category'));
    }
}
