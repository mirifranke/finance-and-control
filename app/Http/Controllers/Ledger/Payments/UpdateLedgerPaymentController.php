<?php

namespace App\Http\Controllers\Ledger\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Utilities\Helper;

class UpdateLedgerPaymentController extends Controller
{
    public function __invoke(PaymentRequest $request, Payment $payment)
    {
        $amountInCents = Helper::getCents($request->input('amount'), $request->input('isDebit'));

        $payment->fill([
            'title' => $request->input('title'),
            'amount' => $amountInCents,
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'interval' => $request->input('interval'),
            'starts_at' => $request->input('starts_at'),
            'ends_at' => $request->has('is_endless') ? null : $request->input('ends_at'),
        ]);
        $payment->save();

        if ($payment->isRegular()) {
            $route = route('ledger.payments.regular');
        } else {
            $route = route('ledger.payments.one-off');
        }

        return redirect($route)->with('success', 'Payment was created successfully.');
    }
}
