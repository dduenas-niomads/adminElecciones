<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Result extends Model
{
    use  Notifiable;

    protected $connection = 'mysql';
    const TABLE_NAME = 'results';
    const STATE_ACTIVE = true;
    const STATE_INACTIVE = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'voters_id', 'positions_id', 'nominees_id', 'elections_id', 'email',
        'flag_mail_sended',
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

    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'positions_id', 'id')
            ->whereNull('deleted_at');
    }

    public function nominee()
    {
        return $this->belongsTo('App\Models\Nominee', 'nominees_id', 'id')
            ->select('id','name','code')
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
    
	public function getCreatedAtAttribute($value) {
        return date('d/m/Y H:i:s', strtotime($value));
	}
        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = self::TABLE_NAME;
}
