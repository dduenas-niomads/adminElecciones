<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    protected $connection = 'mysql';
    const TABLE_NAME = 'nominees';
    const STATE_ACTIVE = true;
    const STATE_INACTIVE = false;

    protected $fillable = [
        'name', 'code', 'description', 'email', 
        'document_type', 'document_number',
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

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = self::TABLE_NAME;
}
