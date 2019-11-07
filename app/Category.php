<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'sp_category';
    protected $fillable = ['title'];


    public function service_provider(){
 
        return $this->hasMany(Service_Provider::class);
    }



    public function scopeSearch($query, $s) {
        return $query->estateResidents
        (where ('name', 'like', '%' .$s. '%'));
    }
}




 // Service provider's relationship with category
 