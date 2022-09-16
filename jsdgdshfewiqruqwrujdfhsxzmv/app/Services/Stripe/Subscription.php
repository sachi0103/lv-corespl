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

                    //'number_of_selected_package' => $request->number_of_selected_package,

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

                $payment = Payment::create([

                    'user_id' => $user->id,
    
                    'package_id' => $selPackage[0]['package_id'],
    
                    'country_id' => $request->country_id,
    
                    'number_of_packages' => 1,
    
                    'number_of_users' => 1,
    
                    'charge_per_user' => 5,
    
                    'charge_per_package' => $selPackage[0]['price'],
    
                    'subtotal' => ($selPackage[0]['price'] + 5),
    
                    'total' => ($selPackage[0]['price'] + 5),
    
                    'taxes' => 0,
    
                    'delivery' => 0,
    
                    //'use_the_payment_method_on_file' => $request->concent ? 1 : 0,
    
                    //'description' => $request->description,
    
                ]);

                array_push($paymentId, $payment->id);
            }

            if(count($request->package_id) > 0)
            {
                foreach ($request->package_id as $value) {
                    if(!in_array($value,$usedPackageId)) {
                        $package_id = $value;
                        $selPackage = array_values(array_filter($package, function($var) use($package_id) {
                            return ($var['package_id'] == $package_id);
                        }));
                        $payment = Payment::create([

                            'user_id' => $clientId,
            
                            'package_id' => $selPackage[0]['package_id'],
            
                            'country_id' => $request->country_id,
            
                            'number_of_packages' => 1,
            
                            'number_of_users' => 1,
            
                            'charge_per_user' => 5,
            
                            'charge_per_package' => $selPackage[0]['price'],
            
                            'subtotal' => ($selPackage[0]['price'] + 5),
            
                            'total' => ($selPackage[0]['price'] + 5),
            
                            'taxes' => 0,
            
                            'delivery' => 0,
            
                            'use_the_payment_method_on_file' => $request->concent ? 1 : 0,
            
                            //'description' => $request->description,
            
                        ]);
        
                        array_push($paymentId, $payment->id);
                    }
                }
            }

            $packageList = Package::whereIn('package_id', $request->package_id)->get()->toArray();
            $package_name = implode(',', array_column($packageList,'package_name'));

            DB::commit();

            $customerPackageId = implode(',', $customerPackageId);

            $userId = implode(',', $userId);

            $paymentId = implode(',', $paymentId);

            return auth()->user()->checkoutCharge($total*100, $package_name,

            1,

             ['success_url' => route('admin.accounts.transaction.success', [$clientId,$customerPackageId]),

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

