<?php

namespace App\Http\Controllers\Ledger\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;

class DeleteLedgerCategoryController extends Controller
{
    public function __invoke($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back();
    }
}
