<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

class UpdateCategoryController extends Controller
{
    public function __invoke(StoreCategoryRequest $request, Category $category)
    {
        $category->fill([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        $category->save();

        return redirect(route('categories'))->with('success', 'Category was updated successfully.');
    }
}
