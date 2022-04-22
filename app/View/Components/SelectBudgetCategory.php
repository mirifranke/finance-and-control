<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Payment;
use Illuminate\View\Component;

class SelectBudgetCategory extends Component
{
    public function render()
    {
        $categories = Category::where('account_type', Payment::ACCOUNT_TYPE_BUDGET)->get();

        return view('components.select-budget-category')->with(compact('categories'));
    }
}
