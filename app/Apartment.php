<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    //
    public $timestamps = false;
    public $primaryKey = 'accID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'people', 'tv', 'hottub', 'wifi', 'bar', 'airCondition', 'parking', 'cityCenter'
    ];

}
