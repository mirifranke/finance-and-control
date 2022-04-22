<?php

namespace App\Http\Controllers\Budget\Shops;

use App\Http\Controllers\Controller;
use App\Models\Shop;

class DeleteShopController extends Controller
{
    public function __invoke($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return back();
    }
}
