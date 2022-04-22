<?php

namespace App\Http\Controllers\Budget\Payments;

use App\Http\Controllers\Controller;

class ViewCreateBudgetPaymentController extends Controller
{
    public function __invoke()
    {
        return view('budget.payments.create');
    }
}
