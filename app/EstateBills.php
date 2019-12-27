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
        'estate_id'
    ];

    /**
     * Joins Estate model with EstateBills model
     *
     * @see Laravel Eloquent Relationship (https://laravel.com/docs/6.x/eloquent-relationships)
     * @return App\EstateBills
     */
    public function estates()
    {
        return $this->belongsTo(Estate::class);
    }
}
