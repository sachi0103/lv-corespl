<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIPUser extends Model
{
    use HasFactory; 
    
    /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'sip_users';

    protected $fillable = [
        'id',
        'username',
        'password',
        'host_name',
        'Proto',
        'port',
        'DID',
        'country_code',
        'minutes',
        'expiry',
        'user_id',
    ];
}
