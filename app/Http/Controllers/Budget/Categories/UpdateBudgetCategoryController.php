<?php

namespace App\Http\Controllers\Budget\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class UpdateBudgetCategoryController extends Controller
{
    public function __invoke(CategoryRequest $request, Category $category)
    {
        $category->fill([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        $category->save();

        return redirect()
            ->route('budget.categories')
            ->with('success', 'Category was updated successfully.');
    }
}
