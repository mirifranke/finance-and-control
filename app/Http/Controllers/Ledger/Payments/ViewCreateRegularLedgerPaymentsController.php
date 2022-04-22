<?php

namespace App\Http\Controllers\Ledger\Payments;

use App\Http\Controllers\Controller;

class ViewCreateRegularLedgerPaymentsController extends Controller
{
    public function __invoke()
    {
        return view('ledger.payments.regular.create');
    }
}
