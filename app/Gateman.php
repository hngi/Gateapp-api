<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateman extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'gateman_id',
        'request_status',
    ];

    protected $table = 'resident_gateman';
}

