<?php

namespace App\Http\Controllers\Budget\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;

class DeleteBudgetCategoryController extends Controller
{
    public function __invoke($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back();
    }
}
