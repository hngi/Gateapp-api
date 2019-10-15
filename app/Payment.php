<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount', 'home_id', 'id',
    ];

    public function home()
    {
        return $this->belongsTo('App\Home');
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
