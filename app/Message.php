<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'message', 'read'];
    protected $hidden = ['estate_id', 'sender_id', 'receiver_id', 'updated_at'];
}
