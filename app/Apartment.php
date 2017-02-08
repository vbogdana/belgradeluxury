<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    //
    public $timestamps = false;
    public $primaryKey = 'accID';
    
    /*
    protected $fillable = [
        'accID', 'people', 'tv', 'hottub', 'wifi', 'bar', 'airCondition', 'parking', 'cityCenter'
    ];
     * 
     */
}
