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

    public function index()
    {
        $userIds = User::where('id',auth()->user()->id)->orWhere('Parent',auth()->user()->id)->get()->toArray();

        $accounts = DB::table('customer_packages')->select('customer_packages.id AS customer_packages_id','customer_packages.customer_id','customer_packages.amount','customer_packages.purchase_date','customer_packages.allowed_minutes','customer_packages.remaining_minutes','users.name','users.email')->join('users', 'users.id', '=', 'customer_packages.customer_id')->whereIn('customer_packages.customer_id',array_column($userIds,'id'))->get();

     //   dd($accounts);
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

        return $this->subscriptionService->createSubscription($package, $request);
    }

    public function ajaxUniqueEmail(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        return response()->json(['status'=>($user) ? true : false]);
    }



    public function success($MuserId)
    {
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
        Mail::to('support@corespl.com')->send(new AccountManageUser($TempEmailArr));

        //change the is_admin = 1
        $clientId = auth()->user()->id;
        $user = User::find($clientId);
        $user->is_admin = 1;
        $user->update();

        return redirect()->route('admin.accounts.index')->with('success', 'Congratulation you are successfully subscribed to our subscription.');

    }



    public function cancel($customerPackageId, $paymentId, $userId,$MuserId)

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

