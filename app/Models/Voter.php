<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $fillable = [
        'name', 'code', 'areas_id'
    ];

    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'areas_id', 'id')
            ->whereNull('deleted_at');
    }
}
