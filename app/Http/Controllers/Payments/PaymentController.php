<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __invoke(Payment $payment)
    {
        if ($payment->isRegular()) {
            $view = 'finances.regular-payments.edit';
        } else {
            $view = 'finances.one-off-payments.edit';
        }

        return view($view)->with(compact('payment'));
    }
}
