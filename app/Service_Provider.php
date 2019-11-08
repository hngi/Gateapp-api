<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service_Provider extends Model
{
    use SoftDeletes;
    
    protected $table = 'service_providers';

    protected $fillable = [
        'name', 'phone', 'description', 'image', 'estate_id', 'category_id', 'status'
    ];

    public function category()
    {
       
        return $this->belongsTo('App\Category');
    }

    public function estate()
    {

        return $this->belongsTo('App\Estate');
    }
    
}
