<?php

namespace App\Http\Controllers\Ledger\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class OneOffLedgerPaymentsController extends Controller
{
    public function __invoke()
    {
        $payments = Payment::where('account_type', Payment::ACCOUNT_TYPE_LEDGER)
            ->where('payment_type', Payment::PAYMENT_TYPE_ONE_OFF)
            ->filter(request(['category', 'type']))
            ->orderBy('starts_at', 'desc')
            ->paginate(Payment::MAX_PER_PAGE);

        $total = 0;
        foreach ($payments as $payment) {
            $total += $payment->amount;
        }
        $total = str_replace('.', ',', $total / 100);

        return view('ledger.payments.one-off.index')
            ->with(compact('payments', 'total'));
    }
}
