<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    //
    protected $table = 'accommodation';
    public $timestamps = false;
    public $primaryKey = 'accID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_en', 'title_sr', 'address', 'price', 
        'description_en', 'description_sr', 'geoLat', 
        'geoLong', 'link', 'spa', 'priority'
    ];
    
    public function images() {
        return $this->hasMany('App\AccommodationImage', 'accID', 'accID');
    }
    
    public function apartment() {
        return Apartment::find($this->accID);
    }
    
    public function hotel() {
        return Hotel::find($this->accID);
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
