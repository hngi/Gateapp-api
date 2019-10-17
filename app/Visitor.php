<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Visitor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'arrival_date', 
        'car_plate_no', 
        'purpose', 
        'image', 
        'status',
        'time_out',
        'time_in',
        'home_id',
        'qr_code',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
    ];


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * Disable Laravel created_at and updated_at tables
     */
    public $timestamps = false;

    /**
     * Get the user that the visitor visited.
     * This expects that visitor table has a col named user_id
     */
    public function user()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo('App\User');
    }

    /**
     * Get the home that the visitor visited.
     * This expects that visitor table has a col named home_id
     */
    public function home()
    {
        // return $this->belongsTo(Home::class);
        return $this->belongsTo('App\Home');
    }

    /**
     * Logic method for pulling in default values for empty values
     */
    protected static function useit($major, $fallback)
    {
        return $major ? $major : $fallback;
    }
}