<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jwt_token', 'device_id', 'device_token', 'device_type', 'user_id', 'device_timezone',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    function category()
    {
        return $this->belongsTo('App\User','id','user_id');
    }
}
