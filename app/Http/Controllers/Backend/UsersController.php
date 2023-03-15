<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaymentsUsers;
use App\Models\CustomerPackage;
use App\Models\Payment;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;

class UsersController extends Controller
{
    //
    public function index()
    {

        $users = User::where('Parent',auth()->user()->id)->get();

        return view('backend.users.index', compact('users'));

    }

     /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
        $packages = DB::select('SELECT payments.id AS payments_id,packages.package_name,payments.package_id,payments.number_of_packages,(SELECT count(1) FROM payments_users WHERE payments_users.payment_id = payments.id AND payments_users.package_id = payments.package_id) AS usedCnt
        FROM payments 
        INNER JOIN packages ON packages.package_id = payments.package_id 
        WHERE payments.user_id = '.auth()->user()->id);

        return view('backend.users.create',compact('packages'));
    }
    
    public function store(Request $request)
    {
        $AllPostData = $request->all();
        if(isset($AllPostData['user_email']) && !empty(isset($AllPostData['user_email']))) {
            
            $package = Package::get()->toArray();  
            $country = Country::get()->toArray();

            $countryIds = (!empty($country)) ? array_column($country,'Name','ID') : [];

            foreach ($AllPostData['user_email'] as $key => $value) {

                $package_id = $AllPostData['user_package'][$key];
                $selPackage = array_values(array_filter($package,function($var) use($package_id) {
                    return ($var['package_id'] == $package_id);
                }));


                // user create 
                $verification_code = mt_rand(1000, 9999);

                $password = $this->randomPassword();

                $user = User::create([
                    'name' => $AllPostData['user_name'][$key],
                    'email' => $value,
                    'package_id' => $package_id,
                    'is_admin' => 0,
                    'Parent' => auth()->user()->id,
                    'password' => Hash::make($password),
                    'verification_code' => $verification_code,
                ]);

                // //send email for customers password
                // $this->sendMail(['name' => $AllPostData['user_name'][$key],'subject' => 'Email Verification','email' => $value,'password'=>$password],2);

                // //send email for customers verification
                // $this->sendMail(['name' => $AllPostData['user_name'][$key],'subject' => 'Email Verification','email' => $value,'code' => $verification_code],1);

                //customer package added
                $customerPackage = CustomerPackage::create([
                    'customer_id' => $user->id,
                    'package_id' => $package_id,
                    'amount' => $selPackage[0]['price'],
                    'expire_date' => ( in_array($package_id,[7,8]) ) ? date("Y-m-d",strtotime("+1 month", strtotime(now()) ) ) : null,
                    'has_paid' => 1,
                    'allowed_minutes' => $selPackage[0]['call_minutes'],
                    'remaining_minutes' => $selPackage[0]['call_minutes'],
                    'country_id' => (isset($countryIds[$selPackage[0]['call_country']])) ? $countryIds[$selPackage[0]['call_country']] : 0,
                    'number_of_selected_package' => 1,
                ]);

                $PackageUser = PackageUser::create([
                    'package_user_id' => $user->id,
                    'package_id' => $customerPackage->id,
                    'name' => $AllPostData['user_name'][$key],
                    'email' => $value,
                ]);

                $paymentDt = Payment::where('package_id',$package_id)->where('user_id',auth()->user()->id)->first();

                if ($paymentDt !== null) {
                    PaymentsUsers::create([
                        'user_id' => $user->id,
                        'payment_id' => $paymentDt->id,
                        'package_id' => $package_id,
                    ]);
                }

            }

            //login user convert to admin
            User::where('id',auth()->user()->id)->update(['is_admin'=>1]);

            return redirect()->route('admin.users.index')->with('success', 'user added successfully');
        } else {
            return redirect()->route('admin.users.create')->with('error', 'User details are not avaliable');
        }
    }

    public function sendMail($data,$type)
    {
        if($type == 1) {
            Mail::send('mail.email-varification', $data, function ($message) use ($data) {

                $message->to($data['email'], $data['name'])->subject($data['subject']);

                $message->from('vappcorespl@gmail.com', 'Email Verification');

            });
        }else if($type == 2) { 
            Mail::send('mail.customer-ontime-password', $data, function ($message) use ($data) {

                $message->to($data['email'], $data['name'])->subject($data['subject']);

                $message->from('vappcorespl@gmail.com', 'Email Verification');

            });
        }
    }

    protected function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
