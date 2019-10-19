<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Visitor extends Model
{
    use Notifiable;

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
        'visiting_period',
        'status',
        'time_in',
        'time_out',
        'qr_code',
        'visiting_period',
        'description'
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
     * Get the user that the visitor visited.
     * This expects that visitor table has a col named user_id
     */
    public function user()
    {
        //return $this->belongsTo(User::class);
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


    /**
     * Route notifications for the FCM channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForFcm($notification)
    {
        return $this->device_id;
    }
}
