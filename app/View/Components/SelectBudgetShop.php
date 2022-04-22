<?php

namespace App\View\Components;

use App\Models\Payment;
use App\Models\Shop;
use Illuminate\View\Component;

class SelectBudgetShop extends Component
{
    public function render()
    {
        $shops = Shop::where('account_type', Payment::ACCOUNT_TYPE_BUDGET)->get();

        return view('components.select-budget-shop')->with(compact('shops'));
    }
}
