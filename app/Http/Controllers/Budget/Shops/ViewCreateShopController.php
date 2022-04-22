<?php

namespace App\Http\Controllers\Budget\Shops;

use App\Http\Controllers\Controller;

class ViewCreateShopController extends Controller
{
    public function __invoke()
    {
        return view('budget.shops.create');
    }
}
