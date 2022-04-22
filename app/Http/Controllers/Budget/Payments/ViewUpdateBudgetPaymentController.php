<?php

namespace App\Http\Controllers\Budget\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class ViewUpdateBudgetPaymentController extends Controller
{
    public function __invoke(Payment $payment)
    {
        return view('budget.payments.edit')->with(compact('payment'));
    }
}
