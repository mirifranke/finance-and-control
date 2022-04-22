<?php

namespace App\Http\Controllers\Budget\Shops;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Shop;

class UpdateShopController extends Controller
{
    public function __invoke(ShopRequest $request, Shop $shop)
    {
        $shop->fill([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        $shop->save();

        return redirect()
            ->route('budget.shops')
            ->with('success', 'Shop Was Updated Successfully.');
    }
}
