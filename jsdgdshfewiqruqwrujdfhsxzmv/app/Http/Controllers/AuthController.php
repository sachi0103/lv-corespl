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
            if ((int)$request->get('is_admin')) {
                return redirect()->route('admin.dashboard')->with('message', 'Invalid login details');
            } else {
                return redirect()->action([AccountController::class, 'create']);
            }
        } else {
            return redirect()->route('login')->with('message', 'Invalid login details');
        }
    }

    public function contact_us(Request $request) {

        if (!empty($request->all())) {
            Mail::to('support@corespl.com')->send(new ContactMail($request->all()));//support@corespl.com
        } else {
            return view('contact.index');
        }
    }
}
