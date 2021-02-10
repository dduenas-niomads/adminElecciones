<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionDetail extends Model
{
    protected $connection = 'mysql';
    const TABLE_NAME = 'election_details';
    const STATE_ACTIVE = true;
    const STATE_INACTIVE = false;

    protected $fillable = [
        'elections_id', 'nominees_id', 
        'areas_id', 'positions_id',
        //Audit 
        'flag_active','created_at','updated_at','deleted_at',        
    ];
    /**
     * Casting of attributes
     *
     * @var array
     */
    protected $casts = [
    ];    
    public function getFillable() {
        # code...
        return $this->fillable;
    }

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
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = self::TABLE_NAME;    
}


