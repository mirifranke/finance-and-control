<?php

namespace App\Http\Controllers\Ledger\Payments;

use App\Http\Controllers\Controller;

class RegularLedgerPaymentsController extends Controller
{
    public function __invoke()
    {
        return view('ledger.payments.regular.index');
    }
}