<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResidentGateman extends Model
{
    protected $table = 'resident_gateman';
    protected $fillable = [
        'user_id',
        'gateman_id',
        'request_status',
    ];

    /**
     * The resident from the user table
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
