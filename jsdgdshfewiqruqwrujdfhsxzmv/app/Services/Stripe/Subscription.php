<?php



namespace App\Services\Stripe;



use App\Models\Client\Subscription as ModelsSubscription;

use App\Models\CustomerPackage;

use App\Models\Package;

use App\Models\PackageUser;

use App\Models\User;

use App\Models\Payment;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Laravel\Cashier\Cashier;

use Throwable;

use Illuminate\Support\Facades\Hash;



class Subscription

{



    function checkCustomer()

    {

        $stripeId = auth()->user()->stripe_id;

        return Cashier::findBillable($stripeId);

    }



    function updateOrCreateCustomer()

    {

        $checkCustomer = $this->checkCustomer();

        if ($checkCustomer) {

            return auth()->user()->updateStripeCustomer();

        } else {

            return auth()->user()->createAsStripeCustomer();

        }

    }

    //renew plan 
    function renewSubscription($custPackageDetails,$packageDetails)
    {
        DB::beginTransaction();
        try{

            $remaining_minutes = ($custPackageDetails->remaining_minutes > 0) ? ( $custPackageDetails->remaining_minutes + $packageDetails->call_minutes ) : $packageDetails->call_minutes;

            CustomerPackage::where('id',$custPackageDetails->id)->update(['remaining_minutes'=>$remaining_minutes,'updated_at'=>date('Y-m-d H:i:s'),'purchase_date'=>date('Y-m-d')]);

            $payment = Payment::create([

                'user_id' => auth()->user()->id,

                'package_id' => $packageDetails->package_id,

                'country_id' => (!empty($custPackageDetails->country_id)) ? $custPackageDetails->country_id : 0,

                'number_of_packages' => 1,

                'number_of_users' => 1,

                'charge_per_user' => 0,

                'charge_per_package' => $packageDetails->price,

                'subtotal' => $packageDetails->price,

                'total' => $packageDetails->price,

                'taxes' => 0,

                'delivery' => 0,

                'use_the_payment_method_on_file' => 0,

                //'description' => $request->description,

            ]);

            $total = $packageDetails->price;

            $package_name = $packageDetails->package_name;

            DB::commit();

            $customerPackageId = $custPackageDetails->id;

            $userId = $custPackageDetails->customer_id;

            $paymentId = $payment->id;

            return auth()->user()->checkoutCharge($total*100, $package_name,

            1,

             ['success_url' => route('admin.accounts.transaction.success'),

             'cancel_url' => route('admin.accounts.transaction.cancel', [$customerPackageId, $paymentId, $userId])

            ]);

        }catch(Throwable $exception){

            DB::rollBack();

            return $exception->getMessage();

        }
    }

    //created by ruchi and 16/09/2022
    function createSubscription($package, $request)
    {
        DB::beginTransaction();
        try{

            $clientId = auth()->user()->id;
            $total = $request['PackageAmt'] + (5 * $request->number_of_selected_user);
            $customerPackageId = [];
            $paymentId = [];
            $userId = [];
            $MuserId = [];
            $usedPackageId = [];

            for($i = 0; $i < $request->number_of_selected_user; $i++){
                //get selected user package value 
                $package_id = $request->user_package[$i];
                $selPackage = array_values(array_filter($package,function($var) use($package_id) {
                    return ($var['package_id'] == $package_id);
                }));

                array_push($usedPackageId,$package_id);

                //child user create 
                $user = User::create([
                    'name' => $request->user_name[$i],
                    'email' => $request->user_email[$i],
                    'package_id' => $selPackage[0]['package_id'],
                    'is_admin' => 0,
                    'Parent' => $clientId,
                    'password' => Hash::make($request->user_name[$i]),
                ]);
                array_push($MuserId,$user->id);

                //user package user created 
                $customerPackage = CustomerPackage::create([

                    'customer_id' => $user->id,

                    'package_id' => $selPackage[0]['package_id'],

                    'amount' => $selPackage[0]['price'],

                    'purchase_date' => now(),

                    'has_paid' => 1,

                    'allowed_minutes' => $selPackage[0]['call_minutes'],

                    'remaining_minutes' => $selPackage[0]['call_minutes'],

                    'country_id' => $request->country_id,

                    'number_of_selected_package' => 1,

                    //'description' => $request->description,

                ]);

                array_push($customerPackageId, $customerPackage->id);

                $PackageUser = PackageUser::create([

                    'package_user_id' => $user->id,

                    'package_id' => $customerPackage->id,

                    'name' => $request->user_name[$i],

                    'email' => $request->user_email[$i],

                    //'will_share' => $request->user_share[$i],

                ]);

                array_push($userId, $PackageUser->id);
            }

            if(count($request->package_id) > 0)
            {
                foreach ($request->package_id as $key => $value) {
                    if (!empty($request->package_qty[$key])) {
                        $package_id = $value;
                        $selPackage = array_values(array_filter($package, function($var) use($package_id) {
                            return ($var['package_id'] == $package_id);
                        }));
                        $usercost = ($request->package_qty[$key] > 1 && in_array($package_id,[7,8]) ) ? $request->UserCost : 0;
                        $number_of_user = count(array_values(array_filter($request->user_package,function($var) use($package_id){
                            return ($var == $package_id);
                        })))
                        ;

                        $payment = Payment::create([

                            'user_id' => $clientId,
            
                            'package_id' => $selPackage[0]['package_id'],
            
                            'country_id' => $request->country_id,
            
                            'number_of_packages' => $request->package_qty[$key],
            
                            'number_of_users' => $number_of_user,
            
                            'charge_per_user' => $usercost,
            
                            'charge_per_package' => $selPackage[0]['price'],
            
                            'subtotal' => ( ($selPackage[0]['price'] * $request->package_qty[$key] ) + $usercost),
            
                            'total' => ( ($selPackage[0]['price'] * $request->package_qty[$key] ) + $usercost),
            
                            'taxes' => 0,
            
                            'delivery' => 0,
            
                            'use_the_payment_method_on_file' => $request->concent ? 1 : 0,
            
                            //'description' => $request->description,
            
                        ]);
        
                        array_push($paymentId, $payment->id);
                    }
                }
            }

            $packageList = Package::whereIn('package_id', $usedPackageId)->get()->toArray();
            $package_name = implode(',', array_column($packageList,'package_name'));

            DB::commit();

            $customerPackageId = implode(',', $customerPackageId);

            $userId = implode(',', $userId);

            $MuserId = implode(',', $MuserId);

            $paymentId = implode(',', $paymentId);

            return auth()->user()->checkoutCharge($total*100, $package_name,

            1,

             ['success_url' => route('admin.accounts.transaction.success', [$MuserId]),

             'cancel_url' => route('admin.accounts.transaction.cancel', [$customerPackageId, $paymentId, $userId,$MuserId])

            ]);
        }catch(Throwable $exception){

            DB::rollBack();

            return $exception->getMessage();

        }

    }

     //created by ruchi and 24/11/2022
    function createExtraSubscription($package, $request)
    {
        DB::beginTransaction();
        try{

            $clientId = auth()->user()->id;
            $total = $request['PackageAmt'];
            $customerPackageId = [];
            $paymentId = [];
            $userId = [$request['customer_id']];
            $usedPackageId = [];

            //get user details 
            $userDt = User::find($request['customer_id']);
            
            foreach ($request->package_id as $key => $value) {

                if (!empty($request->package_qty[$key])) {

                    $package_id = $value;
                    $selPackage = array_values(array_filter($package,function($var) use($package_id) {
                        return ($var['package_id'] == $package_id);
                    }));

                    //get old package mintues 
                    $custPackage = CustomerPackage::where('customer_id',$request['customer_id'])->latest('id')->first();
                    $reminMintues = ($custPackage->remaining_minutes > 0 ) ? $custPackage->remaining_minutes : 0;
                    
                    array_push($usedPackageId,$package_id);

                    $customerPackage = CustomerPackage::create([

                        'customer_id' => $request['customer_id'],
                
                        'package_id' => $selPackage[0]['package_id'],
                
                        'amount' => ( $selPackage[0]['price'] * $request->package_qty[$key] ),
                
                        'purchase_date' => now(),
                
                        'has_paid' => 1,
                
                        'allowed_minutes' => ( $selPackage[0]['call_minutes'] * $request->package_qty[$key] ),
                
                        'remaining_minutes' => $reminMintues + ( $selPackage[0]['call_minutes'] * $request->package_qty[$key] ),
                
                        'country_id' => ($custPackage->country_id) ? $custPackage->country_id : 0,
                
                        'number_of_selected_package' => $request->package_qty[$key],
                
                        //'description' => $request->description,
                
                    ]);

                    $user = User::find($request['customer_id']);
                    $user->package_id = $selPackage[0]['package_id'];
                    $user->update();

                    array_push($customerPackageId, $customerPackage->id);

                    $PackageUser = PackageUser::create([

                        'package_user_id' => $request['customer_id'],
                
                        'package_id' => $customerPackage->id,
                
                        'name' => $userDt->name,
                
                        'email' => $userDt->email,
                
                    ]);
                
                    array_push($userId, $PackageUser->id);

                    $payment = Payment::create([

                        'user_id' => $clientId,
        
                        'package_id' => $selPackage[0]['package_id'],
        
                        'country_id' => ($custPackage->country_id) ? $custPackage->country_id : 0,
        
                        'number_of_packages' => $request->package_qty[$key],
        
                        'number_of_users' => 1,
        
                        'charge_per_user' => 0,
        
                        'charge_per_package' => $selPackage[0]['price'],
        
                        'subtotal' => ($selPackage[0]['price'] * $request->package_qty[$key]),
        
                        'total' => ($selPackage[0]['price'] * $request->package_qty[$key]),
        
                        'taxes' => 0,
        
                        'delivery' => 0,
        
                        'use_the_payment_method_on_file' => $request->concent ? 1 : 0,
        
                        //'description' => $request->description,
        
                    ]);
        
                    array_push($paymentId, $payment->id);
                }
            }

            DB::commit();

            $customerPackageId = implode(',', $customerPackageId);

            $userId = implode(',', $userId);

            $paymentId = implode(',', $paymentId);

            $packageList = Package::whereIn('package_id', $usedPackageId)->get()->toArray();
            $package_name = implode(',', array_column($packageList,'package_name'));

            return auth()->user()->checkoutCharge($total*100, $package_name,

            1,

             ['success_url' => route('admin.accounts.transaction.success'),

             'cancel_url' => route('admin.accounts.transaction.cancel', [$customerPackageId, $paymentId, $userId])

            ]);
        }catch(Throwable $exception){

            DB::rollBack();

            return $exception->getMessage();

        }

    }

    function invoices()

    {

        $invoices = auth()->user()->invoices();

    }



    function latestInvoice()

    {

        $this->invoices->latest()->first();

        $invoices = auth()->user()->invoices();

    }

}

