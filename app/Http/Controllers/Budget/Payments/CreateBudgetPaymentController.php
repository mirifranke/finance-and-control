<?php

namespace App\Http\Controllers\Budget\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Utilities\Helper;

class CreateBudgetPaymentController extends Controller
{
    public function __invoke(PaymentRequest $request)
    {
        $amountInCents = Helper::getCents($request->input('amount'), $request->input('isDebit'));

        Payment::create([
            'creator_id' => auth()->id(),
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
            'payment_type' => Payment::PAYMENT_TYPE_ONE_OFF,
            'shop_id' => $request->input('shop_id'),
            'amount' => $amountInCents,
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'interval' => Payment::INTERVAL_ONCE,
            'starts_at' => $request->input('starts_at'),
        ]);

        return redirect()
            ->route('budget.payments')
            ->with('success', 'Payment was created successfully.');
    }
}
