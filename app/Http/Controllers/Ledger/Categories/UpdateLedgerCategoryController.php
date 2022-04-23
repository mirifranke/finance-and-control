<?php

namespace App\Http\Controllers\Ledger\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class UpdateLedgerCategoryController extends Controller
{
    public function __invoke(CategoryRequest $request, Category $category)
    {
        $category->fill([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        $category->save();

        return redirect()
            ->route('ledger.categories')
            ->with('success', 'Category was updated successfully.');
    }
}
