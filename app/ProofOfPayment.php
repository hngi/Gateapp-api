<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProofOfPayment extends Model
{
    protected $table = 'payment_proof';
    protected $fillable = [
        'user_id',
        'resident_bills_id',
        'estate_id',
        'name',
        'teller_no',
        'image',
        'status',
    ];

    public function scopeBillInfo()
    {
        return $this->belongsTo(ResidentBill::class, 'resident_bills_id');
    }

    public function home()
    {
        // return $this->belongsTo(Home::class);
        return $this->belongsTo('App\Home');
    }
}
