<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceReservation extends Model
{
    //
    protected $table = 'places_reservations';
    public $timestamps = false;
    public $primaryKey = 'resID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name', 'phone', 'people', 'message'
    ];
    
}
