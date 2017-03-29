<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'address', 'hours', 'phone', 
        'geoLat', 'geoLong', 'link',
        'priority'
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
}
