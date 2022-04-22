<?php

namespace App\Http\Controllers\Ledger\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;

class ViewEditLedgerCategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        return view('ledger.categories.edit')->with(compact('category'));
    }
}
