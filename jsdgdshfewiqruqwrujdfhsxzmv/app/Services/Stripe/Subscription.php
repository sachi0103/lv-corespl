<?php

namespace App\Services\Stripe;

use App\Models\Client\Subscription as ModelsSubscription;
use App\Models\CustomerPackage;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use Throwable;

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

    function createSubscription($package, $request)
    {


        DB::beginTransaction();
        try{
            $clientId = auth()->user()->id;
            $total = ($request->number_of_selected_package*$package->price) + ($request->number_of_selected_user * 5) ;
            $customerPackageId = [];
            $paymentId = null;
            $userId = [];



            for($i = 0; $i < $request->number_of_selected_package; $i++){
                $customerPackage = CustomerPackage::create([
                    'customer_id' => $clientId,
                    'package_id' => $request->package_id,
                    'amount' => $package->price,
                    'purchase_date' => now(),
                    'has_paid' => 1,
                    'allowed_minutes' => $package->call_minutes,
                    'remaining_minutes' => $package->call_minutes,
                    'country_id' => $request->country_id,
                    'number_of_selected_package' => $request->number_of_selected_package,
                    'description' => $request->description,
                ]);
                if($i == 0 && $request->user_id){
                    if( count($request->user_id) == count($request->user_name) && count($request->user_name) == count($request->user_email)&& count($request->user_email) == count($request->user_share) ){
                        for($j=0; $j<count($request->user_id); $j++){
                            $user = PackageUser::create([
                                'package_user_id' => $request->user_id[$j],
                                'package_id' => $customerPackage->id,
                                'name' => $request->user_name[$j],
                                'email' => $request->user_email[$j],
                                'will_share' => $request->user_share[$j],
                            ]);
                            array_push($userId, $user->id);
                        }
                    }else{
                    throw \Illuminate\Validation\ValidationException::withMessages(['user' => 'Some thing went wrong with user data please try again']);
                    }
                }
                array_push($customerPackageId, $customerPackage->id);
            }
           $customerPackageId = implode(',', $customerPackageId);
           $userId = implode(',', $userId);
            $payment = Payment::create([
                'user_id' => $clientId,
                'package_id' => $request->package_id,
                'country_id' => $request->country_id,
                'number_of_packages' => $request->number_of_selected_package,
                'number_of_users' => $request->number_of_selected_user,
                'charge_per_user' => 5,
                'charge_per_package' => $package->price,
                'subtotal' => $total,
                'total' => $total,
                'taxes' => 0,
                'delivery' => 0,
                'use_the_payment_method_on_file' => $request->concent ? 1 : 0,
                'description' => $request->description,
            ]);
            $paymentId = $payment->id;
            $package = Package::where('package_id', $request->package_id)->first();
            DB::commit();
            return auth()->user()->checkoutCharge($total*100, $package->package_name,
            1,
             ['success_url' => route('admin.accounts.transaction.success', [$clientId, $customerPackage->id]),
             'cancel_url' => route('admin.accounts.transaction.cancel', [$customerPackageId, $paymentId, $userId])
            ]);

            // return auth()->user()->newSubscription('default', $package->stripe_package_id_without_url)->quantity(5)->checkout([
            //     'payment_method_types' => ['card'],
            //     'success_url' => route('admin.accounts.transaction.success', [$clientId, $customerPackage->id]),
            //     'cancel_url' => route('admin.accounts.transaction.cancel'),
            // ]);

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
