<?php

namespace App\Http\Controllers\Ledger\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;

class LedgerCategoriesController extends Controller
{
    public function __invoke()
    {
        $categories = Category::where('account_type', Payment::ACCOUNT_TYPE_LEDGER)->get();

        return view('ledger.categories.index')->with(compact('categories'));
    }
}
