<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportReply extends Model
{
    protected  $fillable = [
        'support_id', 'user_id', 'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
