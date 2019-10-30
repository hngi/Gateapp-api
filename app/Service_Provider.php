<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_Provider extends Model
{
    protected $table = 'service_providers';

    protected $fillable = [
        'name', 'phone', 'description', 'image', 'estate_id', 'category_id'
    ];
}
