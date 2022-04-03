<?php

namespace App\Http\Controllers\RegularPayments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class RegularPaymentsController extends Controller
{
    public function __invoke()
    {
        $payments = Payment::where('type', Payment::TYPE_REGULAR)->get();

        return view('finances.regular-payments.index')
            ->with(compact('payments'));
    }
}
