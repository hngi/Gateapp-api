<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $fillable = ['estate_id','estate_name', 'country', 'city'];
}
