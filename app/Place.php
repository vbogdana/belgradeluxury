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
        'title_en', 'title_ser', 'type',
        'description_en', 'description_ser', 
        'address', 'hours', 'phone', 
        'geoLat', 'geoLong', 'link'
    ];
}
