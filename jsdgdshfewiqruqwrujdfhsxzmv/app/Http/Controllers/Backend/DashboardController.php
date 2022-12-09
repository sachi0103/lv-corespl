<?php



namespace App\Http\Controllers\Backend;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\CallLog;

use App\Models\Payment;

use App\Models\User;
use DB;use 
App\Models\Settings;


class DashboardController extends Controller

{

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index()
    {

        $userIds = User::where('Parent',auth()->user()->id)->get()->toArray();
        
        $paymentCounts = Payment::count();

        $userCounts =  User::where('id',auth()->user()->id)->orWhere('Parent',auth()->user()->id)->count();

        $callLogsCount = CallLog::count();

        $str = 'SELECT * FROM (
            SELECT customer_packages.id AS customer_packages_id,packages.package_name,customer_packages.package_id,customer_packages.customer_id,customer_packages.amount,customer_packages.purchase_date,customer_packages.allowed_minutes,customer_packages.remaining_minutes,users.name,users.email,
            (CASE WHEN customer_packages.package_id = 7 OR customer_packages.package_id = 8 THEN DATE_SUB(customer_packages.purchase_date , INTERVAL -1 MONTH) ELSE "'.date("Y-m-d", time() + 86400).'" END) AS expiryDate
            FROM customer_packages 
            INNER JOIN packages ON packages.package_id = customer_packages.package_id 
            INNER JOIN users ON users.id = customer_packages.customer_id 
            WHERE customer_packages.id IN ( 
                SELECT MAX(id) FROM customer_packages WHERE customer_packages.customer_id IN ("'.implode('","',array_column($userIds,'id')).'") GROUP BY customer_id ) 
            UNION 
            SELECT customer_packages.id AS customer_packages_id,packages.package_name,customer_packages.package_id,customer_packages.customer_id,customer_packages.amount,customer_packages.purchase_date,customer_packages.allowed_minutes,customer_packages.remaining_minutes,users.name,users.email, (CASE WHEN customer_packages.package_id = 7 OR customer_packages.package_id = 8 THEN DATE_SUB(customer_packages.purchase_date , INTERVAL -1 MONTH) ELSE "'.date("Y-m-d", time() + 86400).'" END) AS expiryDate
            FROM customer_packages 
            INNER JOIN packages ON packages.package_id = customer_packages.package_id 
            INNER JOIN users ON users.id = customer_packages.customer_id 
            WHERE customer_packages.id IN ( 
                SELECT MAX(id) FROM customer_packages WHERE customer_packages.customer_id = '.auth()->user()->id.' GROUP BY customer_id ) 
        ) AS ou WHERE expiryDate <= "'.date('Y-m-d').'" ORDER BY customer_packages_id DESC';
        
        $accounts = DB::select($str);

        $setting = Settings::where('key','ChangePlan')->first();

        $changePlanLimit = ($setting->value) ? $setting->value : 0 ;

        return view('backend.dashboard.index', compact('paymentCounts', 'userCounts', 'callLogsCount','changePlanLimit','accounts'));

    }


    public function welcome(Request $request)
    {
       if(isset($request->id)) {
            $user = User::find($request->id);
            if($user){
                return view('backend.auth.adminlogin')->with('user',$user);
            } else {
                return redirect()->route('login');
            }
       } else {
            return redirect()->route('login');
       }
    }
}

