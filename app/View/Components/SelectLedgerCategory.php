<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Payment;
use Illuminate\View\Component;

class SelectLedgerCategory extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = Category::where('account_type', Payment::ACCOUNT_TYPE_LEDGER)->get();

        return view('components.select-ledger-category')->with(compact('categories'));
    }
}
