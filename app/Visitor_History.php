<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor_History extends Model
{
    protected $table = 'visitors_history';
    protected $fillable = [
        
        'visit_date',
        
    ];

    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    
}
