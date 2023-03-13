<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $primaryKey = 'package_id';

    public function payments(){
        return $this->hasMany(Payment::class);
     }
    public function users(){
        return $this->hasMany(Payment::class, 'package_id', 'package_id');
     }
}

