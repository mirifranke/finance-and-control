<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;

class ViewCreateOneOffPaymentController extends Controller
{
    public function __invoke()
    {
        return view('finances.one-off-payments.create');
    }
}
