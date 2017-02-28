<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    //
    public $timestamps = false;
    public $primaryKey = 'packID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_en', 'title_ser', 'price', 
        'description_en', 'description_ser',
        'position',
        'cardFront', 'cardBack', 'symbol'
    ];
}
