<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
         'id', 'user_id', 'estate_id', 'house_block', 'qr_code',
    ];

     protected $hidden = [
        'qr_code',
    ];

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function estate()
    {
        return $this->belongsTo('App\Estate');
    }
}
