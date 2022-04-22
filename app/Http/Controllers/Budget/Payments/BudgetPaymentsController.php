<?php

namespace App\Http\Controllers\Budget\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class BudgetPaymentsController extends Controller
{
    public function __invoke(Request $request)
    {
        $payments = Payment::where('account_type', Payment::ACCOUNT_TYPE_BUDGET)
            ->filter(request(['category', 'type']))
            ->orderBy('starts_at', 'desc')
            ->paginate(Payment::MAX_PER_PAGE);

        $total = 0;
        foreach ($payments as $payment) {
            $total += $payment->amount;
        }
        $total = str_replace('.', ',', $total / 100);

        return view('budget.payments.index')
            ->with(compact('payments', 'total'));
    }
}
