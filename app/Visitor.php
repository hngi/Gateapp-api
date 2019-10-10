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
        'visitor_name', 'arrival_date', 'car_plate_no', 'purpose', 'image', 'status',
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
    protected $primaryKey = 'visitor_id';


    public $timestamps = false;
}