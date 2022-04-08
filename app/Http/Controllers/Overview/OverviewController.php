<?php

namespace App\Http\Controllers\Overview;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Utilities\Helper;

class OverviewController extends Controller
{
    public function __invoke($date = null)
    {
        $currentDate = Helper::getCurrentMonth($date);
        $lastMonth = Helper::getLastMonth($currentDate);
        $nextMonth = Helper::getNextMonth($currentDate);

        $regularCredit = Helper::getAmountForView(Payment::regularCreditOfMonth($currentDate));
        $regularDebit = Helper::getAmountForView(Payment::regularDebitOfMonth($currentDate));
        $oneOffCredit = Helper::getAmountForView(Payment::oneOffCreditOfMonth($currentDate));
        $oneOffDebit = Helper::getAmountForView(Payment::oneOffDebitOfMonth($currentDate));

        return view('finances.overview.index')->with(compact(
            'currentDate',
            'lastMonth',
            'nextMonth',
            'regularCredit',
            'regularDebit',
            'oneOffCredit',
            'oneOffDebit',
        ));

        // $fixCosts = FixCost::ofMonth($currentDate);
        // $petitions = Petition::ofMonthWithCosts($currentDate);

        // $totalFixCostAmount = $fixCosts->sum('amount');
        // $totalPetitionAmount = $petitions->sum('amount');

        // $credits = Earning::ofMonth($currentDate)->sum('amount');
        // $debits = $totalFixCostAmount + $totalPetitionAmount;
        // $available = $credits - $debits;

        // return view('cost-overview.index')
        //     ->with(compact(
        //         'currentDate',
        //         'lastMonth',
        //         'nextMonth',
        //         'fixCosts',
        //         'petitions',
        //         'totalFixCostAmount',
        //         'totalPetitionAmount',
        //         'debits',
        //         'credits',
        //         'available'
        //     ));
    }
}
