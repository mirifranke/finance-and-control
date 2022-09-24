<?php

namespace App\Http\Controllers\Budget\Payments;

use App\Http\Controllers\Controller;

class BudgetPaymentsController extends Controller
{
    public function __invoke()
    {
        return view('budget.payments.index');
    }
}