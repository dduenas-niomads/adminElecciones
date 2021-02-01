<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name', 'code'
    ];

    public function voter()
    {
        return $this->hasMany('App\Models\Voter', 'id', 'areas_id')
            ->whereNull('deleted_at');
    }

    public function nominee()
    {
        return $this->hasMany('App\Models\Nominee', 'id', 'areas_id')
            ->whereNull('deleted_at');
    }
}

