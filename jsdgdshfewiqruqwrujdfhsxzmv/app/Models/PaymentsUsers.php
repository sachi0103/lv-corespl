<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsUsers extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','payment_id'];

    public function user(){

        return $this->belongsTo(User::class);
 
     }
}
