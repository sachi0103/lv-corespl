<?php



namespace App\Http\Controllers\Backend;



use App\Http\Controllers\Controller;

use App\Http\Requests\UserPackageCreateRequest;

use App\Models\Account;

use App\Models\Country;

use App\Models\CustomerPackage;

use App\Models\Package;

use App\Models\Settings;

use App\Models\PackageUser;

use App\Models\Payment;

use App\Models\PaymentsUsers;

use App\Models\User;

use App\Services\Stripe\Subscription;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

use App\Mail\Backend\AccountManageUser;
use Response;


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

    public function index(Request $request)
    {
        $userIds = User::where('Parent',auth()->user()->id)->get()->toArray();

        $str = 'SELECT * FROM (
            SELECT customer_packages.id AS customer_packages_id,packages.package_name,customer_packages.package_id,customer_packages.customer_id,customer_packages.amount,customer_packages.expire_date,customer_packages.allowed_minutes,customer_packages.remaining_minutes,users.name,users.email,customer_packages.created_at
            FROM customer_packages 
            INNER JOIN packages ON packages.package_id = customer_packages.package_id 
            INNER JOIN users ON users.id = customer_packages.customer_id 
            WHERE customer_packages.id IN ( 
                SELECT MAX(id) FROM customer_packages WHERE customer_packages.customer_id IN ("'.implode('","',array_column($userIds,'id')).'") GROUP BY customer_id ) 
            UNION 
            SELECT customer_packages.id AS customer_packages_id,packages.package_name,customer_packages.package_id,customer_packages.customer_id,customer_packages.amount,customer_packages.expire_date,customer_packages.allowed_minutes,customer_packages.remaining_minutes,users.name,users.email,customer_packages.created_at
            FROM customer_packages 
            INNER JOIN packages ON packages.package_id = customer_packages.package_id 
            INNER JOIN users ON users.id = customer_packages.customer_id 
            WHERE customer_packages.id IN ( 
                SELECT MAX(id) FROM customer_packages WHERE customer_packages.customer_id = '.auth()->user()->id.' GROUP BY customer_id ) 
        ) AS ou ORDER BY customer_packages_id DESC';
        
        $accounts = DB::select($str);

        $setting = Settings::where('key','ChangePlan')->first();

        $changePlanLimit = ($setting->value) ? $setting->value : 0 ;
        
        return view('backend.accounts.index')->with(compact('changePlanLimit','accounts'));
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

        return view('backend.accounts.create')->with(compact('countries', 'packages'));

    }

    public function add_minutes($cust_id)
    {
        $customer_id = base64_decode($cust_id);

        $countries = Country::get();

        $packages = Package::get();

        return view('backend.accounts.add_minutes')->with(compact('countries', 'packages','customer_id'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(UserPackageCreateRequest $request)
    {      
        $package = Package::get()->toArray();   
        $countries = array_column((Country::get()->toArray()) , 'Name','ID') ;
        $countriesCost = array_column((Country::get()->toArray()) , 'user_cost','ID') ;
        $packagesNmArr = array_column($package , 'package_name','package_id');
        $packagesPriceArr = array_column($package , 'price','package_id');

        $user = auth()->user();

        $selPackageArr = [];
        foreach ($request->package_id as $key => $value) {
            if(isset($request->package_qty[$key]) && !empty(($request->package_qty[$key]))) {
                $selPackageArr[] = [
                    'package_id' => $value,
                    'package' => $packagesNmArr[$value],
                    'package_qty' => $request->package_qty[$key],
                    'Price' => $packagesPriceArr[$value],
                    'amount' => $packagesPriceArr[$value] * $request->package_qty[$key]
               ];
            }
         }
        $request['PackageAmt'] = array_sum(array_column($selPackageArr,'amount'));
        $request['UserCost'] = $countriesCost[$request->country_id];

        $this->subscriptionService->updateOrCreateCustomer();

        return $this->subscriptionService->createSubscription($package, $request);
    }

    public function save_extra_minutes(Request $request)
    {
        $package = Package::get()->toArray();   
        $countries = array_column((Country::get()->toArray()) , 'Name','ID') ;
        $packagesNmArr = array_column($package , 'package_name','package_id');
        $packagesPriceArr = array_column($package , 'price','package_id');

        $user = auth()->user();

        $selPackageArr = [];
        foreach ($request->package_id as $key => $value) {
            if(isset($request->package_qty[$key]) && !empty(($request->package_qty[$key]))) {
                $selPackageArr[] = [
                    'package_id' => $value,
                    'package' => $packagesNmArr[$value],
                    'package_qty' => $request->package_qty[$key],
                    'Price' => $packagesPriceArr[$value],
                    'amount' => $packagesPriceArr[$value] * $request->package_qty[$key]
               ];
            }
        }

        $request['PackageAmt'] = array_sum(array_column($selPackageArr,'amount'));

        $this->subscriptionService->updateOrCreateCustomer();

        return $this->subscriptionService->createExtraSubscription($package, $request);
    }

    public function renew_plan($cust_package_id)
    {
        $cust_package_id = base64_decode($cust_package_id);

        $cust_package_details = CustomerPackage::find($cust_package_id);

        if(!empty($cust_package_details))
        {
            $packageDetails = Package::find($cust_package_details->package_id);

            $this->subscriptionService->updateOrCreateCustomer();

            return $this->subscriptionService->renewSubscription($cust_package_details,$packageDetails);
        }

    }

    public function all_user_plan_renew($clientId)
    {
        $clientId = base64_decode($clientId);

        if(!empty($clientId))
        {
            //get all login user 
            $userIds = User::where('id',$clientId)->orWhere('Parent',$clientId)->get()->toArray();

            $accounts = DB::select('SELECT customer_packages.id AS customer_packages_id,packages.package_name,customer_packages.package_id,customer_packages.customer_id,customer_packages.amount,customer_packages.expire_date,customer_packages.allowed_minutes,customer_packages.remaining_minutes,users.name,users.email,customer_packages.country_id FROM customer_packages INNER JOIN packages ON packages.package_id = customer_packages.package_id INNER JOIN users ON users.id = customer_packages.customer_id WHERE customer_packages.id IN ( SELECT MAX(id) FROM customer_packages WHERE customer_packages.customer_id IN ("'.implode('","',array_column($userIds,'id')).'") GROUP BY customer_id ) ORDER BY customer_packages.id DESC');

            if (!empty($accounts)) {

                $this->subscriptionService->updateOrCreateCustomer();

                return $this->subscriptionService->renewAllSubscription($clientId,$accounts);
            }
        }

    }

    public function ajaxUniqueEmail(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        return response()->json(['status'=>($user) ? true : false]);
    }



    public function success($MuserId="")
    {
        if (!empty($MuserId)) {

            $MuserId =  explode(",",$MuserId);
            $userList = User::with(['Accounts','Package'])->whereIn('id',$MuserId)->get()->toArray();

            $user = auth()->user();
            $TempEmailArr = [
                'country' => $userList[0]['accounts'][0]['country_id'],
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'number_of_selected_user' => count($userList),
                'user_cost' => 5 * count($userList),
            ];

            $selUserArr = [];
            $selPackageArr = [];
            foreach ($userList as $key => $value) {
                $selUserArr[] = [
                    'user_name' => $value['name'],
                    'user_email' => $value['email'],
                    'user_package' => $value['package']['package_name'],
                ];

                $selPackageArr[] = [
                    'package_id' => $value['package']['package_id'],
                    'package' => $value['package']['package_name'],
                    'package_qty' => $value['package']['package_name'],
                    'Price' => $value['package']['price'],
                    'amount' => $value['accounts'][0]['amount']
                ];
            }

            

            $TempEmailArr['userDetail'] = $selUserArr;
            $TempEmailArr['PackageDetail'] = $selPackageArr;
            Mail::to('support@corespl.com')->send(new AccountManageUser($TempEmailArr));//support@corespl.com

            //change the is_admin = 1
            $clientId = auth()->user()->id;
            $user = User::find($clientId);
            $user->is_admin = 1;
            $user->update();
        }

        return redirect()->route('admin.accounts.index')->with('success', 'Congratulation you are successfully subscribed to our subscription.');

    }



    public function cancel($customerPackageId, $paymentId, $userId,$MuserId="")
    {

        $customerPackageId =  explode(",",$customerPackageId);

        $userId =  explode(",",$userId);

        $MuserId =  explode(",",$MuserId);

        $paymentId =  explode(",",$paymentId);

        foreach($customerPackageId as $cpId){

            CustomerPackage::destroy($cpId);

        }

        foreach($userId as $user){

            PackageUser::destroy($user);

        }

        foreach($MuserId as $user){

            User::destroy($user);
        }

        foreach($paymentId as $payment){

            Payment::destroy($payment);
            PaymentsUsers::where('payment_id',$payment)->delete();
        }        

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

