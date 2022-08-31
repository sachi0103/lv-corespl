<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Backend\AccountController;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $attempt = Auth::attempt([
            'email' => $request->get('email'), 
            'password' => $request->get('password'), 
            'is_admin' => $request->get('is_admin')
        ]);

        if ($attempt) {
            return redirect()->action([AccountController::class, 'create']);
        } else {
            return redirect()->route('login')->with('message', 'Invalid login details');
        }
    }
}
