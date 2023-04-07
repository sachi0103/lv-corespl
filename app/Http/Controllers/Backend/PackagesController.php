<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPackageCreateRequest;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Country;
use App\Models\Package;
use App\Services\Stripe\Subscription;
use DB;

class PackagesController extends Controller
{
    protected $subscriptionService;

    public function __construct(Subscription $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    //
    public function index()
    {
        $packages = DB::select('SELECT * FROM (
            SELECT payments.package_id,payments.number_of_packages,payments.charge_per_package,payments.charge_per_user,payments.total,packages.package_name,payments.created_at,(SELECT count(1) AS totalCnt FROM payments_users WHERE payment_id = payments.id AND package_id = payments.package_id GROUP BY payment_id) AS use_packaged,(SELECT sum(remaining_minutes) FROM payments_users INNER JOIN customer_packages ON customer_packages.customer_id = payments_users.user_id WHERE payment_id = payments.id AND customer_packages.package_id = payments.package_id GROUP BY payment_id) AS remaining_minutes
            FROM payments 
            INNER JOIN packages ON packages.package_id = payments.package_id
            WHERE payments.user_id = '.auth()->user()->id.') AS ou WHERE remaining_minutes > 0');

        return view('backend.package.index', compact('packages'));
    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    { 
        $countries = Country::orderByRaw("CASE WHEN id = 2 THEN 0 ELSE 1 END ASC")->get();

        $packages = Package::get();

        return view('backend.package.create',compact('countries', 'packages'));
    }

    public function store(Request $request)
    {
        $package = Package::get()->toArray();  

        $user = auth()->user();

        return $this->subscriptionService->purchasePackage($package, $request->all());
    }


    public function success()
    {
        return redirect()->route('admin.packages.index')->with('success', 'Congratulation you are successfully subscribed to our subscription.');
    }

    public function cancel($paymentId)
    {
        foreach($paymentId as $payment){

            Payment::destroy($payment);
        }  
        
        return redirect()->route('admin.packages.index')->with('danger', 'Something went wrong please try again');
    }
}
