<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\Component;

class Test extends Component
{
    public Payment $payment;

    protected $rules = [
        'payment.title' => 'required', //whatever rules you want
    ];

    public function render()
    {
        return view('livewire.test');
    }
}
