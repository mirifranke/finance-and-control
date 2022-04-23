<?php

namespace App\Http\Controllers\Ledger\Overview;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Utilities\Helper;

class LedgerOverviewController extends Controller
{
    public function __invoke($date = null)
    {
        // dates for month bar
        $currentDate = Helper::getCurrentMonth($date);
        $lastMonth = Helper::getLastMonth($currentDate);
        $nextMonth = Helper::getNextMonth($currentDate);

        // amounts in cents
        $regularCredit = PaymentService::regularCreditOfMonth($currentDate);
        $regularDebit = PaymentService::regularDebitOfMonth($currentDate);
        $oneOffCredit = PaymentService::oneOffCreditOfMonth($currentDate);
        $oneOffDebit = PaymentService::oneOffDebitOfMonth($currentDate);
        $totalRegular = $regularCredit + $regularDebit;
        $totalOneOff = $oneOffCredit + $oneOffDebit;

        // amounts in strings
        $total = Helper::getAmountForView($totalRegular + $totalOneOff);
        $totalRegular = Helper::getAmountForView($totalRegular);
        $totalOneOff = Helper::getAmountForView($totalOneOff);
        $regularCredit = Helper::getAmountForView($regularCredit);
        $regularDebit = Helper::getAmountForView($regularDebit);
        $oneOffCredit = Helper::getAmountForView($oneOffCredit);
        $oneOffDebit = Helper::getAmountForView($oneOffDebit);

        return view('ledger.overview.index')->with(compact(
            'currentDate',
            'lastMonth',
            'nextMonth',
            'total',
            'totalRegular',
            'totalOneOff',
            'regularCredit',
            'regularDebit',
            'oneOffCredit',
            'oneOffDebit',
        ));
    }
}
