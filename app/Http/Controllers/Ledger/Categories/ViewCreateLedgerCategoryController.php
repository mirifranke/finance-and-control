<?php

namespace App\Http\Controllers\Ledger\Categories;

use App\Http\Controllers\Controller;

class ViewCreateLedgerCategoryController extends Controller
{
    public function __invoke()
    {
        return view('ledger.categories.create');
    }
}
