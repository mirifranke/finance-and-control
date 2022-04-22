<?php

namespace App\Http\Controllers\Ledger\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Support\Str;

class CreateLedgerCategoryController extends Controller
{
    public function __invoke(CategoryRequest $request)
    {
        Category::create([
            'creator_id' => auth()->id(),
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'description' => $request->input('description'),
        ]);

        return redirect()
            ->route('ledger.categories')
            ->with('success', 'New Category Was Stored!');
    }
}
