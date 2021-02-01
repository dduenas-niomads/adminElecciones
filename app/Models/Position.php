<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name' 
    ];

    public function nominee()
    {
        return $this->hasMany('App\Models\Nominee', 'id', 'positions_id')
            ->whereNull('deleted_at');
    }
}
