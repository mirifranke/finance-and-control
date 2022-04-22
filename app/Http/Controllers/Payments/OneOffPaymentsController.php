<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class OneOffPaymentsController extends Controller
{
    public function __invoke()
    {
        $payments = Payment::where('account_type', Payment::ACCOUNT_TYPE_MAIN)
            ->where('payment_type', Payment::PAYMENT_TYPE_ONE_OFF)
            ->filter(request(['category', 'type']))
            ->orderBy('starts_at', 'desc')
            ->paginate(Payment::MAX_PER_PAGE);

        $total = 0;
        foreach ($payments as $payment) {
            $total += $payment->amount;
        }
        $total = str_replace('.', ',', $total / 100);

        return view('finances.one-off-payments.index')
            ->with(compact('payments', 'total'));
    }
}
