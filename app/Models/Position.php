<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $connection = 'mysql';
    const TABLE_NAME = 'positions';
    const STATE_ACTIVE = true;
    const STATE_INACTIVE = false;

    protected $fillable = [
        'name',
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

    public function nominee()
    {
        return $this->hasMany('App\Models\Nominee', 'id', 'positions_id')
            ->whereNull('deleted_at');
    }

    public function result()
    {
        return $this->hasMany('App\Models\Result', 'id', 'positions_id')
            ->whereNull('deleted_at');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = self::TABLE_NAME;    
}
