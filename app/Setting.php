<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'app_notification',
        'push_notification',
        'location_tracking',
        'user_id'
    ];
}
