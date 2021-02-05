<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    protected $fillable = [
        'name', 'code', 'description', 'email', 'document_type', 'document_number'
    ];

    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'areas_id', 'id')
            ->whereNull('deleted_at');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'positions_id', 'id')
            ->whereNull('deleted_at');
    }

    public function result()
    {
        return $this->hasMany('App\Models\Result', 'id', 'nominees_id')
            ->whereNull('deleted_at');
    }
}
