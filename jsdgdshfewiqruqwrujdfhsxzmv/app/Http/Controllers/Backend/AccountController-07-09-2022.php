<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPackageCreateRequest;
use App\Models\Account;
use App\Models\Country;
use App\Models\CustomerPackage;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\Payment;
use App\Models\User;
use App\Services\Stripe\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    protected $subscriptionService;
    public function __construct(Subscription $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = auth()->user()->accounts;
        return view('backend.accounts.index')->with(compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        $packages = Package::get();
        return view('backend.accounts.create')->with(compact('countries', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPackageCreateRequest $request)
    {
        $package = Package::findOrFail($request->package_id);
        $this->subscriptionService->updateOrCreateCustomer();
        return $this->subscriptionService->createSubscription($package, $request);
    }


    public function success()
    {
        return redirect()->route('admin.accounts.index')->with('success', 'Congratulation you are successfully subscribed to our subscription.');
    }

    public function cancel($customerPackageId, $paymentId, $userId)
    {
        $customerPackageId =  explode(",",$customerPackageId);
        $userId =  explode(",",$userId);
        foreach($customerPackageId as $cpId){
            CustomerPackage::destroy($cpId);
        }
        foreach($userId as $user){
            PackageUser::destroy($user);
        }
        Payment::destroy($paymentId);
        return redirect()->route('admin.accounts.index')->with('danger', 'Something went wrong please try again');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show($package)
    {
        $packageUsers = PackageUser::where('package_id', $package)->get();
        return view('backend.packageUser.index')->with(compact('packageUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        dd('edi');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
