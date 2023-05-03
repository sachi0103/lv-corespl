<?php



namespace App\Models;



use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Cashier\Billable;

//use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable

{
    //HasRoles
    use HasFactory, Notifiable, Billable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name',

        'email',

        'password',

        'phone',

        'designation',

        'created_by',

        'modified_by',

        'is_active',

        'is_owner',

        'is_admin',

        'Parent',
        
        'package_id',

        'verification_code',
    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];



    /**

     * The attributes that should be cast to native types.

     *

     * @var array

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

    //return which user create given user

    public function createdBy()

    {

        return $this->belongsTo(User::class, 'created_by');

    }



    public function Accounts()
    {
        return $this->hasMany(CustomerPackage::class, 'customer_id');

    }

    public function Package()

    {

        return $this->hasOne(Package::class,'package_id','package_id');

    }

    public function companies()
    {
        return $this->belongsTo(Companies::class,'id','user_id');

    }

}

