<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        return view('finances.categories.edit')->with(compact('category'));
    }
}
