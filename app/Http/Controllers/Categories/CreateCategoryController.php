<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

class CreateCategoryController extends Controller
{
    public function __invoke(StoreCategoryRequest $request)
    {
        Category::create([
            'creator_id' => auth()->id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('categories');
    }
}
