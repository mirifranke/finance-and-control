<?php

namespace App\Http\Controllers\RegularPayments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class DeleteRegularPaymentController extends Controller
{
    public function __invoke(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('regular-payments');
    }
}
