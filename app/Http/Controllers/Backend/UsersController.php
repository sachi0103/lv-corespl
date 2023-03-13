<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
        $packages = DB::select('SELECT payments.id AS payments_id,packages.package_name,payments.package_id
        FROM payments 
        INNER JOIN packages ON packages.package_id = payments.package_id 
        WHERE payments.id NOT IN (
            SELECT payments_users.payment_id 
            FROM payments_users 
            INNER JOIN payments ON payments.id = payments_users.payment_id 
            WHERE payments.package_id NOT IN(7,8) AND payments.user_id = '.auth()->user()->id.'
        ) AND payments.user_id = '.auth()->user()->id);

        return view('backend.users.create',compact('packages'));
    }
 
}
