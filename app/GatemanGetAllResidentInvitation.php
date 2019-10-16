<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GatemanGetAllResidentInvitation extends Model
{
    protected $table = "resident_gateman";
	
    protected $fillable = [
	     'id', 'user_id', 'gateman_id', 'request_status',
	];
}
