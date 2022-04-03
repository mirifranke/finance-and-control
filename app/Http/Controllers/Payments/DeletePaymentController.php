<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class DeletePaymentController extends Controller
{
    public function __invoke($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return back();
    }
}
