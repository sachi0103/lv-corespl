<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Payment extends Model

{

    use HasFactory;



    protected $guarded = [];
    protected $appends = ['no_of_users'];

    public function getNoOfUsersAttribute(){

        return PaymentsUsers::where('payment_id',$this->id)->count();
    }

    public function country(){

        $this->belongsTo(Country::class);

    }



    public function package(){

       return $this->belongsTo(Package::class,'package_id','package_id');

    }

    public function payment_users(){

        return $this->hasMany(PaymentsUsers::class,'payment_id','id');

    }

}

