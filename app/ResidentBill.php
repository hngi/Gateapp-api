<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResidentBill extends Model
{
    protected $fillable = [
        'users_id',
        'estate_bills_id',
        'usage_duration',
        'amount',
        'status',
    ];

    public function scopeBillInfo()
    {
        return $this->belongsTo(EstateBills::class, 'estate_bills_id');
    }
}
