<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;

class DeleteCategoryController extends Controller
{
    public function __invoke($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back();
    }
}
