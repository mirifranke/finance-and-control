<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use App\Utilities\Helper;

class CreatePaymentController extends Controller
{
    public function __invoke(StorePaymentRequest $request)
    {
        $amountInCents = Helper::getCents($request->input('amount'), $request->input('isDebit'));

        $payment = Payment::create([
            'creator_id' => auth()->id(),
            'type' => $request->input('type'),
            'title' => $request->input('title'),
            'amount' => $amountInCents,
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'interval' => $request->input('interval'),
            'starts_at' => $request->input('starts_at'),
            'ends_at' => $request->has('is_endless') ? null : $request->input('ends_at'),
        ]);

        if ($payment->isRegular()) {
            $route = route('payments.regular');
        } else {
            $route = route('payments.one-off');
        }

        return redirect($route)->with('success', 'Payment was created successfully.');
    }
}
