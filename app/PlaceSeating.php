<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceSeating extends Model
{
    //
    protected $table = 'places_seatings';
    public $timestamps = false;
    public $primaryKey = 'psID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    
    public function place() {
       return $this->belongsTo('App\Place', 'placeID', 'placeID'); 
    }
    
    public function seating() {
       return $this->belongsTo('App\Seating', 'seatID', 'seatID'); 
    }
}
