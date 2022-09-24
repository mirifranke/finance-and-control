<?php

namespace App\Http\Controllers\Ledger\Payments;

use App\Http\Controllers\Controller;

class OneOffLedgerPaymentsController extends Controller
{
    public function __invoke()
    {
        return view('ledger.payments.one-off.index');
    }
}