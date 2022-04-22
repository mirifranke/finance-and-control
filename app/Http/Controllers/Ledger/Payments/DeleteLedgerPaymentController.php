<?php

namespace App\Http\Controllers\Ledger\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class DeleteLedgerPaymentController extends Controller
{
    public function __invoke($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return back();
    }
}
