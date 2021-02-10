<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $connection = 'mysql';
    const TABLE_NAME = 'areas';
    const STATE_ACTIVE = true;
    const STATE_INACTIVE = false;
    
    protected $fillable = [
        'name', 'code',
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

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = self::TABLE_NAME;
}

