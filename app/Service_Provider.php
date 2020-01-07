<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Service_Provider extends Model
{
    use SoftDeletes;

    protected $table = 'service_providers';

    protected $fillable = [
        'name',
        'phone',
        'description',
        'image',
        'estate_id',
        'category_id',
        'status',
        'address',
        'contact_person'
    ];

    public function category()
    {

        return $this->belongsTo('App\Category');
    }

    public function estate()
    {

        return $this->belongsTo('App\Estate');
    }

    public static function allServices(User $user)
    {
        $query =  DB::table('service_providers');

        if ($user->user_type == 'resident' || $user->user_type == 'estate_admin') {
            $query
                ->whereIn('service_providers.estate_id', function ($query) use($user) {
                   return $query->from('homes')->select('estate_id')->distinct()->where('user_id', $user->id)->get();
                });
        }
        $query
            ->join('estates', 'service_providers.estate_id', '=', 'estates.id')
            ->join('sp_category', 'service_providers.category_id', '=', 'sp_category.id')
            ->select('service_providers.id as id', 'service_providers.name as name', 'service_providers.address as address',
                'service_providers.phone as phone', 'service_providers.description as description', 'service_providers.contact_person as contact_person',
                'estates.estate_name as estate', 'sp_category.title as categroy');

        return $query;
    }

}
