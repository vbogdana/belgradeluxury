<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class Place extends Model
{
    //
    public $timestamps = false;
    public $primaryKey = 'placeID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_en', 'title_sr', 'type',
        'description_en', 'description_sr', 
        'address', 'hours_en', 'hours_sr', 
        'phone', 'geoLat', 'geoLong', 
        'link', 'priority'
    ];
    
    public function images() {
        return $this->hasMany('App\PlaceImage', 'placeID', 'placeID');
    }
    
    public function isRestaurant() {
        return ($this->type === 'restaurant');
    }
    
    public function getPriority() {
        if ($this->priority == 1) {
            return 'low';
        } else if ($this->priority == 2) {
            return 'medium';
        } else if ($this->priority == 3) {
            return 'high';
        }
    }
    
    public function getEvents() {
        $events = Event::where('placeID', $this->placeID)
                ->whereBetween('date', [ date("Y-m-d"), date("Y-m-d", (time()+15*24*60*60)) ])
                ->orderBy('date', 'asc')
                ->get(); 
        return $events;
    }
    
    public function events() {
        return $this->hasMany('App\Event', 'placeID', 'placeID');
    }
    
    public function seatings() {
        return $this->hasMany('App\PlaceSeating', 'placeID', 'placeID');
    }
}
