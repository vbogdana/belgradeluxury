<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
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
        'stars', 'rooms_en', 'rooms_sr'
    ];

}
