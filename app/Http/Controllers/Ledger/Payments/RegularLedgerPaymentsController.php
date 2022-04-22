<?php

namespace App\Http\Controllers\Ledger\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class RegularLedgerPaymentsController extends Controller
{
    public function __invoke()
    {
        $payments = Payment::where('account_type', Payment::ACCOUNT_TYPE_LEDGER)
            ->where('payment_type', Payment::PAYMENT_TYPE_REGULAR)
            ->filter(request(['category', 'type']))
            // ->orderBy('category_id')
            ->orderBy('created_at', 'DESC')
            ->paginate(Payment::MAX_PER_PAGE);

        $total = 0;
        foreach ($payments as $payment) {
            $total += $payment->amount;
        }
        $total = str_replace('.', ',', $total / 100);

        return view('ledger.payments.regular.index')->with(compact('payments', 'total'));
    }
}
