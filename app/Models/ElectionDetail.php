<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionDetail extends Model
{
    protected $fillable = [
        'elections_id', 'nominees_id', 'areas_id', 'positions_id'
    ];

    public function election()
    {
        return $this->belongsTo('App\Models\Election', 'elections_id', 'id')
            ->whereNull('deleted_at');
    }

    public function nominee()
    {
        return $this->belongsTo('App\Models\Nominee', 'nominees_id', 'id')
            ->whereNull('deleted_at');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'positions_id', 'id')
            ->whereNull('deleted_at');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'areas_id', 'id')
            ->whereNull('deleted_at');
    }
}


