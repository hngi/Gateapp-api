<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'sp_category';
    protected $fillable = ['title'];
}
