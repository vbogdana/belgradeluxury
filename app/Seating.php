<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seating extends Model
{
    //
    protected $table = 'seatings';
    public $timestamps = false;
    public $primaryKey = 'seatID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
}
