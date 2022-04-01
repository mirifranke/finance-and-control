<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\Component;

class CreateRegularPayment extends Component
{
    public $title;
    public $amount = 0;
    public $category_id;
    public $description;
    public $interval = Payment::INTERVAL_MONTHLY;
    public $starts_at = now();
    public $ends_at = null;

    public function render()
    {
        return view('livewire.create-regular-payment');
    }
}
