<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $fillable = ['estate_id','estate_name', 'country', 'city', 'image', 'address'];

    public function service_provider()
    {
        return $this->hasMany(Service_Provider::class);
    }
}
