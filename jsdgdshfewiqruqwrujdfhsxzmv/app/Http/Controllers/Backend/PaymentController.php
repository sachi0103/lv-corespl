<?php



namespace App\Http\Controllers\Backend;



use App\Http\Controllers\Controller;

use App\Models\Payment;

use Illuminate\Http\Request;



class PaymentController extends Controller

{

    public function index()

    {
        $user = auth()->user();
        
        $payments = Payment::with(['payment_users','payment_users.user','payment_users.package'])->where('user_id',$user->id)->get();

       // dd($payments);

        return view('backend.payments.index')->with(compact(['payments']));

    }

}

