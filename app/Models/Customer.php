<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'first_name','last_name','email','password','status','is_verified','customer_group_id' 
    ];

    protected $hidden = [
        'password', 'api_token'
    ];
}
