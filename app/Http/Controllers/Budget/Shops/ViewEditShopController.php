<?php

namespace App\Http\Controllers\Budget\Shops;

use App\Http\Controllers\Controller;
use App\Models\Shop;

class ViewEditShopController extends Controller
{
    public function __invoke(Shop $shop)
    {
        return view('budget.shops.edit')->with(compact('shop'));
    }
}
