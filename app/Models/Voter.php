<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Voter extends Model
{
    use  Notifiable;
    protected $connection = 'mysql';
    const TABLE_NAME = 'voters';
    const STATE_ACTIVE = true;
    const STATE_INACTIVE = false;

    protected $fillable = [
        'name','lastname','document_number','type_document',
        'dependency', 'age','code', 'areas_id', 'phone', 'email',
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


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = self::TABLE_NAME;
}