<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Backend\DashboardController;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        //dd($request);
        $attempt = Auth::attempt([
            'email' => $request->get('email'), 
            'password' => $request->get('password'), 
            'is_admin' => 1
        ]);

        if ($attempt) {
            return redirect()->action([DashboardController::class, 'index']);
        } else {
            return redirect()->route('login')->with('message', 'Invalid login details');
        }
    }
}
