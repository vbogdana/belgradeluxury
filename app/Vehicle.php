<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    public $timestamps = false;
    public $primaryKey = 'vehID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand', 'model', 'type', 'price', 'description_en', 'description_sr', 'people', 'automatic', 'navigation', 'chauffeur', 'link'
    ];
    
    public function images() {
        return $this->hasMany('App\VehicleImage', 'vehID', 'vehID');
    }
}
