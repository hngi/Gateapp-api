<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
         'home_id', 'occupant_id', 'estate_id', 'house_no', 'qr_code',
    ];
}
