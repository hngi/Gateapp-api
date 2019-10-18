<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'resident_id', 'visitor_id','token', 'apns_id'];
    
}
