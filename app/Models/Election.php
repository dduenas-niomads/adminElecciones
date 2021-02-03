<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $fillable = [
        'name', 'status', 'votes_number', 'date_start', 'date_end', 'flag_active'
    ];

    public function detail()
    {
        return $this->hasMany('App\Models\ElectionDetail', 'id', 'elections_id')
            ->whereNull('deleted_at');
    }
}

