<?php

namespace App\Http\Controllers\Ledger\Payments;

use App\Http\Controllers\Controller;

class ViewCreateOneOffLedgerPaymentsController extends Controller
{
    public function __invoke()
    {
        return view('ledger.payments.one-off.create');
    }
}
