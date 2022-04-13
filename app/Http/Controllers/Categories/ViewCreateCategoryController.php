<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;

class ViewCreateCategoryController extends Controller
{
    public function __invoke()
    {
        return view('finances.categories.create');
    }
}
