<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Payment extends Model

{

    use HasFactory;



    protected $guarded = [];



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

