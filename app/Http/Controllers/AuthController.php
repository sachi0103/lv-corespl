<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Backend\AccountController;

use Illuminate\Support\Facades\Mail;

use App\Mail\ContactMail;
use App\Models\User;
use App\Models\Companies;

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
            $validator = Validator::make($request->all(), [
                'g-recaptcha-response' => 'required|recaptcha'
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('welcome.php',md5($request->id))->with('error',$validator->errors()->first());
            } else {
                Mail::to('support@corespl.com')->send(new ContactMail($request->all()));//support@corespl.com
                
                return redirect()->route('welcome.php',md5($request->id))->with('success', 'Thank you for submitting your application. Our technical advisor will contact you within the next 24 to 48 hours.');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function profile(Request $request) {
            
        $user = User::with('companies')->find(auth()->user()->id);

        if (!empty($request->all())) {   
            
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->user_address = $request->user_address;

            $companies = Companies::where('user_id',$user->id)->first();
            if (!empty($companies)) {
                
                $companies->user_id = $user->id;
                $companies->role = $request->role;
                $companies->business_name = $request->business_name;
                $companies->City = $request->City;
                $companies->state = $request->state;
                $companies->country = $request->country;
                $companies->no_of_employee = $request->no_of_employee;
                $companies->purpose = $request->purpose;
                $companies->company_name = $request->company_name;
                $companies->company_website = $request->company_website;
                $companies->office_phone = $request->office_phone;
                $companies->own_phone = $request->own_phone;
                $companies->no_of_phone = $request->no_of_phone;
                $companies->emp_same_time = $request->emp_same_time;
                $companies->new_phone = $request->new_phone;
                $companies->new_area_code = $request->new_area_code;
                $companies->new_phone_last = $request->new_phone_last;
                $companies->exsisting_phone = $request->exsisting_phone;
                $companies->save();

            } else {

                $companies = new Companies();
                $companies->user_id = $user->id;
                $companies->role = $request->role;
                $companies->business_name = $request->business_name;
                $companies->City = $request->City;
                $companies->state = $request->state;
                $companies->country = $request->country;
                $companies->no_of_employee = $request->no_of_employee;
                $companies->purpose = $request->purpose;
                $companies->company_name = $request->company_name;
                $companies->company_website = $request->company_website;
                $companies->office_phone = $request->office_phone;
                $companies->own_phone = $request->own_phone;
                $companies->no_of_phone = $request->no_of_phone;
                $companies->emp_same_time = $request->emp_same_time;
                $companies->new_phone = $request->new_phone;
                $companies->new_area_code = $request->new_area_code;
                $companies->new_phone_last = $request->new_phone_last;
                $companies->exsisting_phone = $request->exsisting_phone;
                $companies->save();
            }

            $user->save();

            $user = User::with('companies')->find(auth()->user()->id);

            $message =  'User details updated successfully';
            return view('backend.auth.profile')->with(compact('user'))->with('success',$message);
        } else {
            return view('backend.auth.profile')->with(compact('user'));
        }
    }
}
