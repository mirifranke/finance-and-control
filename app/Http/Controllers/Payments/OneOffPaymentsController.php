<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class OneOffPaymentsController extends Controller
{
    public function __invoke()
    {
        $payments = Payment::where('type', Payment::TYPE_ONE_OFF)
            ->filter(request(['category', 'type']))
            ->orderBy('starts_at', 'desc')
            ->paginate(15);

        $total = 0;
        foreach ($payments as $payment) {
            $total += $payment->amount;
        }
        $total = str_replace('.', ',', $total / 100);

        return view('finances.one-off-payments.index')
            ->with(compact('payments', 'total'));
    }
}
