<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResidentAndGateman extends Model
{
    protected $table = 'residents_and_gatemans';

    protected $fillable = [
        'resident_id', 'gateman_id'
    ];
}

