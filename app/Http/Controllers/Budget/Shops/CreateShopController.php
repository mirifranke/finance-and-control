<?php

namespace App\Http\Controllers\Budget\Shops;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Payment;
use App\Models\Shop;
use Illuminate\Support\Str;

class CreateShopController extends Controller
{
    public function __invoke(ShopRequest $request)
    {
        Shop::create([
            'creator_id' => auth()->id(),
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'description' => $request->input('description'),
        ]);

        return redirect()
            ->route('budget.shops')
            ->with('success', 'New Shop Was Stored!');
    }
}
