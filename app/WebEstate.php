<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

// Add estate model for gateapp web version
class WebEstate extends Model
{
 public $table = 'estates';
 public $fillable = ['estate_id','estate_name', 'country', 'city', 'address'];
}
