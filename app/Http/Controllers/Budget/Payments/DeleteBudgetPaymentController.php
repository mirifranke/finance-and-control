<?php

namespace App\Http\Controllers\Budget\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class DeleteBudgetPaymentController extends Controller
{
    public function __invoke($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return back();
    }
}
