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

    /**
     * Joins Estate model with EstateBills model
     *
     * @see Laravel Eloquent Relationship (https://laravel.com/docs/6.x/eloquent-relationships)
     * @return App\EstateBills
     */
    public function billableItems()
    {
        return $this->hasMany(EstateBills::class)->select([
            'id as estate_bills_id', 'item', 'icon_link', 'base_amount'
        ]);
    }
}
