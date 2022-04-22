<?php

namespace App\Http\Controllers\Budget\Shops;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Shop;

class ShopsController extends Controller
{
    public function __invoke()
    {
        $shops = Shop::where('account_type', Payment::ACCOUNT_TYPE_BUDGET)->get();

        return view('budget.shops.index')->with(compact('shops'));
    }
}
