<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'voters_id', 'positions_id', 'nominees_id', 'elections_id'
    ];

    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'positions_id', 'id')
            ->whereNull('deleted_at');
    }

    public function nominee()
    {
        return $this->belongsTo('App\Models\Nominee', 'nominees_id', 'id')
            ->whereNull('deleted_at');
    }

    public function election()
    {
        return $this->belongsTo('App\Models\Election', 'elections_id', 'id')
            ->whereNull('deleted_at');
    }

    public function voter()
    {
        return $this->belongsTo('App\Models\Voter', 'voters_id', 'id')
            ->whereNull('deleted_at');
    }
}
