<?php

namespace App\Http\Controllers\Budget\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Utilities\Helper;

class UpdateBudgetPaymentController extends Controller
{
    public function __invoke(PaymentRequest $request, Payment $payment)
    {
        $amountInCents = Helper::getCents($request->input('amount'), $request->input('isDebit'));

        $payment->fill([
            'shop_id' => $request->input('shop_id'),
            'amount' => $amountInCents,
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'starts_at' => $request->input('starts_at'),
        ]);
        $payment->save();

        return redirect()
            ->route('budget.payments')
            ->with('success', 'Payment was created successfully.');
    }
}
