<?php

namespace App;

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
        'phone_no',
        'purpose',
        'image',
        'status',
        'time_in',
        'time_out',
        'qr_code',
        'visiting_period',
        'description',
        'banned',
    ];

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

    public function visitor_history()
    {
        return $this->hasMany(Visitor_History::class);
    }

    public function scheduled_visit()
    {
        return $this->hasMany(ScheduledVisit::class);
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
