<?php

namespace App\Http\Controllers\Overview;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Utilities\Helper;

class OverviewController extends Controller
{
    public function __invoke($date = null)
    {
        // dates for month bar
        $currentDate = Helper::getCurrentMonth($date);
        $lastMonth = Helper::getLastMonth($currentDate);
        $nextMonth = Helper::getNextMonth($currentDate);

        // amounts in cents
        $regularCredit = Payment::regularCreditOfMonth($currentDate);
        $regularDebit = Payment::regularDebitOfMonth($currentDate);
        $oneOffCredit = Payment::oneOffCreditOfMonth($currentDate);
        $oneOffDebit = Payment::oneOffDebitOfMonth($currentDate);
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

        return view('finances.overview.index')->with(compact(
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
