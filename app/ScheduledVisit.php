<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduledVisit extends Model
{
    protected $table = 'scheduled_visits';

    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
