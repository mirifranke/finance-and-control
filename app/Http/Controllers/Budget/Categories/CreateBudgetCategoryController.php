<?php

namespace App\Http\Controllers\Budget\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Support\Str;

class CreateBudgetCategoryController extends Controller
{
    public function __invoke(CategoryRequest $request)
    {
        Category::create([
            'creator_id' => auth()->id(),
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'description' => $request->input('description'),
        ]);

        return redirect()
            ->route('budget.categories')
            ->with('success', 'New Category Was Stored!');
    }
}
