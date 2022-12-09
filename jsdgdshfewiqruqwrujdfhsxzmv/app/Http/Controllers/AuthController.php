<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Backend\AccountController;

use Illuminate\Support\Facades\Mail;

use App\Mail\ContactMail;
use App\Models\User;

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
            
            return redirect()->route('login')->with('message', 'Thank you for feedback');
        } else {
            return redirect()->route('login');
        }
    }

    public function profile(Request $request) {
            
        $user = User::find(auth()->user()->id);

        if (!empty($request->all())) {   
            
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->user_address = $request->user_address;
            $user->role = $request->role;
            $user->business_name = $request->business_name;
            $user->City = $request->City;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->no_of_employee = $request->no_of_employee;
            $user->purpose = $request->purpose;
            $user->company_name = $request->company_name;
            $user->company_website = $request->company_website;
            $user->office_phone = $request->office_phone;
            $user->own_phone = $request->own_phone;
            $user->no_of_phone = $request->no_of_phone;
            $user->no_phone_at_same_time = $request->no_phone_at_same_time;
            $user->new_phone = $request->new_phone;
            $user->exsisting_phone = $request->exsisting_phone;

            $user->save();
            $message =  'User details updated successfully';
            return view('backend.auth.profile')->with(compact('user','message'));
        } else {
            return view('backend.auth.profile')->with(compact('user'));
        }
    }
}
