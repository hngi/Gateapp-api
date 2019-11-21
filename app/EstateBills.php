<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstateBills extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item',
        'icon_link',
        'base_amount',
        'estates_id'
    ];
}
