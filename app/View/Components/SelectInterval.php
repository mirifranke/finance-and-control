<?php

namespace App\View\Components;

use App\Models\Payment;
use Illuminate\View\Component;

class SelectInterval extends Component
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
        $intervals = Payment::INTERVALS;

        return view('components.select-interval')->with(compact('intervals'));
    }
}
