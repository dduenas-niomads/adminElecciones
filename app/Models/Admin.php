<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name','email','password','status','role_id'
    ];

    protected $hidden = [
        'password'
    ];
}
