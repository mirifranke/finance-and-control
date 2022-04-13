<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;

class ViewCreateRegularPaymentController extends Controller
{
    public function __invoke()
    {
        return view('finances.regular-payments.create');
    }
}
