<?php

namespace App\Http\Controllers\Ledger\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class ViewEditLedgerPaymentsController extends Controller
{
    public function __invoke(Payment $payment)
    {
        if ($payment->isRegular()) {
            $view = 'ledger.payments.regular.edit';
        } else {
            $view = 'ledger.payments.one-off.edit';
        }

        return view($view)->with(compact('payment'));
    }
}
