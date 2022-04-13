<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateController extends Controller
{
    public function __invoke(StorePasswordRequest $request)
    {
        User::find(auth()->user()->id)
            ->update(['password' => Hash::make($request->input('newPassword'))]);

        return redirect()->route('dashboard');
    }
}
