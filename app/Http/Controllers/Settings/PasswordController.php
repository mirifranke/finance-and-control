<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    public function __invoke()
    {
        return view('settings.password');
    }
}
