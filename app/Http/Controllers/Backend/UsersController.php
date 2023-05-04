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
use App\Models\SIPUser;
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

                //send email for customers verification
                $this->sendMail(['name' => $AllPostData['user_name'][$key],'subject' => 'Email Verification','email' => $value,'code' => $verification_code,'user_id'=>$user->id],1);

                if(!empty($package_id)) {
                    if((int)$package_id !== -1)  {
                        
                        $selPackage = array_values(array_filter($package,function($var) use($package_id) {
                            return ($var['package_id'] == $package_id);
                        }));

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
                    } else {

                        //create SIP users
                        $sipUser = SIPUser::create([
                            'username' => $AllPostData['username'][$key],
                            'password' => $AllPostData['password'][$key],
                            'host_name' => $AllPostData['Host'][$key],
                            'Proto' => $AllPostData['protocol'.$key],
                            'port' => $AllPostData['Port'][$key],
                            'user_id' => $user->id,
                            'country_code' => '+1',
                        ]);
                        
                    }

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

                $message->from('no_reply@corespl.com',$data['subject']);

            });
        }else if($type == 2) { 
            Mail::send('mail.customer-ontime-password', $data, function ($message) use ($data) {

                $message->to($data['email'], $data['name'])->subject($data['subject']);

                $message->from('no_reply@corespl.com',$data['subject']);

            });
        }
    }

    public function verifyUser($id,$code)
    {
        $user = User::whereRaw('md5(id) = "'.$id.'"')->where('verification_code',$code)->first();
        $msg = '';
        if($user)
        {
            if($user->email_verified_at) {
                
                $msg = 'Your email already verified!';

            } else {

                $password = $this->randomPassword();
                $user->password = Hash::make($password);
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->update();
                
                //send email for customers password
                $this->sendMail(['name' => $user->name,'subject' => 'Email One time Password','email' => $user->email,'password'=>$password],2);

                $msg = 'User email verification successfully';
            }
        }

        return redirect()->route('login')->with('message',$msg);
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

    public function destory($id) {
        
        User::whereRaw('md5(id) = "'.$id.'"')->delete();

        return redirect()->route('admin.users.index')->with('success', 'user removed successfully');

    }

    public function edit($id) {
        
        $user = User::whereRaw('md5(id) = "'.$id.'"')->first();

        return view('backend.users.update',compact('user'));

    }

    public function update(Request $request) {
        $user = User::whereRaw('md5(id) = "'.$request->id.'"')->first();

        if(!empty($user)) {

            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->user_address = $request->user_address;
            $user->save();

            return redirect()->route('admin.users.index')->with('success', 'user details updated successfully');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'user details not found');
        }
    }

    /**
     * assign package one user to another users 
    */
    public function reassignPackage(Request $request) {
        //get user details 
        $user = User::where('id',$request->user_id)->first();

        if(!empty($user)) {

            //get package details 
            $package = Package::where('package_id',$user->package_id)->first();

            if (!empty($package)) {

                $user->package_id = 0;
                $user->save();

                $newUser = User::where('id',$request->new_user_id)->first();
                if (!empty($newUser)) {
                    $newUser->package_id = $package->package_id;
                    $newUser->save();
                }

                //customer package 
                $custPackage = CustomerPackage::where('customer_id',$user->id)->where('package_id',$package->package_id)->first();

                if (!empty($custPackage)) {
                    CustomerPackage::where('id',$custPackage->id)->update(['customer_id'=>$request->new_user_id]);
                    

                    $packUser = PackageUser::where('package_user_id',$request->user_id)->where('package_id',$custPackage->id)->first();
                    if (!empty($packUser)) {
                        PackageUser::where('id',$packUser->id)->update([
                            'package_user_id' => $newUser->id,
                            'package_id' => $custPackage->id,
                            'name' => $newUser->name,
                            'email' => $newUser->email,
                        ]);
                    }

                    $paymentUser = PaymentsUsers::where('user_id',$user->id)->where('package_id',$package->package_id)->first();
                    if (!empty($paymentUser)) {
                        PaymentsUsers::where('id',$paymentUser->id)->update(['user_id'=>$request->new_user_id]);
                    }
                }
                
                return redirect()->route('admin.users.index')->with('success', 'user reassign package successfully');
            } else {
                return redirect()->route('admin.users.index')->with('error', 'user details not found');
            }
        } else {
            return redirect()->route('admin.users.index')->with('error', 'user details not found');
        }
    }
}
