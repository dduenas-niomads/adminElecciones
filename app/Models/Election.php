<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $connection = 'mysql';
    const TABLE_NAME = 'elections';
    const STATE_ACTIVE = true;
    const STATE_INACTIVE = false;

    protected $fillable = [
        'name', 'status', 'votes_number', 
        'date_start', 'date_end', 
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

    public function detail()
    {
        return $this->hasMany('App\Models\ElectionDetail', 'id', 'elections_id')
            ->whereNull('deleted_at');
    }
        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = self::TABLE_NAME;
}

