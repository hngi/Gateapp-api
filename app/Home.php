<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
         'id', 'user_id', 'estate_id', 'house_no', 'qr_code',
    ];
}
