<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsUsers extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','payment_id','package_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    
    public function package(){
        return $this->belongsTo(Package::class,'package_id','package_id');
    }
}
