<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class RegularPaymentsController extends Controller
{
    public function __invoke()
    {
        $payments = Payment::where('type', Payment::TYPE_REGULAR)
            ->filter(request(['category', 'type']))
            // ->orderBy('category_id')
            ->orderBy('created_at', 'DESC')
            ->paginate(Payment::MAX_PER_PAGE);

        $total = 0;
        foreach ($payments as $payment) {
            $total += $payment->amount;
        }
        $total = str_replace('.', ',', $total / 100);

        return view('finances.regular-payments.index')
            ->with(compact('payments', 'total'));
    }
}
